<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Handles webhooks from SumUp as a backup scenario
 * if the user's browser doesn't send the transaction code to the server.
 * It registers an endpoint which SumUp calls when there is changes in a checkout.
 *
 * @class    SumUp_Hook
 * @since    1.0.0
 * @version  1.0.0
 */
class WC_SumUp_Hook {
	const CUSTOMENDPOINT = 'sumup_callback';

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'wc_ajax_' . self::CUSTOMENDPOINT, array( $this, 'handle_sumup_hook' ) );
	}

	/**
	 * Get callback URL.
	 *
	 * @param int  $order_id
	 * @since      1.0.0
	 * @version    1.0.0
	 */
	public static function get_callback_url( $order_id ) {
		$url_parts = parse_url( site_url() );
		$scheme = $url_parts['scheme'];
		$host = $url_parts['host'];
		$port = $url_parts['port'] ? ':' . $url_parts['port'] : '';
		$path = WC_AJAX::get_endpoint( self::CUSTOMENDPOINT );
		$param_order = strpos( $path, '?' ) !== false ? "&order=$order_id" : "?order=$order_id";

		return $scheme . '://' . $host . $port . $path . $param_order;
	}

	/**
	 * Handle processing payment through a webhook.
	 * Back up flow if the front-end was interrupted and couldn't send the transaction id to the server.
	 *
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	function handle_sumup_hook() {
		if ( empty( $_REQUEST['id'] ) || ! is_string( $_REQUEST['id'] ) || empty( $_REQUEST['order'] ) || ! ( is_string( $_REQUEST['order'] ) || is_int( $_REQUEST['order'] ) ) ) {
			return;
		}

		sleep(5); /* Delay the hook execution because the front-end should process the order first, if it fails to do it in 5s then we should relay on this */

		$checkout_id = sanitize_key( sanitize_text_field( $_REQUEST['id'] ) );
		$order_id = intval( $_REQUEST['order'] );

		if ( $order_id <= 0 || empty( $checkout_id ) ) {
			return;
		}

		$order = wc_get_order( $order_id );
		if ( empty( $order ) ) {
			return;
		}

		$order_transaction_code = $order->get_meta( '_sumup_transaction_code' );
		if ( ! empty( $order_transaction_code ) ) {
			/* This order is already processed */
			return;
		}

		$order_checkout_id = $order->get_meta( '_sumup_checkout_id' );
		if ( empty( $order_checkout_id ) ) {
			return;
		}

		$order_checkout_ref = $order->get_meta( '_sumup_checkout_ref' );
		if ( empty( $order_checkout_ref ) ) {
			return;
		}

		$sumup_api = new WC_SumUp_API();
		$checkout_response = $sumup_api->get_checkout_by_id( $order_checkout_id );
		if ( empty( $checkout_response ) ) {
			WC_SUMUP_LOGGER::log( "Hook. No response from SumUp for order='$order' and checkout='$checkout_id'", 'error' );
			return;
		}

		if ( $checkout_response->id !== $checkout_id ) {
			WC_SUMUP_LOGGER::log( "Hook. Checkouts don't match. Checkout id is '$checkout_id' but the checkout id from the response is '$checkout_response->id'", 'error' );
			return;
		}

		if ( $checkout_response->checkout_reference !== $order_checkout_ref ) {
			WC_SUMUP_LOGGER::log( "Hook. Checkout references don't match. Checkout reference is '$order_checkout_ref' but the checkout reference from the response is '$checkout_response->checkout_reference'", 'error' );
			return;
		}

		if ( 'PAID' === $checkout_response->status ) {
			$transaction_code = $checkout_response->transaction_code;
			$order->payment_complete( $transaction_code );
			/* translators: %s = Transaction code returned from the API */
			$message = sprintf( __( 'SumUp charge complete (Transaction Code: %s)', 'sumup-payment-gateway-for-woocommerce' ), $transaction_code );
			$order->add_order_note( $message );

			$order->update_meta_data( '_sumup_transaction_code', $transaction_code );

			do_action( 'sumup_gateway_payment_complete_from_hook', $order );
			do_action( 'sumup_gateway_payment_complete', $order );

			$order->save();

			return;
		}

		exit;
	}
}

new WC_SumUp_Hook();

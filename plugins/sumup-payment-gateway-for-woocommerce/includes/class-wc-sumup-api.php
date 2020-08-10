<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

include_once(WC_SUMUP_PLUGIN_PATH . '/vendor/autoload.php');

/**
 * @class    WC_SumUp_API
 * @since    1.0.0
 * @version  1.0.0
 */
class WC_SumUp_API {
	protected $client_id;
	protected $client_secret;
	protected $pay_to_email;
	protected $currency;
	protected $sumupClient;

	/**
	 * Constructor.
	 */
	public function __construct() {
		$options            = get_option( 'woocommerce_sumup_settings' );
		$testmode           = ( isset( $options['testmode'] ) && 'yes' === $options['testmode'] ) ? true : false;

		if ( $testmode ) {
			$this->client_id       = isset( $options['test_client_id'] ) ? $options['test_client_id'] : '';
			$this->client_secret   = isset( $options['test_client_secret'] ) ? $options['test_client_secret'] : '';
			$this->pay_to_email    = isset( $options['test_pay_to_email'] ) ? $options['test_pay_to_email'] : '';
		} else {
			$this->client_id       = isset( $options['client_id'] ) ? $options['client_id'] : '';
			$this->client_secret   = isset( $options['client_secret'] ) ? $options['client_secret'] : '';
			$this->pay_to_email    = isset( $options['pay_to_email'] ) ? $options['pay_to_email'] : '';
		}

		$this->currency            = isset( $options['currency'] ) ? $options['currency'] : '';
		$this->authorize();
	}

	/**
	 * Authorize in SumUp.
	 *
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function authorize() {
		if ( isset( $this->sumupClient ) ) {
			$this->sumupClient;
			return true;
		}

		try {
			$this->sumupClient = new \SumUp\SumUp([
				'app_id'     => $this->client_id,
				'app_secret' => $this->client_secret,
				'grant_type' => 'client_credentials',
				'scopes'     => ['payments', 'transactions.history', 'user.app-settings', 'user.profile_readonly']
			]);
			return true;
		} catch(\SumUp\Exceptions\SumUpSDKException $e) {
			WC_SUMUP_LOGGER::log( 'Error: (ClientID: "' . $this->client_id . '") ' . $e->getMessage(), 'error' );
		}

		return false;
	}

	/**
	 * Create new checkout through SumUp API.
	 *
	 * @param int  $order
	 * @since      1.0.0
	 * @version    1.0.0
	 */
	protected function create_checkout( $order ) {
		try {
			$order_id = $order->get_id();
			$checkout_ref = 'WC#order_' . $order_id . '_' . $this->random_string();
			$description = sprintf( __( 'Payment for WooCommerce Order #%s', 'sumup-payment-gateway-for-woocommerce' ), $order_id );
			$checkout_service = $this->sumupClient->getCheckoutService();
			$checkout_response = $checkout_service->create(
				$order->get_total(),
				$this->currency,
				$checkout_ref,
				$this->pay_to_email,
				$description,
				null,
				WC_SumUp_Hook::get_callback_url( $order_id )
			);
			$checkout_id = $checkout_response->getBody()->id;
			$order->add_meta_data( '_sumup_checkout_id', $checkout_id, true);
			$order->add_meta_data( '_sumup_checkout_ref', $checkout_ref, true);
			$order->save_meta_data();

			return $checkout_id;
		} catch( \SumUp\Exceptions\SumUpSDKException $e ) {
			WC_SUMUP_LOGGER::log( 'Error: (Checkout Reference: "' . $checkout_ref . '") ' . $e->getMessage(), 'error' );
		} catch( Exception $e ) {
			WC_SUMUP_LOGGER::log( 'Error: (Checkout Reference: "' . $checkout_ref . '") ' . $e->getMessage(), 'error' );
		}

		return null;
	}

	/**
	 * Generate random string.
	 *
	 * @param int  $length
	 * @since      1.0.0
	 * @version    1.0.0
	 */
	protected function random_string( $length = 5 ) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$characters_length = strlen( $characters );
		$random_string = '';
		for ($i = 0; $i < $length; $i++) {
			$random_string .= $characters[ wp_rand(0, $characters_length - 1) ];
		}
		return $random_string;
	}

	/**
	 * Get checkout id from SumUp API.
	 *
	 * @param string  $checkout_id
	 * @since         1.0.0
	 * @version       1.0.0
	 */
	public function get_checkout_by_id( $checkout_id ) {
		try {
			$checkout_service = $this->sumupClient->getCheckoutService();
			$checkout_response = $checkout_service->findById( $checkout_id );

			return $checkout_response->getBody();
		} catch(\SumUp\Exceptions\SumUpSDKException $e) {
			WC_SUMUP_LOGGER::log( 'Error: (Checkout ID: "' . $checkout_id . '") ' . $e->getMessage(), 'error' );
		} catch( Exception $e ) {
			WC_SUMUP_LOGGER::log( 'Error: (Checkout ID: "' . $checkout_id . '") ' . $e->getMessage(), 'error' );
		}

		return null;
	}

	/**
	 * Get checkout id for a particular order.
	 *
	 * @param int  $order_id
	 * @since      1.0.0
	 * @version    1.0.0
	 */
	public function get_checkout_id_for_order( $order_id ) {
		$order = wc_get_order( $order_id );
		$checkout_id = $order->get_meta( '_sumup_checkout_id' );

		if ( ! empty( $checkout_id ) ) {
			return $checkout_id;
		}

		return $this->create_checkout( $order );
	}

	/**
	 * Validate transaction for an order
	 *
	 * @param int     $order_id
	 * @param string  $trancasction_code
	 * @since         1.0.0
	 * @version       1.0.0
	 */
	public function validate_transaction_for_order( $order_id, $transaction_code ) {
		$order = wc_get_order( $order_id );
		$order_checkout_id = $order->get_meta( '_sumup_checkout_id' );

		if ( empty( $order_checkout_id ) ) {
			/* There is no checkout for this order */
			return array(
				'result'  => false,
				'message' => 'no_checkout'
			);
		}

		if ( $order->get_meta( '_sumup_transaction_code' ) === $transaction_code ) {
			/* Тransaction is already processed on the server */
			return array(
				'result'  => 'already_processed',
				'message' => 'already_processed'
			);
		}

		$checkout_response = $this->get_checkout_by_id( $order_checkout_id );

		if ( empty( $checkout_response ) ) {
			/* No response or error fetching the remote data */
			return array(
				'result'  => false,
				'message' => 'error_fetching'
			);
		}
		
		/* Check if checkout is paid on SumUp side */
		if ( 'PAID' != $checkout_response->status ) {
			/* Checkout is not paid */
			return array(
				'result'  => false,
				'message' => 'not_paid'
			);
		}

		/* Compare amounts */
		if ( $order->get_total() != $checkout_response->amount ) {
			/* There is some strange mismatch between the amount locally and on SumUp */
			return array(
				'result'  => false,
				'message' => 'amount_mismatch'
			);
		}

		/* Compare checkout ids */
		if ( $order->get_meta( '_sumup_checkout_id' ) != $checkout_response->id ) {
			/* Checkout ids don't match */
			return array(
				'result'  => false,
				'message' => 'checkout_id_mismatch'
			);
		}

		/* Compare transaction codes */
		if ( $checkout_response->transaction_code != $transaction_code ) {
			/* Transaction code doesn't match */
			return array(
				'result'  => false,
				'message' => 'transaction_code_mismatch'
			);
		}

		/* Transaction is successful */
		return array(
			'result' => true,
			'transaction_code' => $checkout_response->transaction_code
		);
	}
}

<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @class    WC_Gateway_SumUp
 * @since    1.0.0
 * @version  1.0.0
 */
class WC_Gateway_SumUp extends WC_Payment_Gateway_CC {

	/**
	 * Constructor.
	 */
	public function __construct() {
		/* Init options */
		$this->init_options();

		/* Load the form fields */
		$this->init_form_fields();

		/* Load the settings */
		$this->init_settings();

		/* Load actions */
		$this->init_actions();
	}

	/**
	 * Initialize all options and properties.
	 * 
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function init_options() {
		$this->id                 = 'sumup';
		$this->method_title       = __( 'SumUp', 'sumup-payment-gateway-for-woocommerce' );
		/* translators: %1$s = https://me.sumup.com/, %2$s = https://me.sumup.com/developers */
		$this->method_description = sprintf( __( 'SumUp works by adding payment fields on the checkout and then sending the details to SumUp for verification. <a href="%1$s" target="_blank">Sign up</a> for a SumUp account. After logging in, <a href="%2$s" target="_blank">get your SumUp account keys</a>.', 'sumup-payment-gateway-for-woocommerce' ), 'https://me.sumup.com/', 'https://me.sumup.com/developers' );
		$this->has_fields         = true;
		$this->supports           = array(
			'subscriptions',
			'products',
		);
		$this->title              = $this->get_option( 'title' );
		$this->description        = $this->get_option( 'description' );
		$this->enabled            = 'yes' === $this->get_option( 'enabled' );
		$this->test_mode          = 'yes' === $this->get_option( 'testmode' );
		$this->zip_code           = $this->get_option( 'zip_code' );

		if ( $this->test_mode ) {
			$this->client_id      = $this->get_option( 'test_client_id' );
			$this->client_secret  = $this->get_option( 'test_client_secret' );
			$this->pay_to_email   = $this->get_option( 'test_pay_to_email' );
		} else {
			$this->client_id      = $this->get_option( 'client_id' );
			$this->client_secret  = $this->get_option( 'client_secret' );
			$this->pay_to_email   = $this->get_option( 'pay_to_email' );
		}
	}

	/**
	 * Initialize action hooks.
	 * 
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function init_actions() {
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
		add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'process_admin_options' ) );
		add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'verify_credentials') );
		add_action( 'woocommerce_checkout_order_processed', array( $this, 'maybe_fetch_checkout_id' ), 10, 3 );
		add_action( 'wp_enqueue_scripts', array( $this, 'payment_scripts' ) );
	}

	/**
	 * Initialise gateway settings form fields
	 *
	 * @since   1.0.0
	 * @version 1.0.0
	 */
	public function init_form_fields() {
		$this->form_fields = require dirname( __FILE__ ) . '/class-wc-sumup-settings.php';
	}

	/**
	 * Process the payment.
	 *
	 * @param int $order_id
	 * @since     1.0.0
	 * @version   1.0.0
	 */
	public function process_payment( $order_id ) {
		if( ! isset( $_REQUEST['sumup_process'] ) || ! isset( $_REQUEST['sumup_transaction_code'] ) || ! is_string( $_REQUEST['sumup_transaction_code'] ) ) {
			return;
		}

		try {
			$order = wc_get_order( $order_id );

			$order_has_transaction_code = boolval( $order->get_meta( '_sumup_transaction_code' ) );

			if ( ! $order_has_transaction_code ) { /* Check if order has already been processed through hook */
				$sumup_api = new WC_SumUp_API();
				/* Validate the transaction on the server */
				$validation_result = $sumup_api->validate_transaction_for_order( $order_id, $_REQUEST['sumup_transaction_code'] );

				if ( ! $validation_result['result'] ) {
					$order->add_order_note( __( 'Transaction was invalid', 'sumup-payment-gateway-for-woocommerce' ) );
					WC_SUMUP_LOGGER::log( 'Trying to process a payment but the transaction was invalid', 'notice' );
					WC_SUMUP_LOGGER::log( 'Trying to process a payment. Order ID: ' . $order_id . '. ' . print_r( $validation_result, true ), 'debug' );
					throw new Exception( __( 'Transaction was invalid', 'sumup-payment-gateway-for-woocommerce' ) );
				} else if ( $validation_result['result'] !== 'already_processed' ) {
					$transaction_code = $validation_result['transaction_code'];
					$order->payment_complete( $transaction_code );
					/* translators: %s = Transaction code returned from the API */
					$message = sprintf( __( 'SumUp charge complete (Transaction Code: %s)', 'sumup-payment-gateway-for-woocommerce' ), $transaction_code );
					$order->add_order_note( $message );

					/* Attach transaction code to the order to indicate the payment */
					$order->update_meta_data( '_sumup_transaction_code', $transaction_code );

					do_action( 'sumup_gateway_payment_complete', $order );

					$order->save();
				}
			}

			/* Empty cart */
			WC()->cart->empty_cart();

			/* Return thank you page redirect */
			return array(
				'result'   => 'success',
				'redirect' => $this->get_return_url( $order ),
			);
		} catch ( Exception $e ) {
			wc_add_notice( $e->getMessage(), 'error' );

			do_action( 'sumup_gateway_process_payment_error', $e, $order_id );
		}

		return array(
			'result'   => 'fail',
			'redirect' => $this->get_return_url( $order ),
		);
	}

	/**
	 * Builds our payment fields area. Initializes the SumUp's Card Widget.
	 *
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function payment_fields() {
		if ( ! get_option( 'sumup_valid_credentials' ) ) {
			_e( "Error. The gateway isn't properly configured", 'sumup-payment-gateway-for-woocommerce' );
			return;
		}

		if ( $this->test_mode ) {
			echo '<p style="color:red;font-size:1.2em;font-weight:bold;text-align:center;">' . __("You're in Test Mode", 'sumup-payment-gateway-for-woocommerce') . '</p>';
		}

		$description = $this->get_description();
		if ( $description ) {
			echo wp_kses_post( wpautop( wptexturize( $description ) ) );
		}

		echo '<div id="sumup-card"></div>';
		echo '<script type="text/javascript">jQuery(function($) { $(function () { $("#sumup-card").trigger("sumupCardInit"); }); });</script>';
	}

	/**
	 * Register the JavaScript scripts to the checkout page.
	 * 
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function payment_scripts() {

		/* Add JavaScript only on the checkout page */
		if ( ! is_cart() && ! is_checkout() && ! isset( $_GET['pay_for_order'] ) ) {
			return;
		}

		/* Add JavaScript only if the plugin is enabled */
		if ( ! $this->enabled ) {
			return;
		}

		/* Add JavaScript only if the plugin is set up correctly */
		if ( ! get_option( 'sumup_valid_credentials' ) ) {
			return;
		}

		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		/*
		 * Use the SumUp's SDK for accepting card payments.
		 * Documentation can be found at https://developer.sumup.com/docs/widgets-card
		 */
		wp_enqueue_script( 'sumup_gateway_card_sdk', 'https://gateway.sumup.com/gateway/ecom/card/v2/sdk.js', array(), null, false );
		wp_register_script( 'sumup_gateway_front_script', plugins_url( 'assets/js/sumup-gateway' . $suffix .'.js', WC_SUMUP_MAIN_FILE ), array('sumup_gateway_card_sdk'), WC_SUMUP_VERSION, false );

		$checkoutEndpoint = WC_AJAX::get_endpoint('checkout');
		$showZipCode = $this->zip_code === 'yes' ? 'true' : 'false';
		$user_locale = str_replace( "_", "-", get_user_locale(wp_get_current_user()->ID ) );
		$card_supported_locales = ['bg-BG', 'cs-CZ', 'da-DK', 'de-AT', 'de-CH', 'de-DE', 'de-LU', 'el-CY', 'el-GR', 'en-GB', 'en-IE', 'en-MT', 'en-US', 'es-CL', 'es-ES', 'et-EE', 'fi-FI', 'fr-BE', 'fr-CH', 'fr-FR', 'fr-LU', 'hu-HU', 'it-CH', 'it-IT', 'lt-LT', 'lv-LV', 'nb-NO', 'nl-BE', 'nl-NL', 'pt-BR', 'pt-PT', 'pl-PL', 'sk-SK', 'sl-SI', 'sv-SE'];
		$card_locale = in_array($user_locale, $card_supported_locales) ? $user_locale : 'en-GB';
		/**
		 * Translators: the following error messages are shown to the end user
		 */
		$error_general = __( 'Transaction was unsuccessful. Please try another card or try another payment method.' );
		$error_invalid_form = __( 'Fill in all required details.' );

		wp_localize_script( 'sumup_gateway_front_script', 'sumup_gateway_params', array(
			'showZipCode' => "$showZipCode",
			'locale' => "$card_locale",
			'errors' => array(
				'general_error' => "$error_general",
				'invalid_form' => "$error_invalid_form"
			)
		) );

		wp_enqueue_script( 'sumup_gateway_front_script' );
	}

	/**
	 * Register scripts in the administration.
	 *
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function admin_scripts() {

		/* Add JavaScript only on gateway settings page of the plugin */
		if ( 'woocommerce_page_wc-settings' !== get_current_screen()->id ) {
			return;
		}

		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		wp_enqueue_script( 'woocommerce_sumup_admin', plugins_url( 'assets/js/sumup-admin' . $suffix . '.js', WC_SUMUP_MAIN_FILE ), array(), WC_SUMUP_VERSION, true );
	}

	/**
	 * Get checkout_id for order.
	 *
	 * @param int       $order_id
	 * @param array     $posted_data
	 * @param WP_Order  $order
	 * @since           1.0.0
	 * @version         1.0.0
	 */
	public function maybe_fetch_checkout_id( $order_id, $posted_data, $order ) {
		if( ! isset( $_REQUEST['sumup_get_checkout_id'] ) || $posted_data['payment_method'] !== $this->id ) {
			return;
		}

		WC()->session->set( 'order_awaiting_payment', $order_id );

		try {
			$sumup_api = new WC_SumUp_API();
			$checkout_id = $sumup_api->get_checkout_id_for_order( $order_id );

			if( empty( $checkout_id ) ) {
				WC_SUMUP_LOGGER::log( 'Failed to fetch Checkout ID', 'error' );
				throw new Exception( __( 'Failed to fetch Checkout ID', 'sumup-payment-gateway-for-woocommerce' ) );
			}

			wp_send_json( array(
				"result" => "sumup_payment_info",
				"checkout_id" => $checkout_id
			) );
		} catch( Exception $e ) {
			wp_send_json( array(
				"result" => "sumup_checkout_error",
				"messages" => '<div class="woocommerce-error">' . __( 'Failed to get Checkout ID to process payment.', 'sumup-payment-gateway-for-woocommerce' ). '</div>',
			) );
		}
		exit; /* make sure we exit */
	}

	/**
	 * Verify if SumUp application credentials are valid when saving settings.
	 *
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	function verify_credentials() {
		$sumup = new WC_SumUp_API();
		$authorizationSuccess = $sumup->authorize();

		if ( true === $authorizationSuccess) {
			/* Credentials are ok */
			update_option( 'sumup_valid_credentials', 1, false);
			echo '<div class="notice notice-success"><p>' . __( 'You client id and secret are valid.' ) . '</p></div>';
		} else {
			/* Credentials are invalid */
			update_option( 'sumup_valid_credentials', 0, false);
			echo '<div class="notice notice-error"><p>' . __( 'Provided credentials are incorrect.' ) . '</p></div>';
		}
	}
}

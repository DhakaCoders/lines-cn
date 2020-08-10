<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Administration settings configuration
 *
 * @since    1.0.0
 * @version  1.0.0
 */
return apply_filters(
	'sumup_gateway_settings',
	array(
		'enabled' => array(
			'title'       => __( 'Enable/Disable', 'sumup-payment-gateway-for-woocommerce' ),
			'label'       => __( 'Enable SumUp', 'sumup-payment-gateway-for-woocommerce' ),
			'type'        => 'checkbox',
			'description' => '',
			'default'     => 'no',
		),
		'title' => array(
			'title'       => __( 'Title', 'sumup-payment-gateway-for-woocommerce' ),
			'type'        => 'text',
			'description' => __( 'This controls the title the user sees during checkout.', 'sumup-payment-gateway-for-woocommerce' ),
			'default'     => __( 'Credit card (SumUp)', 'sumup-payment-gateway-for-woocommerce' ),
			'desc_tip'    => true,
		),
		'description' => array(
			'title'       => __( 'Description', 'sumup-payment-gateway-for-woocommerce' ),
			'type'        => 'text',
			'description' => __( 'This controls the description the user sees during checkout.', 'sumup-payment-gateway-for-woocommerce' ),
			'default'     => __( 'Pay with your credit card via SumUp.', 'sumup-payment-gateway-for-woocommerce' ),
			'desc_tip'    => true,
		),
		'currency' => array(
			'title'       => __( 'Currency', 'sumup-payment-gateway-for-woocommerce' ),
			'type'        => 'select',
			'description' => __( 'Set the currency from your SumUp account.', 'sumup-payment-gateway-for-woocommerce' ),
			'default'     => '',
			'desc_tip'    => true,
			'options'     => array(
				'EUR' => 'EUR',
				'BGN' => 'BGN',
				'CHF' => 'CHF',
				'CZK' => 'CZK',
				'DKK' => 'DKK',
				'GBP' => 'GBP',
				'HUF' => 'HUF',
				'NOK' => 'NOK',
				'PLN' => 'PLN',
				'SEK' => 'SEK',
				'USD' => 'USD',
			),
		),
		'testmode' => array(
			'title'       => __( 'Test Mode', 'sumup-payment-gateway-for-woocommerce' ),
			'label'       => __( 'Enable Test Mode', 'sumup-payment-gateway-for-woocommerce' ),
			'type'        => 'checkbox',
			'description' => __( 'Place the payment gateway in test mode using API keys from your test account.', 'sumup-payment-gateway-for-woocommerce' ),
			'default'     => 'no',
			'desc_tip'    => true,
		),
		'test_client_id' => array(
			'title'       => __( 'Test Client ID', 'sumup-payment-gateway-for-woocommerce' ),
			'type'        => 'text',
			'description' => __( 'Get your Client ID from your SumUp account.', 'sumup-payment-gateway-for-woocommerce' ),
			'default'     => '',
			'desc_tip'    => true,
		),
		'test_client_secret' => array(
			'title'       => __( 'Test Client Secret', 'sumup-payment-gateway-for-woocommerce' ),
			'type'        => 'password',
			'description' => __( 'Get your Client Secret from your SumUp account.', 'sumup-payment-gateway-for-woocommerce' ),
			'default'     => '',
			'desc_tip'    => true,
		),
		'test_pay_to_email' => array(
			'title'       => __( 'Test Login Email', 'sumup-payment-gateway-for-woocommerce' ),
			'type'        => 'text',
			'description' => __( 'Get your Email from your SumUp account.', 'sumup-payment-gateway-for-woocommerce' ),
			'default'     => '',
			'desc_tip'    => true,
		),
		'client_id' => array(
			'title'       => __( 'Client ID', 'sumup-payment-gateway-for-woocommerce' ),
			'type'        => 'text',
			'description' => __( 'Get your Client ID from your SumUp account.', 'sumup-payment-gateway-for-woocommerce' ),
			'default'     => '',
			'desc_tip'    => true,
		),
		'client_secret' => array(
			'title'       => __( 'Client Secret', 'sumup-payment-gateway-for-woocommerce' ),
			'type'        => 'password',
			'description' => __( 'Get your Client Secret from your SumUp account.', 'sumup-payment-gateway-for-woocommerce' ),
			'default'     => '',
			'desc_tip'    => true,
		),
		'pay_to_email' => array(
			'title'       => __( 'Login Email', 'sumup-payment-gateway-for-woocommerce' ),
			'type'        => 'text',
			'description' => __( 'Get your Email from your SumUp account.', 'sumup-payment-gateway-for-woocommerce' ),
			'default'     => '',
			'desc_tip'    => true,
		),
		'zip_code' => array(
			'title'       => __( 'ZIP Code', 'sumup-payment-gateway-for-woocommerce' ),
			'label'       => __( 'Show ZIP Code', 'sumup-payment-gateway-for-woocommerce' ),
			'type'        => 'checkbox',
			'description' => __( 'Request ZIP code from your customers on the card payment form. This is mandatory for all merchants from the USA.', 'sumup-payment-gateway-for-woocommerce' ),
			'default'     => 'no',
			'desc_tip'    => true,
		),
		'logging' => array(
			'title'       => __( 'Logging', 'sumup-payment-gateway-for-woocommerce' ),
			'label'       => __( 'Log debug messages', 'sumup-payment-gateway-for-woocommerce' ),
			'type'        => 'checkbox',
			'description' => __( 'Save debug messages to the WooCommerce System Status log.', 'sumup-payment-gateway-for-woocommerce' ),
			'default'     => 'yes',
			'desc_tip'    => true,
		),
	)
);

<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Utilize WC logger class
 * 
 * @since   1.0.0
 * @version 1.0.0
 */
class WC_SUMUP_LOGGER {

	/**
	 * Add a log entry.
	 * 
	 * @param string $message Log message.
	 * @param string $type One of: ['debug', 'info', 'warning', 'notice', 'error', 'critical'].
	 */
	public static function log( $message, $type = 'debug' ) {
		if ( ! class_exists( 'WC_Logger' ) ) {
			return;
		}

		$options     = get_option( 'woocommerce_sumup_settings' );
		$testmode    = ( isset( $options['testmode'] ) && 'yes' === $options['testmode'] ) ? true : false;
		$client_id   = $testmode ? $options['test_client_id'] : $options['client_id'];

		if ( empty( $options ) || ( isset( $options['logging'] ) && 'yes' !== $options['logging'] ) ) {
			return;
		}

		$logger = new WC_Logger();
		$context = array( 'source' => 'sumup-payment-gateway-for-woocommerce' );

		$log_message  = "\n" . '====SumUp Version: ' . WC_SUMUP_VERSION . '====' . "\n";
		$log_message .= 'Client ID: ' . $client_id . "\n";
		$log_message .= '====Start Log====' . "\n";
		$log_message .= $message . "\n";
		$log_message .= '====End Log====' . "\n\n";

		$logger->log( $type, $log_message, $context );
	}
}

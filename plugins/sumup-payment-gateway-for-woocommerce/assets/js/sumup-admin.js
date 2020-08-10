jQuery( function( $ ) {
	'use strict';

	/**
	 * Object to handle SumUp admin functions.
	 */
	var wc_sumup_admin = {
		isTestMode: function() {
			return $( '#woocommerce_sumup_testmode' ).is( ':checked' );
		},

		getSecretKey: function() {
			if ( wc_sumup_admin.isTestMode() ) {
				return $( '#woocommerce_sumup_test_client_id' ).val();
			} else {
				return $( '#woocommerce_sumup_client_id' ).val();
			}
		},

		/**
		 * Initialize.
		 */
		init: function() {
			$( document.body ).on( 'change', '#woocommerce_sumup_testmode', function() {
				var test_client_id = $( '#woocommerce_sumup_test_client_id' ).parents( 'tr' ).eq( 0 ),
					test_client_secret = $( '#woocommerce_sumup_test_client_secret' ).parents( 'tr' ).eq( 0 ),
					test_pay_to_email = $( '#woocommerce_sumup_test_pay_to_email' ).parents( 'tr' ).eq( 0 ),
					client_id = $( '#woocommerce_sumup_client_id' ).parents( 'tr' ).eq( 0 ),
					client_secret = $( '#woocommerce_sumup_client_secret' ).parents( 'tr' ).eq( 0 ),
					pay_to_email = $( '#woocommerce_sumup_pay_to_email' ).parents( 'tr' ).eq( 0 );

				if ( $( this ).is( ':checked' ) ) {
					test_client_id.show();
					test_client_secret.show();
					test_pay_to_email.show();
					client_id.hide();
					client_secret.hide();
					pay_to_email.hide();
				} else {
					test_client_id.hide();
					test_client_secret.hide();
					test_pay_to_email.hide();
					client_id.show();
					client_secret.show();
					pay_to_email.show();
				}
			} );

			$( '#woocommerce_sumup_testmode' ).change();

		}
	};

	wc_sumup_admin.init();
} );

jQuery(function($) { 
	$(function () {
    var $checkout_form = $('form.checkout');
    var MODES = {
      GET: 'get-checkout-id',
      READY: 'ready-to-process',
      AUTH: 'auth-screen',
      PROCESSING: 'processing'
    };
    var mode = MODES.GET;
    var checkoutId;
    var sumupGateway;
    var sendingDataToSumUp = false;
    var sendingDataToServer = false;

    function onResponse(type, body) {
      sendingDataToSumUp = false;
      switch (type) {
        case 'sent':
          /* Sending data */
          break;
        case 'invalid':
          /* Validation errors in the card widget */
          displayError('<div class="woocommerce-error">' + sumup_gateway_params.errors.invalid_form + '</div>');
          mode = MODES.GET;
          break;
        case 'auth-screen':
          /* Auth screen is opened to the user */
          unblockScreen();
          scrollToCard();
          break;
        case 'error':
          console.error('Error', body);
          displayError('<div class="woocommerce-error">' + sumup_gateway_params.errors.general_error + '</div>');
          mode = MODES.GET;
          break;
        case 'success':
          if (body.status !== 'PAID') {
            mode = MODES.GET;
            displayError('<div class="woocommerce-error">' + sumup_gateway_params.errors.general_error + '</div>');
          } else {
            mode = MODES.PROCESSING;
            sumup_gateway_params.transactionCode = body.transaction_code;
            onSubmit();
          }
          break;
      }
    }

    function initSumUpGateway() {
      sumupGateway = SumUpCard.mount({
        checkoutId: 'demo',
        onResponse: onResponse,
        showSubmitButton: false,
        showZipCode: sumup_gateway_params.showZipCode === 'true',
        locale: sumup_gateway_params.locale,
        showFooter: false,
      });
    }

    $('body').on('sumupCardInit', function() {
      initSumUpGateway();
    });

    function onSubmit() {
      if (!isSumUpGatewaySelected()) {
        return true; /* return true so not to prevent other plugins from submitting */
      }

      if (sendingDataToSumUp || sendingDataToServer || mode === MODES.AUTH) {
        return false;
      }

      var additionalData = '';
      if (mode === MODES.GET) {
        additionalData = '&sumup_get_checkout_id=1';
      } else if (mode === MODES.READY) {
        sumupGateway.submit();
        sendingDataToSumUp = true;
        return false; /* Submit just the card details to SumUp */
      } else if (mode === MODES.PROCESSING) {
        additionalData = '&sumup_process=1';
        additionalData += '&sumup_checkout_id=' + sumup_gateway_params.checkoutId;
        additionalData += '&sumup_transaction_code=' + sumup_gateway_params.transactionCode;
      }

      $.ajax({
        type: 'POST',
        url: wc_checkout_params.checkout_url,
        data: $checkout_form.serialize() + additionalData,
        dataType: 'json',
        beforeSend: function() {
          sendingDataToServer = true;
          blockScreen();
        },
        success: function(result) {
          sendingDataToServer = false;
          try {
            if (result.result === 'sumup_payment_info') {
              sumup_gateway_params.checkoutId = result.checkout_id;
              sumupGateway.update({ checkoutId: result.checkout_id });
              mode = MODES.PROCESSING;
              sumupGateway.submit();
            } else if (result.result === 'success' && result.redirect) {
              window.location.href = result.redirect;
            } else if (result.result === 'fail') {
              displayError('<div class="woocommerce-error">' + wc_checkout_params.i18n_checkout_error + '</div>');
            } else {
              throw 'Invalid response';
            }
          } catch(err) {
            if (typeof result.messages != "undefined") {
              displayError(result.messages);
            } else {
              displayError('<div class="woocommerce-error">' + wc_checkout_params.i18n_checkout_error + '</div>');
            }
          }
        },
        error: function(jqXHR, textStatus, errorThrown) {
          sendingDataToServer = false;
          displayError('<div class="woocommerce-error">' + errorThrown + '</div>');
        }
      });

      return false; /* return false to preventDefault */
    }

    function displayError(error_message) {
			$('.woocommerce-NoticeGroup-checkout, .woocommerce-error, .woocommerce-message').remove();
			$checkout_form.prepend('<div class="woocommerce-NoticeGroup woocommerce-NoticeGroup-checkout">' + error_message + '</div>');
      unblockScreen();
			$checkout_form.find('.input-text, select, input:checkbox').trigger('validate').blur();
			scrollToNotices();
			$(document.body).trigger('checkout_error');
    }

		function scrollToNotices() {
			var scrollElement = $('.woocommerce-NoticeGroup-updateOrderReview, .woocommerce-NoticeGroup-checkout');

			if (! scrollElement.length) {
				scrollElement = $checkout_form;
			}
			$.scroll_to_notices(scrollElement);
    }

    function scrollToCard() {
			var scrollElement = $('#sumup-card');

			$.scroll_to_notices(scrollElement);
    }
    
    function blockScreen() {
      $checkout_form.block({ message: null });
    }

    function unblockScreen() {
      $checkout_form.unblock();
    }

    function isSumUpGatewaySelected() {
      return $('#payment_method_sumup').is(':checked');
    }

    function prepareToGetCheckoutId() {
      mode = MODES.GET;
    }

    $(function() { prepareToGetCheckoutId(); });
    $('body').on('updated_checkout', prepareToGetCheckoutId);
    $('body').on('payment_method_selected', prepareToGetCheckoutId);
    $('form.woocommerce-checkout').on('checkout_place_order_sumup', onSubmit);
  });
});
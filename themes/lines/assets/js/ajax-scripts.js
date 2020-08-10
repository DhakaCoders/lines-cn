(function($) {

  $("#homedeliverBtn").on('click', function(e) {
      e.preventDefault();
      $.ajax({
          url: popupcheck_object.ajaxurl,
          dataType: 'JSON',
          type: 'post',
          data: {
              check: 1,
              action: 'popupcheckCode'
          },
          beforeSend: function ( xhr ) {

          },
          error: function(response) {
              console.log(response);
          },
          success: function(response) {
              console.log(response);
              //check
              if (response == 0) {
                  
              } else {
                  function redirect_page(){
                    window.location.href = '';
                  }
                  setTimeout(redirect_page,1000);
              }
          }
      });
  });
})(jQuery);

function popupCheckPostcode(){
        jQuery.ajax({
          url: popupcheck_object.ajaxurl,
          dataType: 'JSON',
          type: 'post',
          data: {
              check: 1,
              action: 'popupcheckCode'
          },
          beforeSend: function ( xhr ) {

          },
          error: function(result) {
              console.log(result);
          },
          success: function(result) {
              console.log(result);
              //check
              if (typeof(result['success']) != "undefined" &&  result['success'].length != 0 && result['success'] == 'success') {
                  function redirect_page(){
                    window.location.href = '';
                  }
                  setTimeout(redirect_page,1000); 
              } else {

              }
          }
      });
        return false;
}
function submitPostalCode(){
  var serialized = jQuery( '#postalcodecheck' ).serialize();
  jQuery.ajax({
      type: 'post',
      dataType: 'JSON',
      url: checkpostalcode_object.ajaxurl,
      data: serialized,
      beforeSend: function() {    

      },
      success: function( result ) {
          if( typeof(result['match']) != "undefined" &&  result['match'].length != 0 && result['match'] == 'match') {
            jQuery('#msg-wrapp').html('<div class="matching-msg yes"><p><strong>Awesome!</strong>'+ 
              'We can deliver our delicious hot food and cold beers straight to your door.</p>'+
              '<div class="order-home-deli-btn-cntlr">'+
              '<form id="homedelivery" onsubmit="popupCheckPostcode(); return false"><button class="order-home-deli-btn" id="homedeliveryBtn">order home delivery</button></form>'+
              '</div></div>');
          } else if( typeof(result['notmatch']) != "undefined" &&  result['notmatch'].length != 0 && result['notmatch'] == 'notmatch'){
              jQuery('#msg-wrapp').html('<div class="matching-msg not"><p><strong>We\'re sorry!</strong>'+ 
              'We currently don\'t offer local delivery in your area. You can still order beers and merch for national delivery.</p>'+
              '<div class="order-home-deli-btn-cntlr">'+
              '<button class="order-home-deli-btn">order home delivery</button>'+
              '</div></div>');
          }else{
              console.log('error');
          }
      },
      error: function (jqXHR, textStatus, errorThrown) {
          if (jqXHR.status == 500) {
            console.log('Internal error: ' + jqXHR.responseText);
          } else {
            console.log('Unexpected error.');
          }
      }
  })
  return false;
}
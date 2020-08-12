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
                      var user = getCookie("hpopup");
                      if (user != "") {

                      } else {
                        setCookie("hpopup", 'true', 30);
                      }
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
              '<button onclick="redirectBeersPage(); return false" class="order-home-deli-btn">order national delivery</button>'+
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

function redirectBeersPage(){
  var beersURL = '';
  console.log('Internal error');
  if( jQuery("#beers_url").length ){
    beersURL = jQuery("#beers_url").data('pageurl');
    window.location.href = beersURL;
  }
}


function setCookie(cname, cvalue, exdays) {
  var d = new Date();
  d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
  var expires = "expires="+d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
  var name = cname + "=";
  var ca = document.cookie.split(';');
  for(var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}
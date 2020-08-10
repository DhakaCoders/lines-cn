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
        console.log(result);
          if( typeof(result['match']) != "undefined" &&  result['match'].length != 0 && result['match'] == 'match') {
            jQuery('#msg-wrapp').html('<div class="matching-msg yes"><p><strong>Awesome!</strong>'+ 
              'We can deliver our delicious hot food and cold beers straight to your door.</p>'+
              '<div class="order-home-deli-btn-cntlr">'+
              '<button class="order-home-deli-btn">order home delivery</button>'+
              '</div></div>');
              console.log('Match');
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
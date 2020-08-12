(function($) {

/*Google Map Style*/
var CustomMapStyles  = [{"featureType":"water","elementType":"geometry","stylers":[{"color":"#e9e9e9"},{"lightness":17}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#ffffff"},{"lightness":29},{"weight":.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":16}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":21}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#dedede"},{"lightness":21}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"lightness":16}]},{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#333333"},{"lightness":40}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#f2f2f2"},{"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#fefefe"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#fefefe"},{"lightness":17},{"weight":1.2}]}]

var windowWidth = $(window).width();
$('.navbar-toggle').on('click', function(){
	$('#mobile-nav').slideToggle(300);
});
	

$('.fl-modal-des-btm-form input').focus(function(){
   $(this).removeAttr('placeholder');
});

/*$(window).scroll(function(){
  var sticky = $('header.header'),
      scroll = $(window).scrollTop();

  if (scroll >= 300) $('body').addClass('hasSticky');
  else $('body').removeClass('hasSticky');
});
  */

  
//matchHeightCol
if($('.mHc').length){
  $('.mHc').matchHeight();
};
if($('.mHc1').length){
  $('.mHc1').matchHeight();
};
if($('.mHc2').length){
  $('.mHc2').matchHeight();
};
if($('.mHc3').length){
  $('.mHc3').matchHeight();
};
if($('.mHc4').length){
  $('.mHc4').matchHeight();
};
if($('.mHc5').length){
  $('.mHc5').matchHeight();
};

if( $('.df-page-bnr').length ){
  var itemH = $('.df-page-bnr').height();
  var itemH1 = itemH + 200;
  console.log(itemH);
  $(window).scroll(function(){
    console.log($(document).scrollTop());
    if( $(document).scrollTop() > itemH1 ){
      $('body').addClass('globe-active');
    }else{
      $('body').removeClass('globe-active');
    }
  });
}else{
  $('body').addClass('globe-active');
}
if( $('.main-slider-sec').length ){
  var itemH2 = $('.main-slider-sec').height();
  var itemH3 = itemH2 + 200;
  console.log(itemH2);
  $(window).scroll(function(){
    console.log($(document).scrollTop());
    if( $(document).scrollTop() > itemH3 ){
      $('body').addClass('globe-active');
    }else{
      $('body').removeClass('globe-active');
    }
  });
}
/*$(window).scroll(function(){
  console.log($(document).scrollTop());
  if( $(document).scrollTop() > 400 ){
    $('body').addClass('has-fixed-menu');
  }else{
    $('body').removeClass('has-fixed-menu');
  }
});*/
//$('[data-toggle="tooltip"]').tooltip();

//banner animation
$(window).scroll(function() {
  var scroll = $(window).scrollTop();
  $('.page-banner-bg').css({
    '-webkit-transform' : 'scale(' + (1 + scroll/2000) + ')',
    '-moz-transform'    : 'scale(' + (1 + scroll/2000) + ')',
    '-ms-transform'     : 'scale(' + (1 + scroll/2000) + ')',
    '-o-transform'      : 'scale(' + (1 + scroll/2000) + ')',
    'transform'         : 'scale(' + (1 + scroll/2000) + ')'
  });
});
/*$(window).scroll(function() {
  var scroll = $(window).scrollTop();
  $('.section-graphics-top').css({
    'margin-top' : -(1 + scroll/20)
  });
});*/


if($('.fancybox').length){
$('.fancybox').fancybox({
    //openEffect  : 'none',
    //closeEffect : 'none'
  });

}


// if (windowWidth <= 767) {
  $('.toggle-btn').on('click', function(){
    $(this).toggleClass('menu-expend');
    $('.toggle-bar ul').slideToggle(500);
  });

/**
Slick slider
*/
if( $('.responsive-slider').length ){
    $('.responsive-slider').slick({
      dots: true,
      infinite: false,
      autoplay: true,
      autoplaySpeed: 2000,
      speed: 300,
      slidesToShow: 4,
      slidesToScroll: 4,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            infinite: true,
            dots: true
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
    });
}






if( $('#mapID').length ){
var latitude = $('#mapID').data('latitude');
var longitude = $('#mapID').data('longitude');

var myCenter= new google.maps.LatLng(latitude,  longitude);
function initialize(){
    var mapProp = {
      center:myCenter,
      mapTypeControl:true,
      scrollwheel: false,
      zoomControl: true,
      disableDefaultUI: true,
      zoom:19,
      streetViewControl: false,
      rotateControl: true,
      mapTypeId:google.maps.MapTypeId.ROADMAP
      };

    var map= new google.maps.Map(document.getElementById('mapID'),mapProp);
    var marker= new google.maps.Marker({
      position:myCenter,
        //icon:'map-marker.png'
      });
    marker.setMap(map);
}
google.maps.event.addDomListener(window, 'load', initialize);

}




/*$('.hdr-humbergur-btn').on('click', function(){
  $(this).toggleClass('menu-expend');
  $('.hdr-toogle-menu').slideToggle(300);
});*/


if( $('.events-mainSlider').length ){
    $('.events-mainSlider').slick({
      dots: true,
      infinite: false,
      autoplay: true,
      autoplaySpeed: 2000,
      speed: 1000,
      slidesToShow: 1,
      slidesToScroll: 1,
      infinite: true
    });
}




if( $('.rpSlider').length ){

    $('.rpSlider').on('init', function (event, slick, direction) {
        if (!($('.rpSlider .slick-slide').length > 1)) {
            // remove arrows
            $('.rp-slider-arrow .slick-arrow').hide();
        }

    });

    $('.rpSlider').slick({
      dots: false,
      infinite: false,
      speed: 1000,
      slidesToShow: 3,
      slidesToScroll: 1,
      prevArrow: $('.rp-slider-arrow .rp-slider-left'),
      nextArrow: $('.rp-slider-arrow .rp-slider-rgt'),
      responsive: [
        {
          breakpoint: 992,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
    });
}


$(".bth-tab-btn ul li button").click(function(){
  var tagid = $(this).data('tag');
  $(".bth-tab-btn ul li button").removeClass('current');
  $(".bth-tab-content").removeClass('current');
  $(this).addClass('current');
  $("#"+tagid).addClass('current');

});


if( $('.mainSlider').length ){
    $('.mainSlider').slick({
      dots: true,
      infinite: true,
      autoplay: true,
      autoplaySpeed: 4000,
      speed: 700,
      slidesToShow: 1,
      slidesToScroll: 1,
      fade: true,
      cssEase: 'linear'
    });
}


$('.hdr-humbergur-btn').on('click', function(e){
    $('.xs-nav-cntlr').addClass('opacity-1');
    $('.bdoverlay').addClass('active');
    $('body').addClass('active-scroll-off');
  });
  $('.menu-closebtn').on('click', function(e){
    $('.bdoverlay').removeClass('active');
    $('.xs-nav-cntlr').removeClass('opacity-1');
    $('body').removeClass('active-scroll-off');
    $('.hdr-humbergur-btn').removeClass('menu-expend');
  });
  
  $('li.menu-item-has-children > a').on('click', function(e){
    e.preventDefault();
    $(this).parent().siblings().find('.sub-menu').slideUp(300);
    $(this).parent().find('.sub-menu').slideToggle(300);
    $(this).toggleClass('sub-menu-active');
  });

$('.enter-now-btn').on('click', function(e){
  e.preventDefault();
  $('.home-overlay').fadeOut(300);
});


$('.qty').each(function() {
  var spinner = $(this),
    input = spinner.find('input[type="number"]'),
    btnUp = spinner.find('.plus'),
    btnDown = spinner.find('.minus'),
    min = 1,
    max = input.attr('max');

  btnUp.click(function() {
    var oldValue = parseFloat(input.val());
    if (oldValue <= max) {
      var newVal = oldValue;
    } else {
      var newVal = oldValue + 1;
    }
    spinner.find("input").val(newVal);
    spinner.find("input").trigger("change");
  });

  btnDown.click(function() {
    var oldValue = parseFloat(input.val());
    if (oldValue <= min) {
      var newVal = oldValue;
    } else {
      var newVal = oldValue - 1;
    }
    spinner.find("input").val(newVal);
    spinner.find("input").trigger("change");
  });

});


if($("#catID").length){
  var catID = $("#catID").data('id');
}

$("#loadMore").on('click', function(e) {
    e.preventDefault();
    var catid = '';
    if(catID != ''){
      catid = catID;
    }
    //init
    var that = $(this);
    var page = $(this).data('page');
    var newPage = page + 1;
    var ajaxurl = that.data('url');
    console.log(newPage);
    //ajax call
    $.ajax({
        url: ajaxurl,
        type: 'post',
        data: {
            page: page,
            catid: catid,
            action: 'ajax_post_script_load_more'
        },
        beforeSend: function ( xhr ) {
            $('#ajxaloader').show();
        },
        error: function(response) {
            console.log(response);
        },
        success: function(response) {
            console.log(response);
            //check
            if (response == 0) {
                $('#loadMore').hide();
                $('#ajxaloader').hide();
            } else {
                $('#ajxaloader').hide();
                that.data('page', newPage);
                $('#post-content').append(response.substr(response.length-1, 1) === '0'? response.substr(0, response.length-1) : response);
            }
        }
    });
});

$('#hasList li').each(function(index, el){
  if( index >= 5 ){
    var ind = index - 5;
    var val = 0.4;
    var val2 = val * ind;
    var val3 = val2+'s'; 
  }else{
    var val = 0.4;
    var val2 = val * index;
    var val3 = val2+'s';
  }
  $(this).attr('data-wow-delay', val3);
});

new WOW().init();


/*$("document").ready(function(){
  "use strict";
  $(window).on("scroll",function(e){scrollTimer||(scrollTimer=!0,requestAnimationFrame(handleScroll))})});
var scrollTimer=!1;
function handleScroll(){
  var e=$(".slideContentInner"),
  t=$(".bannerContentInner"),
  i=$(".slideBg img"),
  n=$(".bannerBg img"),
  s=Math.max($(".sliderContainer").height(),100),
  o=(Math.max($(".banner").height(),100),$(window).height()),
  r=$(window).scrollTop(),a=Math.round(300*(r-$("#header").outerHeight())/o),
  l=1-.003*r,
  c=!($("#header").outerHeight()>r);
  0<$(".flyoutActive").length||("ontouchstart"in document.documentElement==!1&&
    $(".siteWrapper ").outerHeight()>s+o&&
    (!1===c&&(a=0,l=1),
      n.css({transform:"translateY("+a+"px)"}),
      i.css({transform:"translate(-50%, "+a+"px)"}),
      e.css({opacity:l}),t.css({opacity:l})),
    $(".js_scrollFadeIn").not(".fadeIn").each(function(e,t){hasReached(t)&&($(t).removeClass("js_scrollFadeIn").addClass("js_fadeIn"),fadeInBlock($(t)))}),scrollTimer=!1)}function siteWideMessage(){"use strict";var e=$(".siteWideMessage");matchesMediaQuery("mobile")?e.hasClass("slick-initialized")&&e.slick("unslick"):e.hasClass("slick-initialized")||e.slick({initialSlide:1,infinite:!0,arrows:!1,dots:!1,autoplay:!0,autoplaySpeed:3500,slidesToShow:1,slidesToScroll:1,adaptiveHeight:!0})}
*/

if( $('.pro_delivery_modal_01').length ){
  $('.pro_delivery_modal_01').modal('show');
}
$('body').addClass('globeshow');
})(jQuery);
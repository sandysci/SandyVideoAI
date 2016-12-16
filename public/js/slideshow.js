 (function($) {

  $(window).load(function() {

    $('.thumbnail_slider.flexslider').flexslider({
        animation: "fade",
        controlsContainer: '.flex-container'

    });

    $('.header_slider.flexslider').flexslider({
        animation: "fade",
        controlsContainer: '.flex-container'

    });


  });

})(jQuery)
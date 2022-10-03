require(['jquery','owlcarousel'],function($){
    $(document).ready(function(){
        if($('.table-wrapper.orders-history .carousel-wrap .owl-carousel').length){
            if(typeof($.fn.owlCarousel)!='function'){
                var tableCaraousel = setInterval(function () {
                    if(typeof($.fn.owlCarousel)=='function'){
                        $('.table-wrapper.orders-history .carousel-wrap .owl-carousel').owlCarousel({
                            autoPlay: 3000,
                            margin:5,
                            items : 1,
                            // items : 5,
                            itemsDesktop : [1199,5],
                            itemsDesktopSmall : [979,5],
                            itemsTablet : [768,5],
                            navigation : true,
                            pagination : false
                        })
                        clearTimeout(tableCaraousel);
                    }
                },500);
            }
        }
    });
});
require(['jquery','owlcarousel'],function($){
    $(document).ready(function(){
        if($('.carousel-wrap .owl-carousel').length){
            if(typeof($.fn.owlCarousel)!='function'){
                var wrapCaraousel = setInterval(function () {
                    if(typeof($.fn.owlCarousel)=='function'){
                        $('.carousel-wrap .owl-carousel').owlCarousel({
                            autoPlay: 3000,
                            margin:5,
                            // items : 3,
                            items : 5,
                            itemsDesktop : [1199,5],
                            itemsDesktopSmall : [979,5],
                            itemsTablet : [768,5],
                            navigation : true,
                            pagination : false
                        })
                        clearTimeout(wrapCaraousel);
                    }
                },500);
            }
        }
    });
});



/**
 * Created By : Rohan Hapani
 
require(['jquery', 'owlcarousel'], function($) {
    $(document).ready(function() {
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 20,
            nav: true,
            navText: [
                "<i class='fa fa-caret-left'></i>",
                "<i class='fa fa-caret-right'></i>"
            ],
            autoplay: true,
            autoplayHoverPause: true,
            
            responsive: {
                0: {
                  items: 1
                },
                600: {
                  items: 5
                },
                1000: {
                  items: 10
                }
            }
        });
    });
});*/
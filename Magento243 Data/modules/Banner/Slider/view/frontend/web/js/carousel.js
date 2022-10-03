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
                            items : 1,
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
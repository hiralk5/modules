require(['jquery','owlcarousel'],function($){
    $(document).ready(function(){
          $('.carousel-wrap .owlslider').owlCarousel({
                autoPlay: 3000,
                margin:5,
                items : 5,
                itemsDesktop : [1199,5],
                itemsDesktopSmall : [979,5],
                itemsTablet : [768,5],
                navigation : true,
                pagination : false
        })
    });
});
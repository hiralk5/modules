define([
    'jquery'
    ], function($){
        setTimeout(function(){
            var product_id = $('.catalog-product-view form input[name="product"]').val();
            var price = $('.catalog-product-view .product-info-price span#product-price-'+product_id+' span.price').html();
            price = price.split(".");
            final_price = price[0] +'.'+ price[1].sup();
            $('.catalog-product-view .product-info-price span#product-price-'+product_id+' span.price').html(final_price);

            //special price
            var specialprice = $('.catalog-product-view .product-info-price .special-price span#product-price-'+product_id+' span.price').html();
            specialprice = specialprice.split(".");
            final_price = specialprice[0] +'.'+ specialprice[1].sup();
            $('.catalog-product-view .product-info-price span#product-price-'+product_id+' span.price').html(final_price);

            var oldprice = $('.catalog-product-view .product-info-price .old-price span#old-price-'+product_id+' span.price').html();
            oldprice = oldprice.split(".");
            final_price = oldprice[0] +'.'+ oldprice[1].sup();
            $('.catalog-product-view .product-info-price span#old-price-'+product_id+' span.price').html(final_price);

            var listingpageprice = $('.product-item-details .price-final_price .price-container span#product-price-'+product_id+' span.price').html();
            listingpageprice = listingpageprice.split(".");
            final_price = listingpageprice[0] +'.'+ listingpageprice[1].sup();
            $('.catalog-product-view .product-info-price span#old-price-'+product_id+' span.price').html(final_price);

            var oldprice = $('.product-item-details .price-final_price .special-price span#product-price-'+product_id+' span.price').html();
            oldprice = oldprice.split(".");
            final_price = oldprice[0] +'.'+ oldprice[1].sup();
            $('.catalog-product-view .product-info-price span#old-price-'+product_id+' span.price').html(final_price);

        },
    100);
});
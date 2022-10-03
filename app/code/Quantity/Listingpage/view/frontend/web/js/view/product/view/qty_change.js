define([
    'jquery',
    'jquery/ui'
    ], function($){
        'use strict';
        return function(config) {
            let currentQty = config.default_qty;
            $(document).on('click', '.field.qty .decreaseQty', function(){
                //$('input[name=qty').val(parseInt($("#qty").val()) + parseInt(1));
                var product_id = $(this).attr('data-productid');
                var qty = parseInt($('.field.qty #qty_'+product_id).val());
                if(qty>1) {
                    $('.field.qty #qty_'+product_id).val(qty-1);
                }
            });
            $(document).on('click', '.field.qty .increaseQty', function(){
                // $('input[name=qty').val(parseInt($("#qty").val()) - parseInt(1));
                var product_id = $(this).attr('data-productid');
                var qty = parseInt($('.field.qty #qty_'+product_id).val());
                $('.field.qty #qty_'+product_id).val(qty+1);
            });
        }
    }
);

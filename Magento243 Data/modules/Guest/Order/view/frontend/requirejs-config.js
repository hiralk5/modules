
var config = {
	config: {
	    mixins: {
	       'Magento_Checkout/js/action/set-shipping-information': {
                'Guest_Order/js/action/set-shipping-information-mixin': true
            },
            'Magento_Checkout/js/action/place-order': {
            	'Guest_Order/js/order/place-order-mixin': true
        	}
	    }
	}
};	
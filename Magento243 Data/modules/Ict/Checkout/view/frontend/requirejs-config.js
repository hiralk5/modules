var config = {
    /*"map": {
        "*": {
            'Magento_Checkout/js/model/shipping-save-processor/default': 'Ict_Checkout/js/model/shipping-save-processor/default'
        }
    }*/
    config: {
        mixins: {
            'Magento_Checkout/js/model/shipping-save-processor/payload-extender': {
                'Ict_Checkout/js/model/shipping-save-processor/payload-extender-mixin': true
            }
        }
    }
};
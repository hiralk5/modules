define(
    [
        'jquery',
        'ko',
        'Magento_Ui/js/form/form',
        'Magento_Customer/js/model/customer'
    ],
    function ($, ko, Component,customer) {
        "use strict";

        return Component.extend({
            defaults: {
                template: 'Guest_Order/checkout/is-guest-block'
            },
            isGuest: true,
            isLoggedIn: function () {
                isGuest: false
            }
         
        });
    }
);
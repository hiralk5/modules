define([
    'uiComponent',
    'Magento_Customer/js/model/customer'
], function (
    Component,
    customer
) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'Minicart_Spanusername/username'
        },

        isLoggedIn: function () {
            return customer.isLoggedIn();
        },

        getDetails: function() {
            return customer.getDetails();
        }

    });
});
define([
    'jquery',
    'ko',
    'Magento_Ui/js/form/form',
    'Magento_Customer/js/model/customer'
], function ($, ko, Component,customer) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'Isguest_Order/is-guest-custom'
        },
        initialize: function () {
            this._super();
        },
        initObservable: function () {
            this._super()
                .observe({
                    isGuest: ko.observable(true)
                });
                
            return this;
        },
        isLoggedIn: function () {
            return customer.isLoggedIn();
        }
         
    });
});
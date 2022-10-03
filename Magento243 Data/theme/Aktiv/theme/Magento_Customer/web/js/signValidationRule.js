define([
    'jquery',
    'jquery/ui',
    'jquery/validate',
    'mage/translate'
    ], function($){
        'use strict';
        return function() {
            $.validator.addMethod(
                "signvalidationrule",
                function (value) {
                var re= /^[ A-Za-z0-9_!#$%^&*(){}|:"'.,<>/+-]*$/;
                return re.test(value);
            },
            $.mage.__('@ sign not allowed')
            );
        }
    });
define(
    [
        'jquery', 
        'underscore', 
        'mage/utils/wrapper'
    ], function ($, _, wrapper) {
    'use strict';
    return function (payloadExtender) {
        return wrapper.wrap(payloadExtender, function (originalPayloadExtender, payload) {
            originalPayloadExtender(payload);
            _.extend(payload.addressInformation.extension_attributes,
                {
                    'isguest': $('[name="isguest"]').val()
                }
            );
            return payload;
        });
    };
});
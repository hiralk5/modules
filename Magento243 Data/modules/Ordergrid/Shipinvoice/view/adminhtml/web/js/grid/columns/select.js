define([
    'underscore',
    'jquery',
    'Magento_Ui/js/grid/columns/select'
], function (_, $, Column) {
    'use strict';

    return Column.extend({
        defaults: {
            bodyTmpl: 'Ordergrid_Shipinvoice/ui/grid/cells/select'
        },
        changeShipOption: function(event, parent, data){
            event.preventDefault();
            window.obP = parent;
            window.obD = data;
            //console.log(value.value);
        }
    });
});
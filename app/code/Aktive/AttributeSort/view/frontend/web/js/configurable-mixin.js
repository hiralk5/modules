define(['jquery'], function ($) {
    'use strict';

    return function (configurable) {
        $.widget('mage.configurable', $['mage']['configurable'], {
            _fillSelect: function (element) {
                    var attributeId = element.id.replace(/[a-z]*/, ''),
                    options = this._getAttributeOptions(attributeId),
                    prevConfig,
                    index = 1,
                    allowedProducts,
                    i;

                this._clearSelect(element);
                options = options.sort(function (a, b) {
                    return a.label.localeCompare( b.label);
                });
                element.options[0] = new Option('', '');
                element.options[0].innerHTML = this.options.spConfig.chooseText;
                prevConfig = false;

                if (options) {
                    for (i = 0; i < options.length; i++) {
                        allowedProducts = [];
                        if (prevConfig) {
                        } else {
                            allowedProducts = options[i].products.slice(0);
                        }

                        if (allowedProducts.length > 0) {
                            element.options[index] = new Option(this._getOptionLabel(options[i]), options[i].id);
                            element.options[index].config = options[i];
                            index++;
                        }
                        /* eslint-enable max-depth */
                    }
                }
            }
        });
        return $['mage']['configurable'];
    };
});
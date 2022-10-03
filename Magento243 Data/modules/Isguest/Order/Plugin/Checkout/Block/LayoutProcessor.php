<?php
namespace Isguest\Order\Plugin\Checkout\Block;


class LayoutProcessor
{

     public function afterProcess(
        \Magento\Checkout\Block\Checkout\LayoutProcessor $subject,
        array $jsLayout
    ) {
        
        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
        ['shippingAddress']['children']['shippingAdditional'] = [
            'component' => 'uiComponent',
            'displayArea' => 'shippingAdditional',
            'children' => [
                'is_guest' => [
                    'component' => 'Isguest_Order/js/view/isguest-checkbox',
                    'displayArea' => 'isguest',
                    'deps' => 'checkoutProvider',
                    'dataScopePrefix' => 'isguest',
                    'children' => [
                        'form-fields' => [
                            'component' => 'uiComponent',
                            'displayArea' => 'isguest',
                            'children' => [
                                
                                'is_guest' => [
                                    'component' => 'Magento_Ui/js/form/element/single-checkbox',
                                    'config' => [
                                        'customScope' => 'is_guest',
                                        'template' => 'ui/form/field',
                                        'elementTmpl' => 'ui/form/element/checkbox-set',
                                        'options' => [],
                                        'id' => 'is_guest'
                                    ],
                                    'dataScope' => 'is_guest.is_guest',
                                    'label' => 'Comment',
                                    'provider' => 'checkoutProvider',
                                    'visible' => true,
                                    'validation' => [],
                                    'sortOrder' => 20,
                                    'id' => 'is_guest'
                                ]
                            ],
                        ],
                    ]
                ]
            ]
        ];

        return $jsLayout;
    }
    /*public function afterProcess(
        \Magento\Checkout\Block\Checkout\LayoutProcessor $subject,
        array $jsLayout
    ) {


        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
        ['shippingAddress']['children']['before-shipping-method-form'] = [
            'component' => 'uiComponent',
            'displayArea' => 'before-shipping-method-form',
            'provider' => 'checkoutProvider',
            'deps' => 'checkoutProvider',
            'children' => [
                'is_guest' => [
                    'component' => 'Isguest_Order/js/view/isguest-checkbox',
                    'displayArea' => 'before-shipping-method-form',
                    'deps' => 'checkoutProvider',
                    'dataScopePrefix' => 'is_guest',
                    'children' => [
                        'form-fields' => [
                            'component' => 'uiComponent',
                            'displayArea' => 'isguest-checkbox',
                            'children' => [
                                
                                'is_guest' => [
                                    'component' => 'Magento_Ui/js/form/element/single-checkbox',
                                    'config' => [
                                        'customScope' => 'is_guest',
                                        'template' => 'ui/form/field',
                                        'prefer' => 'checkbox',
                                        'options' => [],
                                        'id' => 'is_guest'
                                    ],
                                    'dataScope' => 'shippingAddress.is_guest',
                                    'label' => 'Is Guest',
                                    'provider' => 'checkoutProvider',
                                    'visible' => true,
                                    'validation' => [],
                                    'sortOrder' => 20,
                                    'id' => 'is_guest'
                                ]
                            ],
                        ],
                    ]
                ]
            ]
        ];

        return $jsLayout;
    }*/
}
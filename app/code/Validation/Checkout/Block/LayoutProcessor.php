<?php
namespace Validation\Checkout\Block;

class LayoutProcessor
{
    /**
     * @param \Magento\Checkout\Block\Checkout\LayoutProcessor $subject
     * @param array $jsLayout
     * @return array
     */
    public function afterProcess(
       \Magento\Checkout\Block\Checkout\LayoutProcessor $subject,
       array $jsLayout
    ) {
        // Firstname
        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
                ['shippingAddress']['children']['shipping-address-fieldset']['children']['firstname']['validation']= ['required-entry' => true, 'letters-only' => true];

        // Lastname
        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
                ['shippingAddress']['children']['shipping-address-fieldset']['children']['lastname']['validation']=['required-entry' => true, 'letters-only' => true];

        // Telephone
        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
                ['shippingAddress']['children']['shipping-address-fieldset']['children']['telephone']['validation']=['required-entry' => true, 'integer' => true , 'min_text_length' => 10, 'max_text_length' => 10 ];

        return $jsLayout;
    }
}

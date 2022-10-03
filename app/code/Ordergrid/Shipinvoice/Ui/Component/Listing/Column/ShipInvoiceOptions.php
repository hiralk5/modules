<?php

namespace Ordergrid\Shipinvoice\Ui\Component\Listing\Column;

class ShipInvoiceOptions implements \Magento\Framework\Option\ArrayInterface
{
    //Here you can __construct Model

    public function toOptionArray()
    {
        
        return [
            ['value' => 'ship', 'label' => __('Shipment')],
            ['value' => 'invoice', 'label' => __('Invoice')]
        ];
    }
}
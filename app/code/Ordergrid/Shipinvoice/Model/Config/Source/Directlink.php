<?php
namespace Ordergrid\Shipinvoice\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

class Directlink implements ArrayInterface
{
    public function toOptionArray()
    {
        $result = [];
        foreach ($this->getOptions() as $value => $label) {
            $result[] = [
                 'value' => $value,
                 'label' => $label,
             ];
        }

        return $result;
    }

    public function getOptions()
    {
        return [
            'shipping' => __('Shipping'),
            'invoice' => __('Invoice'),
        ];
    }
}
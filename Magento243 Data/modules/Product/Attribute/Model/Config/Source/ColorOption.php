<?php

namespace Product\Attribute\Model\Config\Source;
use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class ColorOption extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    public function getAllOptions()
    {
        $this->_options = [
                ['label' => __('No'), 'value'=>'no'],
                ['label' => __('Yes'), 'value'=>'yes'],
                ['label' => __('Other'), 'value'=>'other']
            ];

    return $this->_options;

    }
}
        
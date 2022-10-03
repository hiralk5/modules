<?php

namespace Label\Product\Model\Config\Source;
use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class LabelOptions extends AbstractSource
{
    public function getOptionArray()
    {
        $options = [];
        $options['upperleft'] = (__('Upper Left'));
        $options['upperright'] = (__('Upper Rigth'));
        $options['lowerleft'] = (__('Lower Left'));
        $options['lowerright'] = (__('Lower Right'));
        return $options;
       
    }

    public function getAllOptions()
    {
        $res = $this->getOptions();
        array_unshift($res, ['value' => '', 'label' => '']);
        return $res;
    }

    public function getOptions()
    {
        $res = [];
        foreach ($this->getOptionArray() as $index => $value) {
            $res[] = ['value' => $index, 'label' => $value];
        }
        return $res;
    }

    public function toOptionArray()
    {
        return $this->getOptions();
    }
}
        
<?php

namespace Category\Attribute\Model\Config\Source;
use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class ColorOption extends AbstractSource
{
        public function getOptionArray()
    {
        $options = [];
        $options['green'] = (__('Green'));
        $options['red'] = (__('Red'));
        $options['blue'] = (__('Blue'));
        $options['white'] = (__('White'));
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
        
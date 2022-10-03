<?php
 
namespace Product\Attribute\Model\Config\Source;

use Magento\Eav\Model\Attribute;
use Magento\Eav\Model\AttributeRepository;
use Magento\Framework\Api\SearchCriteriaBuilder;
 
use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
 
class MaterialSelection extends AbstractSource
{
 
    protected $attributeInfo;
    protected $options;
   
    public function getAllOptions()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $eavConfig = $objectManager->get('\Magento\Eav\Model\Config');
        $attribute = $eavConfig->getAttribute('catalog_product','material');//->setStoreId(0);
        $options = $attribute->getSource()->getAllOptions();
        array_unshift($options, ['value' => '', 'label' => '']);
        return $options;
    }
 
    public function toOptionArray()
    {
        return $this->getAllOptions();
    }
}
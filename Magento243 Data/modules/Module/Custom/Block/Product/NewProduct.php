<?php

namespace Module\Custom\Block\Product;

use Magento\Catalog\Block\Product\ListProduct;
use Magento\Catalog\Helper\Product\Compare;

class NewProduct extends \Magento\Framework\View\Element\Template
{ 
    protected $_productCollectionFactory;
    protected $compareProductHelper;
    protected $_productVisibility;
    protected $PreparePostData;
    protected $AbstractProduct;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context, 
        \Magento\Catalog\Block\Product\AbstractProduct $AbstractProduct,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        \Magento\Catalog\Model\Product\Visibility $productVisibility,
        \Magento\Catalog\Block\Product\ListProduct $listProductBlock,
        Compare $compareProductHelper,
        array $data = []
    ) {
        $this->AbstractProduct = $AbstractProduct; 
        $this->listProductBlock = $listProductBlock;
        $this->compareProductHelper = $compareProductHelper;
        $this->_productCollectionFactory = $productCollectionFactory; 
        parent::__construct($context, $data);
    }

    public function getProductCollection() { 
        $collection = $this->_productCollectionFactory->create();
        $collection->addAttributeToSelect('*');
        $collection->addAttributeToSort('entity_id','desc');
        $collection->addAttributeToFilter('status',['eq'=>1]);
        $collection->addAttributeToFilter('is_featured',['eq'=>1]);
        /* foreach ($collection as $items) {
            echo "<pre>";
            print_r($items->getData());
        }die;*/
        return $collection;
    }
    public function getAddToCartPostParams($product)
    {
        return $this->listProductBlock->getAddToCartPostParams($product);
    }
    

}
<?php

namespace Icreative\Moduletest\ViewModel;

class Imagehover implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    protected $productFactory;
    
    public function __construct(
        \Magento\Catalog\Model\ProductFactory $productFactory
    ) {
        $this->productFactory = $productFactory;
    }
    public function getProductByIdCust( $id ) {
        
        $productObj = $this->_productFactory->create()->load($id);
        return $productObj;
    
    }
   
}
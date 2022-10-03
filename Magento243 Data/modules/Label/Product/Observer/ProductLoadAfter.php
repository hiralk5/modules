<?php

namespace Label\Product\Observer;

use \Magento\Framework\Event\Observer;
use \Magento\Framework\Event\ObserverInterface;


class ProductLoadAfter  implements ObserverInterface
{    
    protected $request;
    public function __construct(
        \Magento\Framework\App\Request\Http $request
       
    ) {
       $this->request = $request;
    }
    public function execute(Observer $observer)
    { 
        $product = $observer->getEvent()->getProduct();  // you will get product object
        if($product->getProductLabelFieldset()) {
            $decode = json_decode($product->getProductLabelFieldset(),1);
            $product->setProductLabelFieldset($decode);
        }
    }   
}
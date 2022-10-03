<?php

namespace Admindiscount\Customer\Observer;

use Magento\Framework\App\RequestInterface;
use Magento\Customer\Model\Session;

class DiscountPrice implements \Magento\Framework\Event\ObserverInterface
{
    public function __construct(
        \Magento\Customer\Model\Session $customer
    ) {
        $this->customer = $customer;
    }
    public function execute(\Magento\Framework\Event\Observer $observer) 
    {
        $item = $observer->getEvent()->getData('quote_item'); 
        $customer = $this->customer;
        if($customer->getCustomer()->getData('customer_discount')) {
            $discount = ($item->getPrice()) * ($customer->getCustomer()->getData('customer_discount'))/100;  
            $item = ( $item->getParentItem() ? $item->getParentItem() : $item );
            $price = ($item->getPrice()) - $discount; //set your price here
            $item->setCustomPrice($price);
            $item->setOriginalCustomPrice($price);
            $item->getProduct()->setIsSuperMode(true);
        }
        
    }

}
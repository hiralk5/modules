<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Buyone\Getone\Observer\Frontend\Checkout;

class CartAddProductComplete implements \Magento\Framework\Event\ObserverInterface
{

    protected $_checkoutSession;

    public function __construct (
        \Magento\Checkout\Model\Session $_checkoutSession
    ) {
        $this->_checkoutSession = $_checkoutSession;
    }
    public function execute(
        \Magento\Framework\Event\Observer $observer
    ) {
        $item = $observer->getEvent()->getData('quote_item');            
        $product = $observer->getEvent()->getData('product');   
        
        $cartData = $this->_checkoutSession->getQuote()->getAllVisibleItems();
        $cartDataCount = count($cartData);         
        /*$writer = new \Zend_Log_Writer_Stream(BP . '/var/log/custom.log');
        $logger = new \Zend_Log();
        $logger->addWriter($writer);
        $logger->info('Your text message');*/
        if($cartDataCount > 1){
            for ($x = 0; $x < $cartDataCount; $x++) {
                if ( $x%2 != 0 ){
                    $price = 0; //set your price here
                    $item->setCustomPrice($price);
                    $item->setOriginalCustomPrice($price);
                    $item->getProduct()->setIsSuperMode(true);
                } else {
                    $price = $product->getPrice();
                    $item->setCustomPrice($price);
                    $item->setOriginalCustomPrice($price);
                    $item->getProduct()->setIsSuperMode(true);
                }
                
            }
       }
    }
}


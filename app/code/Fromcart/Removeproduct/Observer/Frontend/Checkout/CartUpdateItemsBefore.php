<?php

namespace Fromcart\Removeproduct\Observer\Frontend\Checkout;

class CartUpdateItemsBefore implements \Magento\Framework\Event\ObserverInterface
{
    protected $_checkoutSession;

    public function __construct (
        \Magento\Checkout\Model\Session $_checkoutSession,
         \Magento\Checkout\Model\Cart $cart 
        ) {
        $this->_checkoutSession = $_checkoutSession;
         $this->_cart = $cart; 
    }

    public function execute(
        \Magento\Framework\Event\Observer $observer
    ) {
        $event = $observer->getEvent();
        $cart = $this->_checkoutSession->getQuote();
        $cartData = $this->_checkoutSession->getQuote()->getAllVisibleItems();
        $cartDataCount = count($cartData);
        $productInfo = $this->_cart->getQuote()->getItemsCollection();
        if ($cartDataCount >= 1) {
            foreach ($productInfo as $item){
               $cart->removeItem($item->getId());
           }
        }
    }
}


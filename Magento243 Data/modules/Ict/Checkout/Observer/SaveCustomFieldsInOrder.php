<?php
namespace Ict\Checkout\Observer;
 
class SaveCustomFieldsInOrder implements \Magento\Framework\Event\ObserverInterface
{
    public function execute(\Magento\Framework\Event\Observer $observer) {
        $order = $observer->getEvent()->getOrder();
        $quote = $observer->getEvent()->getQuote();
 
        $order->setData('isguest', $quote->getIsguest());
 
        return $this;
    }
}
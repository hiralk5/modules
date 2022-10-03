<?php 

namespace Icreative\Moduletest\Observer;

use Magento\Framework\Locale\Currency;
use Magento\Framework\Event\ObserverInterface;

class ChangeMiniCartPrice implements ObserverInterface
{

    public function execute(\Magento\Framework\Event\Observer $observer) {

            $item = $observer->getEvent()->getData('quote_item');           
            $item = ( $item->getParentItem() ? $item->getParentItem() : $item );
            $price = $item->getPrice(); //set your price here
            $item->setCustomPrice($price);
            $item->setOriginalCustomPrice($price - 1);
            $item->getProduct()->setIsSuperMode(true);
        }

	
}

?>
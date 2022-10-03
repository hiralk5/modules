<?php 
namespace Discount\Cart\Observer;

use Magento\Framework\Locale\Currency;
use Magento\Framework\Event\ObserverInterface;

class AddToCartAfter implements ObserverInterface
{
    protected $cart;
    public function __construct(
        \Magento\Framework\App\RequestInterface $request,
        \Magento\Checkout\Model\Cart $cart
    )
    {
        $this->_request = $request;
        $this->cart = $cart;
        
    }
    public function execute(\Magento\Framework\Event\Observer $observer) 
    {  
        $item = $observer->getEvent()->getQuoteItem();//->getAllVisibleItems();
        // $item = $cart->getQuote();
        // $item = ( $item->getParentItem() ? $item->getParentItem() : $item );
        $disc = $this->_request->getParam('discount');

        /*$writer = new \Zend_Log_Writer_Stream(BP . '/var/log/custom.log');
        $logger = new \Zend_Log();
        $logger->addWriter($writer);
        $logger->info(print_r($this->_request->getParams(), true));
        $logger->info('herer');*/
        // $logger->info($item->getId());
        $price = $observer->getProduct()->getOrigData('price');//$item->getPrice(); //set 
        $logger->info($price);

        if($disc == 'low'){
            $item->setCustomPrice($price);
            $item->setOriginalCustomPrice($price*0.9);
            $item->getProduct()->setIsSuperMode(true);
            $logger->info('low');
            return $this;
        }
        if($disc == 'medium'){
            $item->setCustomPrice($price);
            $item->setOriginalCustomPrice($price*0.8);
            $item->getProduct()->setIsSuperMode(true);
            $logger->info('medium');
        }
        if($disc == 'high'){
            $item->setCustomPrice($price);
            $item->setOriginalCustomPrice($price*0.5);
            $item->getProduct()->setIsSuperMode(true);
            $logger->info('high');
        }
    }
}
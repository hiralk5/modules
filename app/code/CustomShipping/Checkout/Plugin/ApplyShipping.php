<?php

namespace CustomShipping\Checkout\Plugin;
use Magento\Checkout\Model\Session;
use Magento\Checkout\Model\Cart;

class ApplyShipping
{
    public $scopeConfig;
    
    public function __construct(
         Session $session,
         Cart $cart,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    )
    {
        $this->scopeConfig = $scopeConfig;
        $this->cart = $cart;
        $this->_session = $session;
    }

    public function aroundCollectCarrierRates(
        \Magento\Shipping\Model\Shipping $subject,
        \Closure $proceed,
        $carrierCode,
        $request
    )
    {
        $valueFromConfig = $this->scopeConfig->getValue(
            'carriers/customshipping/category',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
        );

        $data = [];
        $items = $this->cart->getQuote()->getAllVisibleItems();
        $writer = new \Zend_Log_Writer_Stream(BP . '/var/log/custom.log');
        $logger = new \Zend_Log();
        $logger->addWriter($writer);
        if ($request->getAllVisibleItems()) {
            foreach ($request->getAllVisibleItems() as $item) {
                $id = $item->getProduct()->getCategoryIds();
                if ($id && in_array($valueFromConfig , $id)) {
                    if ($carrierCode == 'customshipping') {
                         // $data[] = 0;
                        array_push($data,0);
                        // $logger->info(0);
                    } else {
                        array_push($data ,1);
                        // $data[] = 1;
                        // $logger->info('1 - if else');
                    } 
                } else {
                   if ($carrierCode == 'customshipping') {
                        // $logger->info('1 - else if');
                        // $data[] = 1;
                        array_push($data,1);
                    }else{
                        // $logger->info('1 - else else');
                        array_push($data,1);
                    }
                }
            }
        }
        // $logger->info(json_encode($carrierCode));
        if(in_array(0,$data)){
            $request->setData('customshipping',true);
            // $logger->info(json_encode(($request->getData())));
            // return $proceed($carrierCode, $request);
            return true;
        }
        // $logger->info('--------');

        // $logger->info(json_encode(($request->getData())));
        return $proceed($carrierCode, $request);
// return true;
        // $logger->info('return');
        // return $proceed($carrierCode, $request);
        // return $proceed($carrierCode, $request);
        /*if(array_search(0,$data)){
        } else {
        }*/

        // Enter Shipping Code here instead of 'freeshipping'
        
        
        
        // return false;
           // To enable the shipping method
    }
}
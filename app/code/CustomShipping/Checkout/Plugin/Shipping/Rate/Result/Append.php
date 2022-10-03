<?php
namespace CustomShipping\Checkout\Plugin\Shipping\Rate\Result;

use Magento\Quote\Api\ShippingMethodManagementInterface;
class Append
{
    
    protected $session;
    public $scopeConfig;

   
    public function __construct(
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Backend\Model\Session\Quote $backendQuoteSession,
        \Magento\Framework\App\State $state,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Shipping\Model\Config $shipconfig
    ) {
        if ($state->getAreaCode() == \Magento\Framework\App\Area::AREA_ADMINHTML) {
            $this->session = $backendQuoteSession;
        } else {
            $this->session = $checkoutSession;
        }
        $this->scopeConfig = $scopeConfig;
          $this->shipconfig = $shipconfig;
    }

   
    public function beforeAppend($subject, $result)
    {
        if (!$result instanceof \Magento\Quote\Model\Quote\Address\RateResult\Method) {
            return [$result];
        }
         $valueFromConfig = $this->scopeConfig->getValue(
            'carriers/customshipping/category',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
        );



        $writer = new \Zend_Log_Writer_Stream(BP . '/var/log/customize.log');
        $logger = new \Zend_Log();
        $logger->addWriter($writer);
        $filtableMethods = [
            'flatrate',
            'customshipping',
            'freeshipping'
        ];
        // $methodCode = $result->getCarrier();
        $logger->info('---------');
        // $logger->info(json_encode($filtableMethods));
        /*if (!in_array('customshipping', $filtableMethods)) {
            return [$result];
        }*/

        // $logger->info(json_encode(get_class_methods($result)));
        $activeCarriers = array($this->shipconfig->getActiveCarriers());

        $quote = $this->session->getQuote();
        $quoteItems = $quote->getAllVisibleItems();
         /** @var \Magento\Quote\Model\Quote $quote */
        $flag = false;
        foreach ($quoteItems as $item) {
             $id = $item->getProduct()->getCategoryIds();
             foreach ($activeCarriers as $key) {
                 $logger->info('key ---');
                 $logger->info(json_encode($key));
                 $logger->info('value ---');
              if (array_search("customshipping",$key)) {
                    $logger->info('in if condition');
                    // $result->getData('carrier');
                    // $flag = true;
                }
                 
             }
             $logger->info(json_encode(($item->getProduct()->getCategoryIds())));
             if (array_search("customshipping",$activeCarriers)) {
                    $logger->info('get');
                    // $result->getData('carrier');
                    // $flag = true;
                }
                $logger->info('=========');
            /*if ($id && in_array($valueFromConfig , $id)) {
                if ($activeCarriers == 'customshipping') {
                    // $logger->info('if if');
                    // $result->getData('carrier');
                    $flag = true;
                } else {
                    // $logger->info('if else');
                    $result->unsetData('customshipping');
                    $flag = false;
                    // $logger->info(json_encode($result->getData()));
                    // $logger->info($custom);
                }
            } else {
                    // $logger->info('false 2');
                    $result->getData('carrier');
                    $flag = false;
                    $result->unsetData('customshipping');
            }*/
        }
        if ($flag == true) {
            $logger->info('true if');
            // $result->setIsDisabled(true);
            return true;
        }
        // $logger->info('-------------------');
        // $logger->info(json_encode($result->getData()));
        return [$result];
    }
}
<?php
namespace Minicart\Spanusername\ViewModel;

class GetCustomerNameInSpan implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    protected $customerData;
        
    public function __construct(\Magento\Customer\Model\Session $customerData) {
    
        $this->customerData = $customerData;
        
    }
  
    public function getLoggedinCustomerName() 
    {
         $writer = new \Zend_Log_Writer_Stream(BP . '/var/log/custom.log');
            $logger = new \Zend_Log();
            $logger->addWriter($writer);
            $logger->info('Your text message');
        if ($this->customerData->isLoggedIn()) {

            $logger->info('Your text message');
            $this->customerData->getCustomer();
            return $this->customerData->getCustomer()->getName();  // get  Full Name
        }
        return null;
    }
}

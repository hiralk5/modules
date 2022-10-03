<?php
namespace Minicart\Spanusername\Block;

class GetCustomerNameInSpan extends \Magento\Framework\View\Element\Template
{
     protected $customerData;
        
     public function __construct(
        \Magento\Customer\Model\Session $customerData,
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = []
     ) {
        $this->customerData = $customerData;
        parent::__construct($context, $data);
    }
  
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        
    }
    public function getLoggedinCustomerName() 
    {
        
        /*if ($this->customerData->isLoggedIn()) {

            $logger->info('Your text message');
            $this->customerData->getCustomer();
            return $this->customerData->getCustomer()->getName();  // get  Full Name
        }
        return null;*/
    }
}
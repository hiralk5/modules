<?php

namespace Rest\CustomApi\Model\Api;
use Psr\Log\LoggerInterface;

class BillingApiManagement implements \Rest\CustomApi\Api\BillingApiManagementInterface
{
    /** @var \Magento\Framework\View\Result\PageFactory */
    protected $resultPageFactory;
    protected $_customerFactory;
    protected $_addressFactory;
    const SEVERE_ERROR = 0;
    const SUCCESS = 1;
    const LOCAL_ERROR = 2;
    const ADDRESS_ATTRIBUTE= 'address_attribute';


    public function __construct(
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Customer\Model\CustomerFactory $customerFactory,
        \Magento\Customer\Model\AddressFactory $addressFactory,
        array $data = []
        ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->_customerFactory = $customerFactory;
        $this->_addressFactory = $addressFactory;

    }
    /**
     * get billing Api data.
     *
     * @api
     *
     * @param int $id
     *
     * @return \Rest\CustomApi\Api\Data\BillingApiInterface
     */
    public function getApiData($id)
    {
        $response = ['success' => false];

        try {
            $customer = $this->_customerFactory->create()->load($id); //insert customer id
        
        //billing
            $billingAddressId = $customer->getDefaultBilling();
            $billingAddress = $this->_addressFactory->create()->load($billingAddressId);
        
        //shipping
            $shippingAddressId = $customer->getDefaultShipping();
            $shippingAddress = $this->_addressFactory->create()->load($shippingAddressId);
            
            $field_data['ShippingAddress'] = $shippingAddress->getData();
            $field_data['BillingAddress'] = $billingAddress->getData();
            $field_data['BillingAddress']['extension_attributes']['address_attribute'] = $customer->getAddressAttribute();
            
            $response= $field_data;
            
            
        } catch (\Exception $e) {
            $response = ['success' => false, 'message' => $e->getMessage()];
        }
        $returnArray = $response;
        return $returnArray; 
    }
}
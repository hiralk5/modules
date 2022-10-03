<?php


/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Rest\CustomApi\Observer;

use Magento\Customer\Helper\Address as HelperAddress;
use Magento\Customer\Model\Address\AbstractAddress;
use Magento\Framework\Registry;
use Magento\Framework\Event\ObserverInterface;
use Magento\Customer\Model\Address;

/**
 * Customer Observer Model
 */
class BeforeAddressSaveObserver implements ObserverInterface
{
    protected $customer;
    protected $address_attribute;
    protected $customerFactory;

    public function __construct(
        \Magento\Customer\Model\Customer $customer,
        \Magento\Framework\App\RequestInterface $request,
        \Magento\Customer\Model\ResourceModel\CustomerFactory $customerFactory,
        \Magento\Customer\Api\AddressRepositoryInterface $addressRepository,
        \Magento\Customer\Model\AddressFactory $addressFactory,
        \Magento\Customer\Api\CustomerRepositoryInterface $CustomerRepositoryInterface,
        \Magento\Customer\Api\Data\AddressInterfaceFactory $addressDataFactory
        
    )
    {
        $this->customer = $customer;
        $this->request = $request;
        $this->customerFactory = $customerFactory;
        $this->addressRepository = $addressRepository;
        $this->addressFactory = $addressFactory;
        $this->CustomerRepositoryInterface = $CustomerRepositoryInterface;
        $this->addressDataFactory = $addressDataFactory;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {

        $customer = $observer->getEvent()->getCustomerAddress();
        //->getEntityId();
        print_r($customer->getData());
        $id = $customer->getId();
// $customer->save();
        
        $address = $this->CustomerRepositoryInterface->getById($id);
        // $e = $this->CustomerRepositoryInterface->get($address->getEmail());
        // $e = ($address->getEmail());
        // print_r($address->get($e));
        // echo "<pre>";print_r(($this->CustomerRepositoryInterface->getList($this->request->getParams('address_attribute'))));exit;
        // $addressObj = $address->getDataModel();
$address->setData('address_attribute',$this->request->getParams('address_attribute')); 
                // echo"<pre>"; print_r(get_class_methods($address));
                // echo"<pre>"; 
                // print_r(($address->getValue()));
                // exit;
// return $address;
 // $address->updateData($addressObj);   
$address->save($address);
        /*$custom = $this->customerFactory->create();

            
        $addressObj = $address->getDataModel();
        $addressObj->setCustomAttribute('address_attribute',$this->request->getParams('address_attribute')); 
        $address->updateData($addressObj);      
        $address->save();*/
         // $address->save();
        // $custom = $custom->setWebsiteId($helperData->getWebsiteId());
        // $custom = $custom->loadById($id);
        // $customer->setData('address_attribute',$address_attribute);   
        // $customer->save();
      // Main code to resolve this issue.
       /* $customerData = $custom->getDataModel();
        $customerData->setCustomAttribute('address_attribute', $address_attribute);
        $custom->updateData($customerData);

        */
    }
}

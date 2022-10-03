<?php
/*namespace Rest\CustomApi\Plugin\Customer\Model;

class Address extends \Magento\Customer\Model\Address
{
    // public $request;
    public $customer;
    public $customerFactory;
    public function __construct(
        // \Magento\Framework\App\RequestInterface $request,
        \Magento\Customer\Model\Customer $customer,
        \Magento\Customer\Model\ResourceModel\CustomerFactory $customerFactory,
        \Magento\Framework\Model\Context $context,
        array $data = []
    )
    {
        // $this->_request = $request;
        $this->customer = $customer;
        $this->customerFactory = $customerFactory;
        parent::__construct($context, $data);
    }
    public function afterSave()
    {
        $customer = $this->customerFactory->create();
        $customerData = $customer->getData();
        echo "<pre>";print_r($customerData);exit;
        $customerData->setCustomAttribute('customer_attribute_code',$data);
    }
}*/

?>
<?php

namespace Restricted\Customer\Plugin;

use Magento\Framework\Exception\LocalizedException;

class AccountManagement
{
    protected $_customerRepository;

    public function __construct(
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository
    ) {
        $this->_customerRepository = $customerRepository;
    }

    public function afterAuthenticate(
        \Magento\Customer\Api\AccountManagementInterface $accountManagement,
        $result)
    {
        foreach($result->getCustomAttributes() as $data ) {
            print_r($data->getValue());
            if($data->getValue() == 1) {
                // echo 'in if';
                throw new LocalizedException(__('This account is restricted by out clinical team, please contact our support team for more information.'));
            }
            return $result; 
        }
        
    }

}
<?php

namespace Restricted\Customer\Plugin;

use Magento\Framework\Exception\LocalizedException;

class AccountManagement
{
    protected $_customerRepository;
    protected $dataObjectConverter;

    public function __construct(
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository,
        \Magento\Framework\Api\ExtensibleDataObjectConverter $dataObjectConverter
    ) {
        $this->_customerRepository = $customerRepository;
        $this->dataObjectConverter = $dataObjectConverter;
    }

    public function afterAuthenticate(
        \Magento\Customer\Api\AccountManagementInterface $accountManagement,
        $result
    ) {
        $customerAttribute = $result->getCustomAttribute('lock_unlock')->getValue();
        if($customerAttribute) {
            throw new LocalizedException(__('This account is restricted by out clinical team, please contact our support team for more information.'));
        }
        return $result;
    }
}

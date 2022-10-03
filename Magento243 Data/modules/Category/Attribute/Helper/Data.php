<?php
namespace Category\Attribute\Helper;
use Magento\Framework\App\Helper\Context;
use Magento\Customer\Api\CustomerRepositoryInterface;
class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    protected $customerRepository;
    public function __construct(
        Context $context,
        CustomerRepositoryInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
        parent::__construct($context);
    }
    public function getAttributeValue($customerId)
    {
        $customer = $this->customerRepository->getById($customerId);
        return $customer->getCustomAttribute('is_visible_subtitle');
    }
}
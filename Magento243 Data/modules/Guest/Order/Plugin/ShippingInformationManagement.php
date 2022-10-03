<?php

namespace Guest\Order\Plugin;

use Magento\Quote\Api\CartRepositoryInterface;

class ShippingInformationManagement
{
    public $cartRepository;

    public function __construct(
        CartRepositoryInterface $cartRepository
    ) {
        $this->cartRepository = $cartRepository;
    }

    public function beforeSaveAddressInformation($subject, $cartId, $addressInformation)
    {
        $quote = $this->cartRepository->getActive($cartId);
        $isGuest = $addressInformation->getShippingAddress()->getExtensionAttributes()->getIsGuest();
        $quote->setIsGuest($isGuest);
        $this->cartRepository->save($quote);
        $quote->setIsGuest($orderComment->getIsGuest());
        $writer = new \Zend_Log_Writer_Stream(BP . '/var/log/custom.log');
        $logger = new \Zend_Log();
        $logger->addWriter($writer);
        $logger->info('ShippingInformationManagement');
        $logger->info(json_encode($quote->getData()));
        return [$cartId, $addressInformation];
    }
}
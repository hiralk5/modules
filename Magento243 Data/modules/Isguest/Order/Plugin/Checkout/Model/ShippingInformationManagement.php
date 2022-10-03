<?php
namespace Isguest\Order\Plugin\Checkout\Model;

use Magento\Quote\Model\QuoteRepository;
use Magento\Checkout\Api\Data\ShippingInformationInterface;

class ShippingInformationManagement
{
    /**
     * @var QuoteRepository
     */
    protected $quoteRepository;

    /**
     * ShippingInformationManagement constructor.
     *
     * @param QuoteRepository $quoteRepository
     */
    public function __construct(
        QuoteRepository $quoteRepository
    ) {
        $this->quoteRepository = $quoteRepository;
    }

    /**
     * @param \Magento\Checkout\Model\ShippingInformationManagement $subject
     * @param $cartId
     * @param ShippingInformationInterface $addressInformation
     */
    public function beforeSaveAddressInformation(
        \Magento\Checkout\Model\ShippingInformationManagement $subject,
        $cartId,
        ShippingInformationInterface $addressInformation
    ) {
        /*$writer = new \Zend_Log_Writer_Stream(BP . '/var/log/custom.log');
        $logger = new \Zend_Log();
        $logger->addWriter($writer);
        $logger->info('Your text message');*/
        $extAttributes = $addressInformation->getExtensionAttributes();
        // $isGuest = $extAttributes->getData('is_guest');
        // $logger->info(json_encode(($addressInformation->getData())));
        // $logger->info(json_encode(get_class_methods($extAttributes)));
        $quote = $this->quoteRepository->getActive($cartId);
        // $logger->info(json_encode(($quote->getData())));
        $quote->getData('is_guest');
    }
}
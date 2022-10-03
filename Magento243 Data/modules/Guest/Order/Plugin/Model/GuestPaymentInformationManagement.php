<?php

namespace Guest\Order\Plugin\Model;

class GuestPaymentInformationManagement
{
    protected $_quoteRepository;
    
    protected $quoteIdMaskFactory;

    protected $_jsonHelper;

    protected $_filterManager;
    public function __construct(
        \Magento\Framework\Json\Helper\Data $jsonHelper,
        \Magento\Framework\Filter\FilterManager $filterManager,
        \Magento\Quote\Model\QuoteRepository $quoteRepository,
        \Magento\Quote\Model\QuoteIdMaskFactory $quoteIdMaskFactory
    ) {
        $this->_jsonHelper = $jsonHelper;
        $this->_filterManager = $filterManager;
        $this->_quoteRepository = $quoteRepository;
        $this->quoteIdMaskFactory = $quoteIdMaskFactory;
    }

  
    public function beforeSavePaymentInformation(
        \Magento\Checkout\Model\GuestPaymentInformationManagement $subject,
        $cartId,
        $email,
        \Magento\Quote\Api\Data\PaymentInterface $paymentMethod
    ) {
        $orderComment = $paymentMethod->getExtensionAttributes();

        if (!empty($orderComment)) {
            try {
                // $address->setUnitNumber($extAttributes->getUnitNumber());
                $quoteIdMask = $this->quoteIdMaskFactory->create()->load($cartId, 'masked_id');
                $quote = $this->_quoteRepository->getActive($quoteIdMask->getQuoteId());
                $quote->setIsGuest($orderComment->getIsGuest());
                $writer = new \Zend_Log_Writer_Stream(BP . '/var/log/custom.log');
                $logger = new \Zend_Log();
                $logger->addWriter($writer);
                $logger->info('GuestPaymentInformationManagement');
                $logger->info(json_encode($quote->getData()));
            } catch (\Exception $e) {
                $this->logger->critical($e->getMessage());
            }
        }
    }
}

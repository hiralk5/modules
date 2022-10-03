<?php

namespace Guest\Order\Plugin\Model;

class PaymentInformationManagement
{

    protected $_quoteRepository;

    /**
     * @var \Magento\Framework\Json\Helper\Data
     */
    protected $_jsonHelper;

    /**
     * @var \Magento\Framework\Filter\FilterManager
     */
    protected $_filterManager;

    public function __construct(
        \Magento\Framework\Json\Helper\Data $jsonHelper,
        \Magento\Framework\Filter\FilterManager $filterManager,
        \Magento\Quote\Model\QuoteRepository $quoteRepository
    ) {
        $this->_jsonHelper = $jsonHelper;
        $this->_filterManager = $filterManager;
        $this->_quoteRepository = $quoteRepository;
    }

    public function beforeSavePaymentInformation(
        \Magento\Checkout\Model\PaymentInformationManagement $subject,
        $cartId,
        \Magento\Quote\Api\Data\PaymentInterface $paymentMethod
    ) {
        $orderComment = $paymentMethod->getExtensionAttributes();
        if ($orderComment->getData('is_guest')) {
            $comment = ($orderComment->getData('is_guest'));
        } else {
            $comment = '';
        }
        $quote = $this->_quoteRepository->getActive($cartId);
        $quote->setData('is_guest',$comment);
        $writer = new \Zend_Log_Writer_Stream(BP . '/var/log/custom.log');
        $logger = new \Zend_Log();
        $logger->addWriter($writer);
        $logger->info('PaymentInformationManagement');
        $logger->info(json_encode($quote->getData()));
    }
}

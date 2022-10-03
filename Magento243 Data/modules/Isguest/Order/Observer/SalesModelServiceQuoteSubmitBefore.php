<?php
namespace Isguest\Order\Observer;

use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;
use Magento\Quote\Model\QuoteRepository;
use SR\DeliveryDate\Model\Validator;

class SalesModelServiceQuoteSubmitBefore implements ObserverInterface
{
    /**
     * @var QuoteRepository
     */
    private $quoteRepository;

    /**
     * SalesModelServiceQuoteSubmitBefore constructor.
     *
     * @param QuoteRepository $quoteRepository
     */
    public function __construct(
        QuoteRepository $quoteRepository,
         \Magento\Framework\App\RequestInterface $request
    ) {
        $this->quoteRepository = $quoteRepository;
         $this->request = $request;
    }

    /**
     * @param EventObserver $observer
     * @return $this
     * @throws \Exception
     */
    public function execute(EventObserver $observer)
    {
        // $order = $observer->getOrder();
        
        // $writer = new \Zend_Log_Writer_Stream(BP . '/var/log/custom.log');
        // $logger = new \Zend_Log();
        // $logger->addWriter($writer);
        // $logger->info(json_encode($isguest));
        // /** @var \Magento\Quote\Model\Quote $quote */
        // $quote = $this->quoteRepository->get($order->getQuoteId());
        // $order->setIsGuest($quote->getIsGuest());
        // return $this;
        $order = $observer->getEvent()->getOrder();
        
        /** @var $quote \Magento\Quote\Model\Quote $quote */
        $quote = $observer->getEvent()->getQuote();

        $order->setData('is_guest', $quote->getData('is_guest'));
    }
}
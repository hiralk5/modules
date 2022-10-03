<?php
namespace Guest\Order\Observer;

class AddIsGuestToOrder implements \Magento\Framework\Event\ObserverInterface
{
    /**
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {

        /** @var $order \Magento\Sales\Model\Order * */
        $order = $observer->getEvent()->getOrder();
        /** @var $quote \Magento\Quote\Model\Quote * */
        $quote = $observer->getEvent()->getQuote();

        // $order->setData('is_guest', $quote->getData('is_guest'));
        $order->setIsGuest($quote->getIsGuest());

        $writer = new \Zend_Log_Writer_Stream(BP . '/var/log/custom.log');
                $logger = new \Zend_Log();
                $logger->addWriter($writer);
                $logger->info('AddIsGuestToOrder');
                $logger->info(json_encode($order->getData()));
    }
}

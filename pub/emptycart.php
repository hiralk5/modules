<?php
use Magento\Framework\App\Bootstrap;
 
require __DIR__ . '/../app/bootstrap.php';
$params = $_SERVER;
$bootstrap = Bootstrap::create(BP, $params);
$obj = $bootstrap->getObjectManager();
$state = $obj->get('Magento\Framework\App\State');
$state->setAreaCode('frontend');
$quoteUpdate = false;
$fromTime = new \DateTime('now', new \DateTimezone('UTC'));
$fromTime->sub(\DateInterval::createFromDateString('30 seconds'));
$fromDate = $fromTime->format('Y-m-d H:i:s');
$quoteCollection = $obj->create('Magento\Quote\Model\ResourceModel\Quote\CollectionFactory')->create();
$quoteCollection->addFieldToFilter('created_at', ['lteq' => $fromDate]);
if($quoteCollection->getSize() > 0) {
    foreach ($quoteCollection as $key => $quote) {
        $quoteItemCollection =$obj->create('Magento\Quote\Model\ResourceModel\Quote\Item\CollectionFactory')->create();

        $quoteItem = $quoteItemCollection->addFieldToSelect('*')->addFieldToFilter('quote_id', $quote['entity_id'])->addFieldToFilter('updated_at', ['lteq' => $fromDate]);
        if($quoteItem->getSize() > 0) {
            echo "quoteitem getsize >0 <br>";
            foreach ($quoteItem->getData() as $key => $value) {
                $itemModel = $obj->create('Magento\Quote\Model\Quote\Item')->load($value['item_id']);
                $itemModel->delete();
                $quoteUpdate = true;
                $quoteFullObject = $obj->create('Magento\Quote\Model\QuoteRepository')->get($quote->getId());
                $quoteFullObject->delete();
            }
            if ($quoteUpdate){
                $cart = $obj->create('Magento\Checkout\Model\Cart')->setQuote($quote)->getQuote()->setTotalsCollectedFlag(false);   
                $cart->save();
                echo "cart save";
            }
        } else {
            $quoteItemCheck = $quoteItemCollection->addFieldToSelect('*')->addFieldToFilter('quote_id', $quote['entity_id']);
            if($quoteItemCheck->getSize() == 0) {
                $quoteFullObject = $obj->create('Magento\Quote\Model\QuoteRepository')->get($quote['entity_id']);
                $quoteFullObject->delete();
                echo "quote deleted";
            }
        }
        $quote->collectTotals()->save();
    }
}

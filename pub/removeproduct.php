<?php 
error_reporting(E_ALL);
ini_set('display_errors', '1');

use Magento\Framework\App\Bootstrap;
use Magento\Framework\AppInterface;
try
{
    require '../app/bootstrap.php';
}
catch (\Exception $e)
{
    echo 'Autoload error: ' . $e->getMessage();
    exit(1);
}
try
{
    $bootstrap = \Magento\Framework\App\Bootstrap::create(BP, $_SERVER);
    $objectManager = $bootstrap->getObjectManager();
    $appState = $objectManager->get('\Magento\Framework\App\State');
    $appState->setAreaCode('frontend');
    $itemModel = $objectManager->create('Magento\Quote\Model\Quote\Item');//Quote item model to load quote item

    $quoteCollectionFactory = $objectManager->get('\Magento\Quote\Model\ResourceModel\Quote\CollectionFactory');
    $quoteRepository = $objectManager->get('\Magento\Quote\Model\QuoteRepository');
    $checkoutSession = $objectManager->get('Magento\Checkout\Model\Session');
    $cartRepo = $objectManager->get('\Magento\Quote\Api\CartRepositoryInterface');
    $allItems = $checkoutSession->getQuote()->getAllVisibleItems();//returns all teh items in session
    
// echo "<pre>";print_r(get_class_methods($cartRepo->delete()));
    $cart = $objectManager->get('\Magento\Checkout\Model\Cart'); 
    $fromTime = new \DateTime('now', new \DateTimezone('UTC'));
    $toTime = clone $fromTime;
    $fromTime->sub(\DateInterval::createFromDateString('3 minutes')); // DateInterval::createFromDateString('2 day'); 30 seconds 60 seconds 
    echo  $fromDate = $fromTime->format('Y-m-d H:i:s');
    echo "<br>--------";
    echo $toDate = $toTime->format('Y-m-d H:i:s');
    $quoteCollection = $quoteCollectionFactory->create();
    $quoteCollection
        ->addFieldToFilter('updated_at', ['lteq' => $fromDate]);                
    echo "<br>".$quoteCollection->getSize();
    echo "<br><pre>";print_r(($quoteCollection->getAllIds()));
    if($quoteCollection->getSize() >0){
        echo "in if";
        foreach ($quoteCollection as $quote)
        {
            echo $quote->getId();
            $quoteFullObject = $quoteRepository->get($quote->getId());
            $quoteFullObject->delete();
            // $cartObject = $objectManager->create('Magento\Checkout\Model\Cart');
            // $cartObject->delete();
            // $cart->getQuote()->getAllVisibleItems()->delete();
            // $cartRepo->delete($quoteRepository->get($quote->getId()));
        }
        // $cart->truncate();
    }
}
catch(\Exception $e)
{
    print_r($e->getMessage());
}

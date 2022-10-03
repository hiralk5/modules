<?php 
error_reporting(E_ALL);
ini_set('display_errors', '1');

use Magento\Framework\App\Bootstrap;
require '../app/bootstrap.php';
$bootstrap = Bootstrap::create(BP, $_SERVER);
$objectManager = $bootstrap->getObjectManager();
$state = $objectManager->get('Magento\Framework\App\State');
$state->setAreaCode('frontend');
echo "=======";


$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
$checkoutSession = $objectManager->get('Magento\Checkout\Model\Session');
$itemModel = $objectManager->create('Magento\Quote\Model\Quote\Item');

$cart = $objectManager->create('Magento\Checkout\Model\Cart');

$allItems = $checkoutSession->getQuote()->getAllVisibleItems();
/*echo "<pre>";print_r($allItems);
echo "<pre>";
print_r(get_class_methods($checkoutSession->getQuote()));
if(($checkoutSession->getQuote()->getAllVisibleItems()) !== null) {
     print_r(($checkoutSession->getQuote()->getAllVisibleItems()));
     echo "----------------------";
}*/
 $items = $cart->getItems();
 echo gettype($items);
 print_r(($items));
        foreach ($items as $item) {
            if ($item->getProductType() == 'simple') {
                // $item->isDeleted(true);
               print_r($item->getProductType());
            }
        }

/*

public function deleteQuoteItems(){
    $checkoutSession = $this->getCheckoutSession();
    $allItems = $checkoutSession->getQuote()->getAllVisibleItems();//returns all teh items in session
    foreach ($allItems as $item) {
        $itemId = $item->getItemId();//item id of particular item
        $quoteItem=$this->getItemModel()->load($itemId);//load particular item which you want to delete by his item id
        $quoteItem->delete();//deletes the item
    }
}
public function getCheckoutSession(){
    $objectManager = \Magento\Framework\App\ObjectManager::getInstance();//instance of object manager 
    $checkoutSession = $objectManager->get('Magento\Checkout\Model\Session');//checkout session
    return $checkoutSession;
}

public function getItemModel(){
    $objectManager = \Magento\Framework\App\ObjectManager::getInstance();//instance of object manager
    $itemModel = $objectManager->create('Magento\Quote\Model\Quote\Item');//Quote item model to load quote item
    return $itemModel;
}

*/
// $id = 2;

/*$objectManager =  \Magento\Framework\App\ObjectManager::getInstance();        

$categoryFactory = $objectManager->get('\Magento\Catalog\Model\CategoryFactory');
 $cart = $objectManager->get('\Magento\Checkout\Model\Cart'); 

// retrieve quote items collection
$itemsCollection = $cart->getQuote()->getItemsCollection();

// get array of all items what can be display directly
$itemsVisible = $cart->getQuote()->getAllVisibleItems();

// retrieve quote items array
 $items = $cart->getQuote()->getAllItems();

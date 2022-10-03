<?php
use Magento\Framework\App\Bootstrap;
 
require __DIR__ . '/../app/bootstrap.php';
$params = $_SERVER;
$bootstrap = Bootstrap::create(BP, $params);
$obj = $bootstrap->getObjectManager();
$state = $obj->get('Magento\Framework\App\State');
$state->setAreaCode('frontend');

$quoteItemCollectionFactory = $obj->get('\Magento\Quote\Model\ResourceModel\Quote\Item\CollectionFactory');
$quoteRepository = $obj->get('\Magento\Quote\Model\QuoteRepository');
$cartRepo = $obj->get('\Magento\Quote\Api\CartRepositoryInterface');

   
   /* public function __construct(
        StoreManagerInterface $storeManager,
        ScopeConfigInterface $scopeConfig,
        \Magento\Quote\Model\ResourceModel\Quote\Item\CollectionFactory $quoteItemCollectionFactory,
        \Magento\Quote\Model\QuoteRepository $quoteRepository,
        \Magento\Quote\Api\CartRepositoryInterface $cartRepo,
        \Magento\Checkout\Model\Cart $cart,
        \Magento\Checkout\Model\Session $carts
    ) {
        $this->storeManager = $storeManager;
        $this->scopeConfig = $scopeConfig;
        $this->quoteItemCollectionFactory = $quoteItemCollectionFactory;
        $this->quoteRepository = $quoteRepository;
        $this->cartRepo = $cartRepo;
        $this->cart = $cart;
        $this->carts = $carts;
    }

    public function removeProduct()
    {*/
        try{
            $count = 0;
            $quote = false;
            $fromDate = date("Y-m-d 00:00:00",strtotime('-2 day'));
            $toDate = date("Y-m-d 23:59:59",strtotime('-2 day'));
            $quoteItemCollection = $quoteItemCollectionFactory->create()->addFieldToFilter('created_at', ['gteq' => $fromDate])->addFieldToFilter('created_at', ['lteq' => $toDate]);
            if($quoteItemCollection->getSize() >0){
                $count = $quoteItemCollection->getSize();
                foreach ($quoteItemCollection as $quoteItem)
                {
                    $quoteItem->delete();
                    $quoteObject = $quoteRepository->get($quoteItem->getQuoteId());
                    $quoteObject->collectTotals();
                    $quoteObject->setTotalsCollectedFlag(false);
                    $cartRepo->save($quoteObject);
                }
            }else{
                return __('No item found');
            }
        }catch(\Exception $e){
            return $e->getMessage();
        }
        return __($count.' items successfully removed.');
    /*}
}*/



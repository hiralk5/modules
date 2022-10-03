<?php
namespace Beauty\Beautylever\Block;

use Magento\Catalog\Block\Product\AbstractProduct;
use Magento\Catalog\Block\Product\Context;
use Magento\Catalog\Model\Product;
use Magento\Catalog\Model\Product\Visibility as ProductVisibility;
use Magento\Catalog\Model\ResourceModel\Product\Collection;
use Magento\Checkout\Model\ResourceModel\Cart as CartResourceModel;
use Magento\Checkout\Model\Session as CheckoutSession;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Module\Manager;
use Magento\Framework\View\Element\AbstractBlock;

class ProductCollection extends \Magento\Catalog\Block\Product\ProductList\Related
{    
    protected $_productCollectionFactory;
        
    public function __construct(
        Context $context,
        CartResourceModel $checkoutCart,
        ProductVisibility $catalogProductVisibility,
        CheckoutSession $checkoutSession,
        Manager $moduleManager,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        array $data = []
    )
    {    
        $this->_productCollectionFactory = $productCollectionFactory;    
        parent::__construct($context, $checkoutCart, $catalogProductVisibility, $checkoutSession, $moduleManager, $data);
    }
    
    public function getProductCollection()
    {
        $collection = $this->_productCollectionFactory->create();
        $collection->addAttributeToSelect('*');
        $collection->setPageSize(4); // fetching only 3 products
        return $collection;
    }
    
    protected function _beforeToHtml()
    {
        return $this;
    }

    public function getItems(){
        return $this->getProductCollection();
    }

    public function canItemsAddToCart()
    {
        foreach ($this->getProductCollection() as $item) {
            if (!$item->isComposite() && $item->isSaleable() && !$item->getRequiredOptions()) {
                return true;
            }
        }
        return false;
    }

    public function getIdentities()
    {
        $identities = [];
        foreach ($this->getItems() as $item) {
            $identities[] = $item->getIdentities();
        }
        return array_merge([], ...$identities);
    }
}
?>
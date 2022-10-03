<?php
namespace Product\Attribute\Plugin\Block\ConfigurableProduct\Product\View\Type;

use Magento\Framework\Json\EncoderInterface;
use Magento\Framework\Json\DecoderInterface;
use Magento\InventoryConfigurationApi\Api\GetStockItemConfigurationInterface;
use Magento\InventorySalesApi\Api\StockResolverInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\InventorySalesApi\Api\Data\SalesChannelInterface;
use Magento\InventorySalesApi\Api\GetProductSalableQtyInterface;

class Configurable
{
    
    protected $stockRegistry;
    protected $jsonEncoder;
    protected $jsonDecoder;
    protected $getStockItemConfiguration;
    protected $productSalableQty;
    protected $stockResolver;
    protected $storeManager;

    public function __construct(
         EncoderInterface $jsonEncoder,
        DecoderInterface $jsonDecoder,
        GetStockItemConfigurationInterface $getStockItemConfiguration,
        GetProductSalableQtyInterface $productSalableQty,
        StockResolverInterface $stockResolver,
        StoreManagerInterface $storeManager,
        \Magento\CatalogInventory\Api\StockRegistryInterface $stockRegistry
    ) {
       $this->jsonDecoder = $jsonDecoder;
        $this->jsonEncoder = $jsonEncoder;
        $this->getStockItemConfiguration = $getStockItemConfiguration;
        $this->productSalableQty = $productSalableQty;
        $this->stockResolver = $stockResolver;
        $this->storeManager = $storeManager;
        $this->stockRegistry = $stockRegistry;
    }

    public function aroundGetJsonConfig(
        \Magento\ConfigurableProduct\Block\Product\View\Type\Configurable $subject,
        \Closure $proceed
    ) {
        $config = $proceed();
        $config = $this->jsonDecoder->decode($config);
        $productsCollection = $subject->getAllowProducts();
        $stockInfo = array();
        foreach ($productsCollection as $product) {
            $productId = $product->getId();
            $stockItem = $this->stockRegistry->getStockItem($product->getId());
            if ($stockItem->getQty() <= 0 || !($stockItem->getIsInStock())) {
                $stockInfo[$productId] = array(
                    "stockLabel" => __('Out of stock'),
                    "stockQty" => intval($stockItem->getQty()),
                    "is_in_stock" => false
                );
            } else {
                $stockInfo[$productId] = array(
                    "stockLabel" => __('In Stock'),
                    "stockQty" => intval($stockItem->getQty()),
                    "is_in_stock" => true
                );
            }
        }

        $config['stockInfo'] = $stockInfo;
        return $this->jsonEncoder->encode($config);
    }
}
<?php

namespace Checkout\Crosssell\Block\Cart;

use Magento\CatalogInventory\Helper\Stock as StockHelper;

class Crosssell extends \Magento\Checkout\Block\Cart\Crosssell
{
    public function __construct(
        \Magento\Catalog\Block\Product\Context $context,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Catalog\Model\Product\Visibility $productVisibility,
        \Magento\Catalog\Model\Product\LinkFactory $productLinkFactory,
        \Magento\Quote\Model\Quote\Item\RelatedProducts $itemRelationsList,
        \Magento\CatalogInventory\Helper\Stock $stockHelper,
        array $data = []
    ) {
        parent::__construct(
            $context,
            $checkoutSession,
            $productVisibility,
            $productLinkFactory,
            $itemRelationsList,
            $stockHelper,
            $data
        );

        // $this->_maxItemCount = 12; // set your product limit here
    }
    /*public function beforeLoad(\Magento\Checkout\Block\Cart\Crosssell $_maxItemCount)
    {
        $writer = new \Zend_Log_Writer_Stream(BP . '/var/log/custom.log');
        $logger = new \Zend_Log();
        $logger->addWriter($writer);
        $logger->info('Your text message');
        $_maxItemCount = 15;
        return [$_maxItemCount];
    }*/
}
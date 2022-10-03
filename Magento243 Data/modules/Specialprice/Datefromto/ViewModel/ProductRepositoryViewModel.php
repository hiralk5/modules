<?php

namespace Specialprice\Datefromto\ViewModel;

class ProductRepositoryViewModel implements \Magento\Framework\View\Element\Block\ArgumentInterface
{

    protected $productRepository;
    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Catalog\Model\ProductRepository         $productRepository
     * @param array                                            $data
     */
    public function __construct(
        
        \Magento\Catalog\Model\ProductRepository $productRepository
        // \Magento\Catalog\Pricing\Price\SpecialPrice $specialPrice

/* getSpecialFromDate
 getSpecialToDate*/
        
    ) {
        $this->productRepository = $productRepository;
        // $this->specialPrice = $specialPrice;
       
    }
    /**
     * Get Special Price By Product ID
     */
    public function getSpecialPriceByProId($proId)
    {
        $product = $this->productRepository->getById($proId);
        if($product->getSpecialPrice()) {
            $product->getSpecialPrice();
            // $product->getSpecialToDate();
            // $product->getSpecialFromDate();
            return $product;
        }
        return null;

    }
    /*public function getSpecialPriceFromDate($proId) {
        $product = $this->productRepository->getById($proId);
        if($product->getSpecialFromDate()) {
            $product->getSpecialFromDate();
            return $product;
        }
        return null;
    }
    public function getSpecialPriceToDate($proId) {
        $product = $this->productRepository->getById($proId);
        if($product->getSpecialToDate()) {
            $product->getSpecialToDate();
            return $product;
        }
        return null;
    }*/
    /*public function getSpecialPriceDate()
    {
        $fromdate = $this->specialPrice->getSpecialFromDate();
        $fromdate = $this->specialPrice->getSpecialToDate();

    }*/
    
}

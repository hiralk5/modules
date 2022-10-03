<?php

namespace Producttype\Offerminmax\Block;


class CustProColl extends \Magento\Framework\View\Element\Template {

   
    protected $collectionFactory;
    protected $options;
    protected $attributeManagement;
    protected $listProduct;
 
    public function __construct(
        \Magento\ConfigurableProduct\Block\Product\View\Type\Configurable $configurableProduct,
        \Magento\Catalog\Model\ProductFactory $product,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $collectionFactory,
        \Magento\Catalog\Model\Product\AttributeSet\Options $options,
        \Magento\Eav\Api\AttributeManagementInterface $attributeManagement,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        \Magento\Catalog\Block\Product\ListProduct $listProduct,
        \Magento\Backend\Block\Template\Context $context,        
        array $data = [],
        \Magento\Framework\Stdlib\ArrayUtils $arrayUtils
        
    ) {
       
        $this->collectionFactory = $collectionFactory;
        $this->options = $options;
        $this->product = $product;
        $this->configurableProduct = $configurableProduct;
        $this->attributeManagement = $attributeManagement;
        $this->listProduct = $listProduct;  
        $this->_productCollectionFactory = $productCollectionFactory;  

        parent::__construct($context, $data);
    }
    

    public function getProductCollection() {
        

        $collection = $this->_productCollectionFactory->create();
        $collection->addAttributeToSelect('*');
        $collection->addFieldToFilter('is_newal',['eq'=>'1']); 
        // $collection->setVisibility($this->_productVisibility->getVisibleInSiteIds());
        // $collection->setPageSize(3); 
        // $collection = $this->listProduct->getLoadedProductCollection()->getData();

        return $collection;
    }
    /*public function getProduct() {
        return $configurableProduct;
    }*/

    public function getPrice($id){
        if(isset($id) && $id){
            $products = $this->product->create()->load($id);
            $price = $products->getPriceInfo()->getPrice('regular_price');
            return $price;
        }
        /*$productprice = $this->getProduct($id);
        $regularPrice = $productprice->getPriceInfo()->getPrice('regular_price');
        return $regularPrice;*/
        //echo'<pre>';print_r($product->getPriceInfo()->getPrice('regular_price'));die();
    }
}

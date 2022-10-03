<?php

namespace Module\Custom\Observer;

use Magento\Framework\Event\ObserverInterface;

class AddCustomURL implements ObserverInterface
{
    protected $_options;
    protected $_urlRewriteFactory;
    public function __construct(
        \Magento\Catalog\Model\Product\Option $options,
        \Magento\UrlRewrite\Model\UrlRewriteFactory $urlRewriteFactory
    ) {
        $this->_options = $options;
         $this->_urlRewriteFactory = $urlRewriteFactory;

    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
    	$product = $observer->getProduct();
        // print_r($observer->getProduct()->getId());
        // echo var_dump($observer->getProduct()->getProductUrl());die;

    	if(($observer->getProduct()->getTwinUrl()) !== null){
	        $url= $observer->getProduct()->getUrlKey();
	        //(strncasecmp($url , $url.'html'))
	        // $url= $observer->getProduct()->gety();
	        $storeid =$observer->getProduct()->getStoreId();
	        $twinurl = $observer->getProduct()->getTwinUrl();
	         $id =$observer->getProduct()->getId();
	        $urlRewriteModel = $this->_urlRewriteFactory->create();
            $urlRewriteModel->setEntityType('product');
	        $urlRewriteModel->setStoreId(1);
	        $urlRewriteModel->setIsSystem(0);
	        $urlRewriteModel->setEntityId($id);
	        $urlRewriteModel->setIdPath(rand(1, 100000));
	        $urlRewriteModel->setTargetPath('catalog/product/view/id/'.$id);
		    $urlRewriteModel->setRequestPath($twinurl.'.html');
	        $urlRewriteModel->setRedirectType(0);
		    $urlRewriteModel->save();
        }
        
        
        /*foreach ($options as $arrayOption) {
            $option = $this->_options
                            ->setProductId($product->getId())
                            ->setStoreId($product->getStoreId())
                            ->addData($arrayOption);
            $option->save();
            $product->addOption($option);
        } */       
    }
}
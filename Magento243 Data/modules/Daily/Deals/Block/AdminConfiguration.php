<?php
/**
* @Developer: Hemant Kumar Singh Magento 2x Developer
* @Website: http://www.wishusucess.com/
*/
namespace Daily\Deals\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Daily\Deals\Helper\Data;
use Magento\Framework\App\Config\ScopeConfigInterface;

class AdminConfiguration extends \Magento\Framework\View\Element\Template
{ 
	public function __construct(
		\Magento\Backend\Block\Template\Context $context,
		Data $helper,
		\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig, 
		//\Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productcollection, 
		array $data = []
	)
	{ 
		$this->helper = $helper;
		$this->scopeConfig = $scopeConfig;
	//	$this->productcollection = $productcollection;
		parent::__construct($context, $data);
	}

	/*public function getCollection()
    {
       // return $this->bannerview->create()->getCollection();
       return $this->productcollection->create()->getCollection()
                   // ->addAttributeToSelect('*')
                   ->addFieldToFilter('status',['eq'=>1]);
    }*/
	public function status()
	{
		return $this->helper->status();
	} 

	public function getProductSKU()
	{
		return $this->helper->getProductSKU();
		echo $this->helper->getProductSKU(); die;
	} 
	
	public function getSaleExpireDate()
	{
		return $this->helper->getSaleExpireDate();
	}

	public function getSaleText()
	{
		return $this->helper->getSaleText();
	} 
}
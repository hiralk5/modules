<?php
/**
* @Developer: Hemant Kumar Singh Magento 2x Developer
* @Website: http://www.wishusucess.com/
*/
namespace Daily\Deals\Helper;
use Magento\Framework\App\Config\ScopeConfigInterface;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{

	/**
	* Admin configuration paths
	*/
	const STATUS = 'daily_deals/general_conifg/status';

	const PRODUCT_SKU = 'daily_deals/general_conifg/product_sku';

	const SALE_EXPIRE_DATE = 'daily_deals/general_conifg/sale_expire_date'; 
	
	const SALE_TEXT = 'daily_deals/general_conifg/sale_text'; 
	/**
	* @var \Magento\Framework\App\Config\ScopeConfigInterface
	*/
	protected $scopeConfig;

	/**
	* Data constructor
	* @param \Magento\Framework\App\Helper\Context $context
	* @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
	*/
	public function __construct(
		\Magento\Framework\App\Helper\Context $context,
		//\Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productcollection,
		\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
		) {
		// $this->productcollection=$productcollection;
		parent::__construct($context);

	}

	/**
	* @return $isEnabled
	*/

	/*public function getCollection()
    {
       // return $this->bannerview->create()->getCollection();
       return $this->productcollection->create()->getCollection()
                   // ->addAttributeToSelect('*')
                   ->addFieldToFilter('status',['eq'=>1]);
                   ->addFieldToFilter('sku',getProductSKU());
    }*/
	public function status()
	{
		$isactive = $this->scopeConfig->getValue(self::STATUS, 
		\Magento\Store\Model\ScopeInterface::SCOPE_STORE
		);

		return $isactive;
	}

	/**
	* @return $textTitle
	*/
	public function getProductSKU()
	{
		$productSku = $this->scopeConfig->getValue(self::PRODUCT_SKU,
		\Magento\Store\Model\ScopeInterface::SCOPE_STORE
		);

		return $productSku;
	}


	public function getSaleExpireDate()
	{
		$saleExpireDate = $this->scopeConfig->getValue(self::SALE_EXPIRE_DATE,
		\Magento\Store\Model\ScopeInterface::SCOPE_STORE
		);

		return $saleExpireDate;
	}

	public function getSaleText()
	{
		$saleText = $this->scopeConfig->getValue(self::SALE_TEXT,
		\Magento\Store\Model\ScopeInterface::SCOPE_STORE
		);

		return $saleText;
	}
}
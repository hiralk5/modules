<?php
namespace CustomShipping\Checkout\Helper;

use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper
{
	public function getConfig($scope)
	{
		try {
			switch($scope){
				case 'store' : return $this->scopeConfig->getValue('carriers/customshipping/category', ScopeInterface::SCOPE_STORE);
				case 'website' : return $this->scopeConfig->getValue('carriers/customshipping/category', ScopeInterface::SCOPE_WEBSITE);
				return $this->scopeConfig->getValue('carriers/customshipping/category', ScopeInterface::SCOPE_STORE);

			}
		} catch (\Exception $e) {
			return false;
		}
	}
}
?>
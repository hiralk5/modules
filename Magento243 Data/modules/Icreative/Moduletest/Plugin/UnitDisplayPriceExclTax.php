<?php 

namespace Icreative\Moduletest\Plugin;

class UnitDisplayPriceExclTax{

	public function afterGetUnitDisplayPriceExclTax(\Magento\Weee\Block\Item\Price\Renderer $subject,$result){
		$writer = new \Zend_Log_Writer_Stream(BP . '/var/log/custom.log');
$logger = new \Zend_Log();
$logger->addWriter($writer);
$logger->info('Your text message +50rs');
		return $result + 50;

	}
}

?>
<?php

namespace Checkout\Crosssell\Plugin\Block\Cart;

use Magento\Checkout\Block\Cart\Crosssell as Crossell;

class Crosssell
{

	public function beforeLoad(Crosssell $subject,$data)
	{
		$writer = new \Zend_Log_Writer_Stream(BP . '/var/log/custom.log');
		$logger = new \Zend_Log();
		$logger->addWriter($writer);
		$logger->info('Your text message');
		// $_maxItemCount = 15;
		$data = 15;
		return [$data];
	}

}
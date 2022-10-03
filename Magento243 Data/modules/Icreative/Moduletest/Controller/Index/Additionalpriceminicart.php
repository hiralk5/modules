<?php
namespace Icreative\Moduletest\Controller\Index;

class Additionalpriceminicart extends \Magento\Framework\App\Action\Action
{

	public function execute()
	{
		$writer = new \Zend_Log_Writer_Stream(BP . '/var/log/custom.log');
$logger = new \Zend_Log();
$logger->addWriter($writer);
$logger->info('Your text messagewwwwww');
		//$textDisplay = new \Magento\Framework\DataObject(array('text' => 'Mageplaza'));
		$this->_eventManager->dispatch('icreative_moduletest_changeminicartprice',[]);
		//echo $textDisplay->getText();
		exit;
	}
}

?>
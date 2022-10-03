<?php

namespace Icreative\Moduletest\Controller\Index;

class ObserverExample extends \Magento\Framework\App\Action\Action
{

	public function execute()
	{
		$textDisplay = new \Magento\Framework\DataObject(array('text' => 'Mageplaza'));
		$this->_eventManager->dispatch('icreative_moduletest_display_observerexample', ['mp_text' => $textDisplay]);
		echo $textDisplay->getText();
		exit;
	}
}
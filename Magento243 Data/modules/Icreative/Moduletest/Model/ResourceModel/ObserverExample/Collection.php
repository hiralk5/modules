<?php 

namespace Icreative\Moduletest\Model\ResourceModel\ObserverExample;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection{
	
	public function _construct() {
		$this->_init("Icreative\Moduletest\Model\ObserverExample","Icreative\Moduletest\Model\ResourceModel\ObserverExample");
	}
}
<?php 

namespace Icreative\Moduletest\Model\ResourceModel\Moduletest;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection{
	
	public function _construct() {
		$this->_init("Icreative\Moduletest\Model\Moduletest","Icreative\Moduletest\Model\ResourceModel\Moduletest");
	}
}
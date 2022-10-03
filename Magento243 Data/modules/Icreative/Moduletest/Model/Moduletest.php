<?php 

namespace Icreative\Moduletest\Model;

class Moduletest extends \Magento\Framework\Model\AbstractModel{
	
	public function _construct() {
		$this->_init("Icreative\Moduletest\Model\ResourceModel\Moduletest");
	}
}

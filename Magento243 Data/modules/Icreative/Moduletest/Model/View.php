<?php 

namespace Icreative\Moduletest\Model;

class View extends \Magento\Framework\Model\AbstractModel{
	
	public function _construct() {
		$this->_init("Icreative\Moduletest\Model\ResourceModel\View");
	}
}

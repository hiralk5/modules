<?php 

namespace Beauty\Beautylever\Model\ResourceModel\Product;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection{
	
	public function _construct() {
		$this->_init("Beauty\Beautylever\Model\ProductCollection","Beauty\Beautylever\Model\ResourceModel\Product");
	}
}
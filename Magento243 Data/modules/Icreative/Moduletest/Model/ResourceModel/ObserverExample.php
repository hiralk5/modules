<?php 

namespace Icreative\Moduletest\Model\ResourceModel;

class ObserverExample extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb {
 
 public function _construct(){
    $this->_init("observer_faq","id");
 }
}
<?php 

namespace Icreative\Moduletest\Model\ResourceModel;

class Moduletest extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb {
 
 public function _construct(){
    $this->_init("Icreative_faq","id");
 }
}
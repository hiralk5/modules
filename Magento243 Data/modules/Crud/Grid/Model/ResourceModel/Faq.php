<?php 

namespace Crud\Grid\Model\ResourceModel;

class Faq extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb 
{
   protected function _construct(){
      $this->_init("Icreative_faq","id");
   }
}
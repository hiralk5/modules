<?php
namespace Icreative\Moduletest\Model\ResourceModel\View;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    public function _construct()
    {
        $this->_init("Icreative\Moduletest\Model\View","Icreative\Moduletest\Model\ResourceModel\View");
    }
}
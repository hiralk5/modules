<?php
namespace Banner\Slider\Model\ResourceModel\Banner;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Banner\Slider\Model\Banner as Model;
use Banner\Slider\Model\ResourceModel\Banner as ResourceModel;

class Collection extends AbstractCollection
{
    public function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
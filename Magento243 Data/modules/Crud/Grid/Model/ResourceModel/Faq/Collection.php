<?php 

namespace Crud\Grid\Model\ResourceModel\Faq;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Crud\Grid\Model\Faq as Model;
use Crud\Grid\Model\ResourceModel\Faq as ResourceModel;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
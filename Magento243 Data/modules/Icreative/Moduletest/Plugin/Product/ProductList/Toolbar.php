<?php

namespace Icreative\Moduletest\Plugin\Product\ProductList;

class Toolbar
{
    /**
     * @param \Magento\CatalogSearch\Model\ResourceModel\Fulltext\Collection $subject
     * @param bool $printQuery
     * @param bool $logQuery
     * @return array
     */
    public function beforeLoad(\Magento\CatalogSearch\Model\ResourceModel\Fulltext\Collection $subject, $printQuery = false, $logQuery = false)
    {
        $orderBy = $subject->getData();//getSelect()->getPart(\Zend_Db_Select::ORDER);
        $outOfStockOrderBy = array('is_salable DESC');
        // echo"<pre>";
        // print_r($subject->getData());exit;
        // /* reset default product collection filter */
        $subject->getSelect()->reset(\Zend_Db_Select::ORDER);
        $subject->getSelect()->order($outOfStockOrderBy);

        return [$printQuery, $logQuery];
    }
}
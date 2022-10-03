<?php
namespace Icreative\Moduletest\Block\Product\ProductList;

class Toolbar {

    public function afterGetAvailableOrders (
        \Magento\Catalog\Block\Product\ProductList\Toolbar $subject, $result
    ) {
        $result ['most_popular'] = 'most popular';
        return $result;
    }
}
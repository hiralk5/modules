<?php

namespace Icreative\Moduletest\Model;
class Product extends \Magento\Catalog\Model\Product
{

    
    public function getName()
    {
        return "Preference Demo";
    }
    public function getPrice()
    {
        return "12";
    }
}
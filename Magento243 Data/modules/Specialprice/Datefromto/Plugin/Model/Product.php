<?php

namespace Specialprice\Datefromto\Plugin\Model;

class Product
{




  public function afterGetSpecialPrice(\Magento\Catalog\Model\Product $subject, $result)
  { 
    if ($subject->getSpecialFromDate()){
      return $result;
    } 
  }
}
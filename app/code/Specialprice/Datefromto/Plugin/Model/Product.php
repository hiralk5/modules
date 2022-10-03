<?php

namespace Specialprice\Datefromto\Plugin\Model;

class Product
{


  public function afterGetPrice(\Magento\Catalog\Model\Product $subject, $result)
  { 
    // if (strpos($result, '.') !== false) {
    //   return explode('.',$result, 2); 
    // }
  }

  public function afterGetSpecialPrice(\Magento\Catalog\Model\Product $subject, $result)
  { 
    if ($subject->getSpecialFromDate()){
      return $result;
    } 
  }
}
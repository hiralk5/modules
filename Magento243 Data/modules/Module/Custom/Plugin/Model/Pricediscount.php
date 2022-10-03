<?php

namespace Module\Custom\Plugin\Model;
 
class Pricediscount
{
    public function afterGetPrice(\Magento\Catalog\Model\Product $subject, $result)
    {
        $urlInterface = \Magento\Framework\App\ObjectManager::getInstance()->get('Magento\Framework\UrlInterface');
// echo $urlInterface->getCurrentUrl();
        // echo $subject->getTwinUrl().'<br>';
        // exit;
        // echo $subject->getUrl();
        if($subject->getTwinUrl() !== null){
            if(strpos($urlInterface->getCurrentUrl(), $subject->getTwinUrl().'.html') !== false)
            // if($subject->getTwinUrl() != $subject->getUrlKey()){
                // echo "<br>here";
                // die;
                $result *= 0.90;
                return $result;
      
            // }
        }
        
    }
}
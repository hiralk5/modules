<?php 

namespace Crud\Grid\Model;

// use Webkul\Grid\Api\Data\GridInterface;

class Faq extends \Magento\Framework\Model\AbstractModel //implements GridInterface
{
   const CACHE_TAG = 'banner_slider';
   protected $_cacheTag = 'banner_slider';
   protected $_eventPrefix = 'banner_slider';

   protected function _construct() 
   {
      $this->_init("Crud\Grid\Model\ResourceModel\Faq");
   }
}

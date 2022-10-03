<?php 

namespace Banner\Slider\Model;

class Banner extends \Magento\Framework\Model\AbstractModel
{
	const CACHE_TAG = 'banner_slider';
   	protected $_cacheTag = 'banner_slider';
	protected $_eventPrefix = 'banner_slider';

	
	public function _construct() {
		$this->_init("Banner\Slider\Model\ResourceModel\Banner");
	}
}

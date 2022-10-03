<?php

namespace Banner\Slider\Block;

use Magento\Backend\Block\Template\Context;

class Showdata extends \Magento\Framework\View\Element\Template
{

    public $bannerview;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Banner\Slider\Model\BannerFactory $bannerview,
        array $data = []
    )
    {
        $this->bannerview = $bannerview;
        parent::__construct($context, $data);
    }

    public function getCollection()
    {
       // return $this->bannerview->create()->getCollection();
       return $this->bannerview->create()->getCollection()
                   // ->addAttributeToSelect('*')
                   ->addFieldToFilter('status',['eq'=>1]);
    }
    public function getImagePath()
    {
        $imagePath = $this->_storeManager->getStore()
                ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
                
        return $imagePath.'banner/';
    }

}


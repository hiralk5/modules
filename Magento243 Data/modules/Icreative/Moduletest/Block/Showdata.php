<?php

namespace Icreative\Moduletest\Block;

class Showdata extends \Magento\Framework\View\Element\Template
{

    public $moduletestView;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Icreative\Moduletest\Model\ViewFactory $moduletestView,
        array $data = []
    )
    {
        $this->moduletestView = $moduletestView;
        parent::__construct($context, $data);
    }

    public function getCollection()
    {
       return $this->moduletestView->create()->getCollection();
       
    }
    public function getImagePath()
    {
        $imagePath = $this->_storeManager->getStore()
                ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
        return $imagePath .'mycustomfolder';
    }

}
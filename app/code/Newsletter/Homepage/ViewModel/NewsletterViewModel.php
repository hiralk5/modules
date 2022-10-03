<?php

namespace Newsletter\Homepage\ViewModel;

class NewsletterViewModel implements \Magento\Framework\View\Element\Block\ArgumentInterface
{

    protected $httpRequest;
    
    public function __construct(
        \Magento\Framework\App\Request\Http $httpRequest,
        \Newsletter\Homepage\Helper\Data $dataHelper
    ) {
        $this->httpRequest = $httpRequest;
        $this->dataHelper = $dataHelper;
    }

    public function getAdminConfigData($path) {
        $dataHelper = $this->dataHelper->getConfig($path);
        return $dataHelper;
    }

    public function getCustomActionName()
    {
        return $this->httpRequest->getFullActionName();
    }
}

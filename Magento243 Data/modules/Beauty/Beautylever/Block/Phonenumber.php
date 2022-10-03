<?php

namespace Beauty\Beautylever\Block;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class Phonenumber extends \Magento\Framework\View\Element\Template
{
    // protected $flHelper;
    protected $_urlInterface;
    protected $scopeConfig;


    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Framework\UrlInterface $urlInterface,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_urlInterface = $urlInterface;
        $this->scopeConfig = $scopeConfig;

    }
    public function getPhoneNumber()
    {
        return $this->scopeConfig->getValue('general/store_information/phone',ScopeInterface::SCOPE_STORE);

    }
}
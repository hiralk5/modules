<?php
namespace Newsletter\Homepage\Block;

class AdminCongifData extends \Magento\Framework\View\Element\Template
{
     protected $helper;
        
     public function __construct(
        \Newsletter\Homepage\Helper\Data $helper,
        \Magento\Framework\View\Element\Template\Context $context,        
        array $data = []
     ) {
        $this->helper = $helper;
        parent::__construct($context, $data);
    }
  
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        
    }
    public function getConfigValue($value) 
    {
        return $this->scopeConfig->getValue($value,\Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
}
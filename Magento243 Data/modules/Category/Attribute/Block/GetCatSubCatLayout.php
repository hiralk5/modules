<?php 
namespace Category\Attribute\Block;

use Magento\Catalog\Model\Product;

class GetCatSubCatLayout extends \Magento\Framework\View\Element\Template
{
	 protected $_registry;
	 protected $_category;
        
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,        
        \Magento\Framework\Registry $registry,
        array $data = []
    )
    {        
        $this->_registry = $registry;
        parent::__construct($context, $data);
    }
    
    public function _prepareLayout()
    {
        return parent::_prepareLayout();
    }
    
    public function getCurrentCategory()
    {        
        return $this->_registry->registry('current_category');
    }
}

<?php
namespace Guest\Order\Block\Order;

use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template\Context as TemplateContext;

class Isguest extends \Magento\Framework\View\Element\Template
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $coreRegistry = null;
    public function __construct(
        TemplateContext $context,
        Registry $registry,
        array $data = []
    ) {
        $this->coreRegistry = $registry;
        $this->_isScopePrivate = true;
        $this->_template = 'order/view/Isguest.phtml';
        parent::__construct($context, $data);
    }
    public function getOrder()
    {
        return $this->coreRegistry->registry('current_order');
    }
    public function getOrderIsGuest()
    {
        return trim($this->getOrder()->getData('is_guest'));
    }
}

<?php
namespace Category\Attribute\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Registry;
use Magento\Framework\App\Http\Context as HttpContext;

class LayoutLoadBefore implements ObserverInterface
{
    /**
     * @var Registry
     */
    protected $registry;

    /**
     * LayoutLoadBefore constructor.
     * @param Registry $registry
     */
    

//---------------------------------------------------------------
    /**
     * @var HttpContext
     */
    protected $httpContext;

    public function __construct(
        HttpContext $httpContext
    ) {
        $this->httpContext = $httpContext;
    }

    public function execute(Observer $observer)
    {
        /** @var \Magento\Framework\View\Layout $layout */
        $layout = $observer->getLayout();

        $isCustomerLoggedIn = (bool)$this->httpContext->getValue(\Magento\Customer\Model\Context::CONTEXT_AUTH);
        
        if (!$isCustomerLoggedIn) {
            $layout->getUpdate()->addHandle('customer_not_logged_in');
        }
    }


}
<?php

namespace Banner\Slider\Controller\Adminhtml\Bannerslider;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Backend\App\Action
{
	protected $resultPageFactory = false;

	public function __construct(
		\Magento\Backend\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory
	)
	{
		parent::__construct($context);
		$this->resultPageFactory = $resultPageFactory;
	}

	public function execute()
	{	
		$resultPage = $this->resultPageFactory->create();
		$resultPage->setActiveMenu('Banner_Slider::banner');
		$resultPage->getConfig()->getTitle()->prepend((__('Banner')));
		return $resultPage;
		
	}
	protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Banner_Slider::banner');
    }


}
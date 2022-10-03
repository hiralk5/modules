<?php

namespace Crud\Grid\Controller\Adminhtml\Faqicreative;

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
		$resultPage->setActiveMenu('Crud_Grid::faq');
		$resultPage->getConfig()->getTitle()->prepend((__('Faqs')));
		return $resultPage;
		
	}
	protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Crud_Grid::faq');
    }


}
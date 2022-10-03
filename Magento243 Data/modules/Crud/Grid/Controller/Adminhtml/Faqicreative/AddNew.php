<?php
namespace Crud\Grid\Controller\Adminhtml\Faqicreative;

use Magento\Framework\Controller\ResultFactory;

class AddNew extends \Magento\Backend\App\Action
{

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
}
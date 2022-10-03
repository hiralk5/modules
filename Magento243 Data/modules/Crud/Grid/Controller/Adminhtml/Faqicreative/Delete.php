<?php

namespace Crud\Grid\Controller\Adminhtml\Faqicreative;
use Magento\Backend\App\Action;
class Delete extends Action
{
    protected $FaqFactory;
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Crud\Grid\Model\Faq $FaqFactory
    ) {
        parent::__construct($context);
        $this->FaqFactory = $FaqFactory;
    }
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Crud_Grid::faq');
    }
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) 
        {
            try 
            {
                $model = $this->FaqFactory;
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccess(__('Record deleted successfully.'));
                return $resultRedirect->setPath('crud_grid/faqicreative/index');
            } 
            catch (\Exception $e) 
            {
                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath('crud_grid/faqicreative/edit', ['id' => $id]);
            }
        }
        $this->messageManager->addError(__('Record does not exist.'));
        return $resultRedirect->setPath('crud_grid/faqicreative/index');
    }
}
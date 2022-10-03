<?php

namespace Banner\Slider\Controller\Adminhtml\Bannerslider;
use Magento\Backend\App\Action;
class Delete extends Action
{
    protected $BannerFactory;
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Banner\Slider\Model\Banner $BannerFactory
    ) {
        parent::__construct($context);
        $this->BannerFactory = $BannerFactory;
    }
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Banner_Slider::banner');
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
                $model = $this->BannerFactory;
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccess(__('Record deleted successfully.'));
                return $resultRedirect->setPath('banner_slider/bannerslider/index');
            } 
            catch (\Exception $e) 
            {
                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath('banner_slider/bannerslider/edit', ['id' => $id]);
            }
        }
        $this->messageManager->addError(__('Record does not exist.'));
        return $resultRedirect->setPath('banner_slider/bannerslider/index');
    }
}
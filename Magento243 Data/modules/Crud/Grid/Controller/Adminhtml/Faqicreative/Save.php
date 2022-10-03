<?php
namespace Crud\Grid\Controller\Adminhtml\Faqicreative;

use Magento\Backend\App\Action\Context;
use Magento\Backend\App\Action;
use Magento\Backend\Model\Session;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Filesystem;
use Magento\Framework\Validation\ValidationException;
use Magento\MediaStorage\Model\File\UploaderFactory;
use Crud\Grid\Model\FaqFactory;

class Save extends \Magento\Backend\App\Action
{
    protected $faqFactory;
    protected $request;
    protected $uploaderFactory;
    protected $mediaDirectory;
    // protected $imageFactory;
    public function __construct(
        Action\Context $context,
        FaqFactory $faqFactory,
        RequestInterface $request,
        Session $adminsession,
        UploaderFactory $uploaderFactory,
        Filesystem $filesystem
        
    ) {
        parent::__construct($context);
        $this->faqFactory = $faqFactory;
        $this->adminsession = $adminsession;
        $this->request = $request;
        $this->uploaderFactory = $uploaderFactory;
        // $this->imageFactory = $imageFactory;
        $this->mediaDirectory = $filesystem->getDirectoryWrite(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);
    }
    public function execute()
    {
        $data = $this->getRequest()->getParams();
        $resultRedirect = $this->resultRedirectFactory->create();
        $rowData = $this->_objectManager->create('Crud\Grid\Model\Faq');
        if($data){
            $id = $this->getRequest()->getParam('id');
            $rowData = $this->faqFactory->create();
             if($id){
                $rowData = $this->faqFactory->create()->load($id);
            }else{
                $rowData = $this->faqFactory->create();
            }
            $rowData->setData($data);
            try { 
                $rowData->load($id);
                $rowData->setStatus($data['status']);
                $rowData->setQuestion($data['question']);            
                $rowData->setAnswer($data['answer']);
                if (isset($data['image']) && isset($data['image'][0])) {
                    $rowData->setImage($data['image'][0]['name']);
                } else {
                    $rowData->setImage('');
                }
                $rowData->save();
                $this->messageManager->addSuccess(__('The data has been updated.'));
                $this->adminsession->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    if ($this->getRequest()->getParam('back') == 'add') {
                        return $resultRedirect->setPath('crud_grid/faqicreative/addnew');
                    } 
                    else {
                        return $resultRedirect->setPath('crud_grid/faqicreative/edit', ['id' => $id ,'_current' => true]);
                    }
                }
                return $resultRedirect->setPath('crud_grid/faqicreative/index');
            }
            catch (\Magento\Framework\Exception\LocalizedException $e) {
            $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the data.'));
            }
            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('crud_grid/faqicreative/index', ['id' => $this->getRequest()->getParam('id')]);
        }
    }
}

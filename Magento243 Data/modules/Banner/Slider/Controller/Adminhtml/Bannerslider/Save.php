<?php
namespace Banner\Slider\Controller\Adminhtml\Bannerslider;

use Magento\Backend\App\Action\Context;
use Magento\Backend\App\Action;
use Magento\Backend\Model\Session;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Filesystem;
use Magento\Framework\Validation\ValidationException;
use Magento\MediaStorage\Model\File\UploaderFactory;
use Banner\Slider\Model\BannerFactory;

class Save extends \Magento\Backend\App\Action
{
    protected $bannerFactory;
    protected $request;
    protected $uploaderFactory;
    protected $mediaDirectory;
    // protected $imageFactory;
    public function __construct(
        Action\Context $context,
        BannerFactory $bannerFactory,
        RequestInterface $request,
        Session $adminsession,
        UploaderFactory $uploaderFactory,
        Filesystem $filesystem
        
    ) {
        parent::__construct($context);
        $this->bannerFactory = $bannerFactory;
        $this->adminsession = $adminsession;
        $this->request = $request;
        $this->uploaderFactory = $uploaderFactory;
        // $this->imageFactory = $imageFactory;
        $this->mediaDirectory = $filesystem->getDirectoryWrite(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);
    }
    public function execute()
    {
        $data = $this->getRequest()->getParams();
        // echo "<pre>";print_r($data);die;
        $resultRedirect = $this->resultRedirectFactory->create();
        $rowData = $this->_objectManager->create('Banner\Slider\Model\Banner');
        if($data){
            $id = $this->getRequest()->getParam('id');
            $rowData = $this->bannerFactory->create();
             if($id){
                $rowData = $this->bannerFactory->create()->load($id);
            }else{
                $rowData = $this->bannerFactory->create();
            }
            $rowData->setData($data);
            // echo "<pre>";print_r($data);
            // echo $this->getRequest()->getParam('back');
            try {

                $rowData->load($id);
                // $rowData->setStatus($data['']);
                if (isset($data['image']) && isset($data['image'][0])) {
                    $rowData->setImage($data['image'][0]['name']);
                } else {
                    $rowData->setImage('');
                }
                // echo "here";
                $rowData->setName($data['name']);            
                $rowData->setDescription($data['description']);
                $rowData->setStatus($data['status']);
                $rowData->save();
                $this->messageManager->addSuccess(__('The data has been updated.'));
                $this->adminsession->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    if ($this->getRequest()->getParam('back') == 'add') {
                        // echo "add";
                        return $resultRedirect->setPath('banner_slider/bannerslider/addnew');
                    } 
                    else {
                        // echo "edit;";
                        return $resultRedirect->setPath('banner_slider/bannerslider/edit', ['id' => $id ,'_current' => true]);
                    }
                }
                //die;
                return $resultRedirect->setPath('banner_slider/bannerslider/index');
            }
            catch (\Magento\Framework\Exception\LocalizedException $e) {
            $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the data.'));
            }
            $this->_getSession()->setFormData($data);
            // die;
            // return $resultRedirect->setPath('banner_slider/bannerslider/index', ['id' => $this->getRequest()->getParam('id')]);
        }
    }
}

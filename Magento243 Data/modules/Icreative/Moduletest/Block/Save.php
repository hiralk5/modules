<?php 

namespace Icreative\Moduletest\Block;

class Save extends \Magento\Framework\View\Element\Template
{   
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        //\Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Filesystem $filesystem,
        \Magento\MediaStorage\Model\File\UploaderFactory $_uploaderFactory,
        array $data = []
    )
    {
        parent::__construct($context, $data);
       }

    /**
     * Get form action URL for POST booking request
     *
     * @return string
     * 
     * 
     * https://getridbug.com/magento/how-to-display-images-stored-in-pub-media-folder/
     * 
     */
    public function getFormAction()
    {
        if(isset($_FILES['filename']['name'])) {
            $uploader = $this->_uploaderFactory->create(['fileId' => 'filename']);
            $workingDir = $this->_varDirectory->getAbsolutePath('pub/');
            $result = $uploader->save($workingDir);
        }
            // companymodule is given in routes.xml
            // controller_name is folder name inside controller folder
            // action is php file name inside above controller_name folder
        //echo "in block ";exit;
        return $this->getUrl('icreative/index/save', ['_secure' => true]);
        // here controller_name is index, action is booking
    }
}
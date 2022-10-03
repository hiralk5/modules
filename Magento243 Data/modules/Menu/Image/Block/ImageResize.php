<?php
namespace Menu\Image\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\App\Filesystem\DirectoryList;


class ImageResize extends Template
{
    const DIRECTORY = 'catalog/category';
    // const DIRECTORY = 'catalog/category';

    protected $_mediaDirectory;

    protected $_imageFactory;

    protected $_storeManager;

    public function __construct(
    \Magento\Framework\View\Element\Template\Context $context,
    \Magento\Framework\Filesystem $filesystem,
    \Magento\Framework\Image\AdapterFactory $imageFactory,
    \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        $this->_mediaDirectory = $filesystem->getDirectoryWrite(DirectoryList::MEDIA);
        $this->_imageFactory = $imageFactory;
        $this->_storeManager = $storeManager;
        parent::__construct($context);
    }

    protected function _fileExists($filename)
    {
        if ($this->_mediaDirectory->isFile($filename)) {
            return true;
        }
        return false;
    }
    /**
    * Resize image
    * @return string
    */
    public function resize($image, $width = null, $height = null)
    {
        if(!$image){
            return;
        }
        $mediaFolder = self::DIRECTORY;

        $path = $mediaFolder . '/cache';
        /*if ($width !== null) {
            $path .= '/' . $width . 'x';
            if ($height !== null) {
                $path .= $height ;
            }
        }*/
            // echo $path."<br>";
        $newDirectory = $this->_mediaDirectory->create($path);
        $absolutePath = $this->_mediaDirectory->getAbsolutePath() .str_replace('/media/', '',$image);
        $imageResized = $this->_mediaDirectory->getAbsolutePath($path) . str_replace('/media/catalog/category','',$image);
        // echo file_exists($absolutePath);
        // echo $absolutePath."<br>".$imageResized;
        if (file_exists($absolutePath)) {
            
            $imageFactory = $this->_imageFactory->create();
            $imageFactory->open($absolutePath);
            $imageFactory->constrainOnly(true);
            $imageFactory->keepTransparency(true);
            $imageFactory->keepFrame(true);
            $imageFactory->keepAspectRatio(true);
            $imageFactory->resize($width, $height);
            $imageFactory->backgroundColor([0,0,0]);
            $imageFactory->save($imageResized);
        }
        return $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) . $path . str_replace('/media/catalog/category','',$image);
    }
}
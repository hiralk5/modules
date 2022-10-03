<?php
namespace Menu\Image\Helper;
use Magento\Framework\App\Filesystem\DirectoryList;
class Image extends \Magento\Framework\App\Helper\AbstractHelper
{
    const DIRECTORY = 'catalog/category/';

    protected $_mediaDirectory;

    protected $_imageFactory;

    protected $_storeManager;

    public function __construct(
    \Magento\Framework\App\Helper\Context $context,
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
        $mediaFolder = self::DIRECTORY;
        $path = $mediaFolder . '/cache';
        if ($width !== null) {
            $path .= '/' . $width . 'x';
            if ($height !== null) {
                $path .= $height ;
            }
        }
        $absolutePath = $this->_mediaDirectory->getAbsolutePath($mediaFolder) . $image;
        $imageResized = $this->_mediaDirectory->getAbsolutePath($path) . $image;
        if (!$this->_fileExists($path . $image)) {
            $imageFactory = $this->_imageFactory->create();
            $imageFactory->open($absolutePath);
            $imageFactory->constrainOnly(true);
            $imageFactory->keepTransparency(true);
            $imageFactory->keepFrame(true);
            $imageFactory->keepAspectRatio(true);
            $imageFactory->resize($width, $height);
            $imageFactory->save($imageResized);
        }
        return $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) . $path . $image;
    }
}

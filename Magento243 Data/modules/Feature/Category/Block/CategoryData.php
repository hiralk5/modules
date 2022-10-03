<?php

namespace Feature\Category\Block;

class CategoryData extends \Magento\Framework\View\Element\Template
{    
    protected $_categoryCollectionFactory;
    protected $_productRepository;
    protected $_registry;
    protected $storeManager;
    protected $assetRepos;
    protected $helperImageFactory;
        
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,        
        \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory $categoryCollectionFactory,
        \Magento\Catalog\Model\ProductRepository $productRepository,
        \Magento\Framework\Registry $registry,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\View\Asset\Repository $assetRepos,
        \Magento\Catalog\Helper\ImageFactory $helperImageFactory,
        array $data = []
        )
        {
            $this->_categoryCollectionFactory = $categoryCollectionFactory;
            $this->_productRepository = $productRepository;
            $this->_registry = $registry;
            $this->storeManager = $storeManager;
            $this->assetRepos = $assetRepos;
            $this->helperImageFactory = $helperImageFactory;
            parent::__construct($context, $data);
    }
    
    /**
     * Get category collection
     *
     * @param bool $isActive
     * @param bool|int $level
     * @param bool|string $sortBy
     * @param bool|int $pageSize
     * @return \Magento\Catalog\Model\ResourceModel\Category\Collection or array
     */
    public function getCategoryCollection()
    {
        $collection = $this->_categoryCollectionFactory->create();
        // $collection->addAttributeToSelect('*');        
        $collection->addAttributeToSelect('name');        
        $collection->addAttributeToSelect('is_new');        
        $collection->addAttributeToSelect('category_icon');        
        // $collection->addAttributeToSelect('');        
        $collection->addAttributeToFilter('is_new',['eq'=>1]);
        $collection->addAttributeToFilter('is_active',['eq'=>1]);
        // category_icon
        /*foreach ($collection as $key => $value) {
            echo "<pre>";
            print_r(json_decode(json_encode($value->getData())));
        }
        exit();*/

        $collection->addIsActiveFilter();//($this->_productVisibility->getVisibleInSiteIds());
// $writer = new \Zend_Log_Writer_Stream(BP . '/var/log/custom.log');
            // $logger = new \Zend_Log();
            // $logger->addWriter($writer);
            // $logger->info('----------');
        
        // $logger->info(print_r(get_class_methods($collection)),true);
        // select only active categories
        /*if ($isActive) {
            $collection->addIsActiveFilter();
        }*/
        return $collection;
    }

    public function getMediaUrl()
    {
        return $this->storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
    }

    public function getPlaceHolder()
    {
        $imagePlaceholder = $this->helperImageFactory->create();
        return $this->assetRepos->getUrl($imagePlaceholder->getPlaceholder('small_image'));
    }
}
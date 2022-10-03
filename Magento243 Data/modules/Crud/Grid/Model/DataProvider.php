<?php

namespace Crud\Grid\Model;

use Crud\Grid\Model\ResourceModel\Faq\CollectionFactory;
use Magento\Store\Model\StoreManagerInterface;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    protected $collection;
    /**
     * @var loadedData
     */
    protected $loadedData;
     /**
      * @var storeManager
      */
    protected $storeManager;
    
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        StoreManagerInterface $storeManager,
        CollectionFactory $contactCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $contactCollectionFactory->create();
        $this->storeManager = $storeManager;
        parent::__construct(
            $name,
            $primaryFieldName,
            $requestFieldName,
            $meta,
            $data
        );
    }
    /**
     * @return getData
     */

    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();
        foreach ($items as $item) {
            $itemData = $item->getData();
            if (isset($itemData['image'])) {
                $imageName = $itemData['image'];
                if($imageName){
                    
                $itemData['image'] = [
                    [
                        'name' => $imageName,
                        'url' => $this->storeManager->getStore()
                        ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA)
                        . 'faq/' . $itemData['image'],
                    ],
                ];
                }
            }            
            $this->loadedData[$item->getId()] = $itemData;
        }
        return $this->loadedData;
    }
}

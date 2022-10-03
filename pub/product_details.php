<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

use Magento\Framework\App\Bootstrap;
require '../app/bootstrap.php';
$bootstrap = Bootstrap::create(BP, $_SERVER);
$objectManager = $bootstrap->getObjectManager();
$state = $objectManager->get('Magento\Framework\App\State');

$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
$objectManager->get('Magento\Framework\App\State')->setAreaCode('frontend');

$fileFactory = $objectManager->get('Magento\Framework\App\Response\Http\FileFactory');
// $productFactory = $objectManager->get('Magento\Catalog\Model\ProductFactory');
$productCollection = $objectManager->create('Magento\Catalog\Model\ResourceModel\Product\Collection');
$csvProcessor = $objectManager->get('Magento\Framework\File\Csv');
$directoryList = $objectManager->get('Magento\Framework\App\Filesystem\DirectoryList');
$collection = $productCollection->addAttributeToSelect('*')->load();
$content[] = [
    'sku' => __('Sku'),
    'name' => __('Product Name'),
    'price' => __('Price'),
    'url_key' => __('Url Key'),
    'image' => __('Image')
];
    // echo "<pre>";
// print_r($content);exit;
// $product = $productFactory->create()->getCollection();
// $collection = $productFactory->create()->getCollection();

$fileName = 'product_excel.xls'; // Add Your CSV File name
$filePath = $directoryList->getPath(Magento\Framework\App\Filesystem\DirectoryList::MEDIA) . "/" . $fileName;
foreach ($collection as $product){
    $productFactory = $objectManager->get('Magento\Catalog\Api\ProductRepositoryInterface')->getById($product->getId());
    $productImages = $productFactory->getMediaGalleryEntries();
     
    $label = '';
    $productImageData = [];
    foreach ($productImages as $image) {
        // echo $image->getFile();
        // echo $image->getFilePath();
        $productImageData[] =$image->getFile();
        // $productImageData[] =$image->getFile();

    }

    foreach ($productImageData as $imageData) {
        // getimagesize($imageData);
        $imagesDetails = explode('/',$imageData);
        // echo"<pre>";
        // print_r($imageData);
        $content[] = [
            $product->getSku(),
            $product->getName(),
            $product->getProductPrice(),
            $product->getUrlKey(),
            $imageData
            
        ];
    }
}


/*while ($product = $collection->fetchItem()) {
    $productData = $productLoader->create()->load($product->getEntityId());
    $content[] = [
        $product->getSku(),
        $product->getName(),
        $product->getProductPrice(),
        $product->getUrlKey(),
        $product->getImage()
    ];
    // echo"<pre>";print_r($content);die;
die;
}*/
$csvProcessor->setEnclosure('"')->setDelimiter(',')->saveData($filePath, $content);
$fileFactory->create($fileName, ['type' => "filename",
    'value' => $fileName,
    'rm' => true,
    // True => File will be remove from directory after download.
],$directoryList::MEDIA, 'text/xls', null);
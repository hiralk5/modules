<?php
/**
 * Copyright © 2017 BORN . All rights reserved.
 */
namespace Label\Product\Observer;

use \Magento\Framework\Event\Observer;
use \Magento\Framework\Event\ObserverInterface;

class SerializedAttractionHighlights implements ObserverInterface
{
    const ATTR_PRODUCT_LABEL = 'product_label_fieldset';

    /**
     * @var  \Magento\Framework\App\RequestInterface
     */
    protected $request;

    /**
     * Constructor
     */
    public function __construct(
        \Magento\Framework\App\RequestInterface $request
    )
    {
        $this->request = $request;
    }

    public function execute(Observer $observer)
    {
        /** @var $product \Magento\Catalog\Model\Product */
        $product = $observer->getEvent()->getDataObject();
        $post = $this->request->getPost();
        $post = $post['product'];
        $labels = isset($post[self::ATTR_PRODUCT_LABEL]) ? $post[self::ATTR_PRODUCT_LABEL] : '';
        $requiredParams = ['position','title'];
        if (is_array($labels)) {
            $labels = $this -> removeEmptyArray($labels, $requiredParams);
            $product -> setProductLabelFieldset(json_encode($labels));
        }
    }

    /**
    * Function to remove empty array from the multi dimensional array
    *
    * @return Array
    */
    private function removeEmptyArray($attractionData, $requiredParams){

        $requiredParams = array_combine($requiredParams, $requiredParams);
        $reqCount = count($requiredParams);
        // echo "<pre>";print_r($attractionData);die;

        foreach ($attractionData as $key => $values) {
            // echo $values;die;
            $values = array_filter($values);
            $inersectCount = count(array_intersect_key($values, $requiredParams));
            if ($reqCount != $inersectCount) {
                unset($attractionData[$key]);
            }  
        }
        return $attractionData; 
    }
}
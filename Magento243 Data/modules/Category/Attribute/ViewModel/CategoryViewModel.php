<?php

namespace Category\Attribute\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;

class CategoryViewModel implements ArgumentInterface
{

    private $registry;
    protected $categoryFactory;

    public function __construct(
        \Magento\Framework\Registry $registry,
        \Magento\Cms\Model\Template\FilterProvider $filterProvider
    ) {
        $this->registry = $registry;
        $this->_filterProvider = $filterProvider;
    }

    public function getCurrentCategoryDetails()
    {
        $currentCategory = $this->registry->registry('current_category')->getData();
        // $current_cat_id = $this->_registry->registry('current_category')->getId();
        // $categoryData = $this->_categoryFactory->create()->load($currentCategory);
        // $getContent = $categoryData->getData(is_visible_subtitle); //is_home_page =  your attribute code
        
        return $currentCategory;


        /*if ($currentCategory) {
            $_attribute = ($currentCategory->getAttribute());
            $_heading = trim($currentCategory->getHeading());

            if ($_heading === '' && $_attribute === '') {
                $_heading = $currentCategory->getName();

            }
        }

        return $_attribute;*/
    }
    public function addWidget($description) {
     $newDescription = $this->_filterProvider->getPageFilter()->filter(
           $description
     );
     return $newDescription;
}   
}
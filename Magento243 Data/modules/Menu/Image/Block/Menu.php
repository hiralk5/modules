<?php

namespace Menu\Image\Block;

use Magento\Framework\Data\Tree\Node;
use Magento\Framework\Data\Tree\Node\Collection;
use Magento\Framework\Data\Tree\NodeFactory;
use Magento\Framework\Data\TreeFactory;

class Menu extends \Magiccart\Magicmenu\Block\Menu
{
    
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Menu\Image\Block\ImageResize $imageresize,
        \Magento\Catalog\Model\CategoryFactory $categoryFactory,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        \Magento\Catalog\Model\Layer\Resolver $layerResolver,
        \Magento\Framework\App\Http\Context $httpContext,
        \Magento\Catalog\Helper\Category $catalogCategory,
        \Magento\Framework\Registry $registry,
        \Magento\Catalog\Model\Indexer\Category\Flat\State $flatState,
        \Magento\Framework\Serialize\Serializer\Json $serializer = null,
        \Magiccart\Magicmenu\Helper\Data $helper,
        \Magiccart\Magicmenu\Model\ResourceModel\Magicmenu\CollectionFactory $magicmenuCollectionFactory,
        NodeFactory $nodeFactory,
        TreeFactory $treeFactory,
        array $data = []
    ) {
        $this->imageresize = $imageresize;
            parent::__construct(
                $context,
                $categoryFactory,
                $productCollectionFactory,
                $layerResolver,
                $httpContext,
                $catalogCategory,
                $registry,
                $flatState,
                $serializer,
                $helper,
                $magicmenuCollectionFactory,
                $nodeFactory,
                $treeFactory,
                $data
            );
    }

   public function getMegamenu($catTop, $blocks, $itemPositionClassPrefix)
    {
        // Draw Mega Menu 
        $idTop    = $catTop->getEntityId();
        $hasChild = $catTop->hasChildren();
        $desktopTmp = $mobileTmp  = '';
        if($hasChild || $blocks['top'] || $blocks['left'] || $blocks['right'] || $blocks['bottom']) :
            $desktopTmp .= '<div class="level-top-mega">';  /* Wrap Mega */
                $desktopTmp .='<div class="content-mega">';  /*  Content Mega */
                    $desktopTmp .= $blocks['top'];
                    $desktopTmp .= '<div class="content-mega-horizontal">';
                        $desktopTmp .= $blocks['left'];
                        if($hasChild) :
                            $desktopTmp .= '<ul class="level0 category-item mage-column cat-mega">';
                            $mobileTmp .= '<ul class="submenu">';
                            $childTop  =  $catTop->getChildren();
                            $childLevel = $this->getChildLevel($catTop->getLevel());
                            $this->removeChildrenWithoutActiveParent($childTop, $childLevel);
                            $counter = 1;
                            foreach ($childTop as $cat) {
                                if(!$cat->getData('is_parent_active')) continue;
                                $itemPositionClassPrefixChild = $itemPositionClassPrefix . '-' . $counter;
                                $class = 'level1 category-item ' . $itemPositionClassPrefixChild . ' ' . $this->_getActiveClasses($cat->getEntityId());


$imgres='';

if($cat->getImage()) {
    $imgres = $this->imageresize->resize($cat->getImage(),200,200);
}

                              /*  $imageRes = $cat->getImage();
echo $_imagehelper->init($_product, 'product_base_image')->keepAspectRatio(true)->resize('400', '400');                                
echo "<pre>";
print_r( $cat->getName());
print_r( $cat->getImage());

if($imgres !== null){
    echo "-----------------".getType($imgres);
    echo "----".'<img src="'.$imgres.'" />';
}*/
if($imgres){

// $image = '<img src="'.$cat->getImage().'" />';
                                $image = '<img src="'.$imgres.'" />';
                            }else{echo "null"; die;}
                                $url ='<a href="'. $cat->getUrl() .'"><span>' . $cat->getName() . $this->getCatLabel($cat) . '</span></a>';
                                $catChild  = $cat->getChildren();
                                $childHtml = $this->getTreeCategories($catChild, $itemPositionClassPrefixChild); // include magic_label and Maximal Depth
                                $desktopTmp .= '<li class="children ' . $class . '">'  . $url .$image. $childHtml . '</li>';
                                $mobileTmp  .= '<li class="' . $class . '">' .  $url .$image. $childHtml . '</li>';
                                $counter++;
                            }
                            //$desktopTmp .= '<li>'  .$blocks['bottom']. '</li>';
                            $desktopTmp .= '</ul>'; // end cat-mega
                            $mobileTmp .= '</ul>';
                        endif;
                        $desktopTmp .= $blocks['right'];
                    $desktopTmp .= '</div>';
                    $desktopTmp .= $blocks['bottom'];
                $desktopTmp .= '</div>';  /* End Content mega */
            $desktopTmp .= '</div>';  /* Warp Mega */
        endif;
        return array('desktop' => $desktopTmp, 'mobile' => $mobileTmp);
    }

    private function getChildLevel($parentLevel): int
    {
        return $parentLevel === null ? 0 : $parentLevel + 1;
    }

    private function removeChildrenWithoutActiveParent(Collection $children, int $childLevel): void
    {
        foreach ($children as $child) {
            if ($childLevel === 0 && $child->getData('is_parent_active') === false) {
                $children->delete($child);
            }
        }
    }


    protected function getCategoryTree($storeId, $rootId)
    {
        // echo "hhhhhhhhhhh";die;
        /** @var \Magento\Catalog\Model\ResourceModel\Category\Collection $collection */
        $collection = $this->_categoryInstance->getCollection();
        $collection->setStoreId($storeId);
        $collection->addAttributeToSelect(['name', 'magic_label','image']);
        $collection->addFieldToFilter('path', ['like' => '1/' . $rootId . '/%']); //load only from store root
        $collection->addAttributeToFilter('include_in_menu', 1);
        $collection->addIsActiveFilter();
        $collection->addNavigationMaxDepthFilter();
        $collection->addUrlRewriteToResult();
        $collection->addOrder('level', 'ASC');
        $collection->addOrder('position', 'ASC');
        $collection->addOrder('parent_id', 'ASC');
        $collection->addOrder('entity_id', 'ASC');
        // echo "here<pre>"; print_r($collection->getData());echo "tadaaa";die;
        return $collection;
    }
    public function getTreeMenu($storeId, $rootId)
    {
        $collection = $this->getCategoryTree($storeId, $rootId);
        $currentCategory = $this->getCurrentCategory();
        $mapping = [$rootId => $this->getMenu()];  // use nodes stack to avoid recursion
        foreach ($collection as $category) {
            $categoryParentId = $category->getParentId();
            if (!isset($mapping[$categoryParentId])) {
                $parentIds = $category->getParentIds();
                foreach ($parentIds as $parentId) {
                    if (isset($mapping[$parentId])) {
                        $categoryParentId = $parentId;
                    }
                }
            }

            /** @var Node $parentCategoryNode */
            $parentCategoryNode = $mapping[$categoryParentId];

            $categoryNode = new Node(
                $this->getCategoryAsArray(
                    $category,
                    $currentCategory,
                    $category->getParentId() == $categoryParentId
                ),
                'id',
                $parentCategoryNode->getTree(),
                $parentCategoryNode
            );
            $parentCategoryNode->addChild($categoryNode);

            $mapping[$category->getId()] = $categoryNode; //add node in stack
        }
        $menu = isset($mapping[$rootId]) ? $mapping[$rootId]->getChildren() : [];

        return $menu;
    }

    private function getCategoryAsArray($category, $currentCategory, $isParentActive)
    {
        $categoryId = $category->getId();
        return [
            'name' => $category->getName(),
            'image' => $category->getImage(),
            'id' => 'category-node-' . $categoryId,
            'url' => $this->_catalogCategory->getCategoryUrl($category),
            'has_active' => in_array((string)$categoryId, explode('/', (string)$currentCategory->getPath()), true),
            'is_active' => $categoryId == $currentCategory->getId(),
            'is_category' => true,
            'is_parent_active' => $isParentActive,
            'entity_id' => $categoryId,
            'level' => $category->getLevel(),
            'magic_label' => $category->getMagicLabel(),
        ];
    }
}

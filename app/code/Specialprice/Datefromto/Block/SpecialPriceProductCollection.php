<?php

    namespace Specialprice\Datefromto\Block;

    use Magento\Catalog\Api\CategoryRepositoryInterface;

    class SpecialPriceProductCollection extends \Magento\Catalog\Block\Product\ListProduct {

        protected $_collection;

        protected $categoryRepository;

        protected $_resource;

        public function __construct(
        \Magento\Catalog\Block\Product\Context $context, 
                \Magento\Framework\Data\Helper\PostHelper $postDataHelper, 
                \Magento\Catalog\Model\Layer\Resolver $layerResolver, 
                CategoryRepositoryInterface $categoryRepository,
                \Magento\Framework\Url\Helper\Data $urlHelper, 
                \Magento\Catalog\Model\ResourceModel\Product\Collection $collection, 
                \Magento\Framework\App\ResourceConnection $resource,
                array $data = []
        ) {
            $this->categoryRepository = $categoryRepository;
            $this->_collection = $collection;
            $this->_resource = $resource;

            parent::__construct($context, $postDataHelper, $layerResolver, $categoryRepository, $urlHelper, $data);
        }

        public function getProducts() {
            $count = $this->getProductCount();
            $category_id = $this->getData("category_id");
            $collection = clone $this->_collection;
            $collection->clear()->getSelect()->reset(\Magento\Framework\DB\Select::WHERE)->reset(\Magento\Framework\DB\Select::ORDER)->reset(\Magento\Framework\DB\Select::LIMIT_COUNT)->reset(\Magento\Framework\DB\Select::LIMIT_OFFSET)->reset(\Magento\Framework\DB\Select::GROUP);

            if(!$category_id) {
                $category_id = $this->_storeManager->getStore()->getRootCategoryId();
            }
            $category = $this->categoryRepository->get($category_id);
            $now = date('Y-m-d');
            if(isset($category) && $category) {
                $collection->addMinimalPrice()
                    ->addFinalPrice()
                    ->addTaxPercents()
                    ->addAttributeToSelect('name')
                    ->addAttributeToSelect('image')
                    ->addAttributeToSelect('small_image')
                    ->addAttributeToSelect('thumbnail')
                    ->addAttributeToSelect('special_from_date')
                    ->addAttributeToSelect('special_to_date')
                    ->addAttributeToFilter('special_price', ['neq' => ''])
                    ->addAttributeToFilter([
                        [
                            'attribute' => 'special_from_date',
                            'lteq' => date('Y-m-d G:i:s', strtotime($now)),
                            'date' => true,
                        ],
                        [
                            'attribute' => 'special_to_date',
                            'gteq' => date('Y-m-d G:i:s', strtotime($now)),
                            'date' => true,
                        ]
                    ])
                    ->addAttributeToFilter('is_saleable', 1, 'left');
            } else {
                $collection->addMinimalPrice()
                    ->addFinalPrice()
                    ->addTaxPercents()
                    ->addAttributeToSelect('name')
                    ->addAttributeToSelect('image')
                    ->addAttributeToSelect('small_image')
                    ->addAttributeToSelect('thumbnail')
                    ->addAttributeToFilter('special_price', ['neq' => ''])
                    ->addAttributeToSelect('special_from_date')
                    ->addAttributeToSelect('special_to_date')
                    ->addAttributeToFilter([
                        [
                            'attribute' => 'special_from_date',
                            'lteq' => date('Y-m-d G:i:s', strtotime($now)),
                            'date' => true,
                        ],
                        [
                            'attribute' => 'special_to_date',
                            'gteq' => date('Y-m-d G:i:s', strtotime($now)),
                            'date' => true,
                        ]
                    ])
                    ->addAttributeToFilter('is_saleable', 1, 'left');
            }

            $collection->getSelect()
                    ->limit($count);

            return $collection;
        }

        public function getLoadedProductCollection() {
            return $this->getProducts();
        }

        public function getProductCount() {
            $limit = $this->getData("product_count");
            if(!$limit)
                $limit = 10;
            return $limit;
        }
    }
<?php

namespace Sku\Coupon\Ui\Component\Listing\Column;

use Magento\Sales\Api\OrderRepositoryInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\Api\SearchCriteriaBuilder;

class Products extends Column
{
    protected $_orderRepository;
    protected $_searchCriteria;

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        OrderRepositoryInterface $orderRepository,
        SearchCriteriaBuilder $criteria,
        array $components = [],
        array $data = [])
    {
        $this->_orderRepository = $orderRepository;
        $this->_searchCriteria  = $criteria;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$items) {
                $productArr = [];
                $order  = $this->_orderRepository->get($items["entity_id"]);

                foreach ($order->getAllVisibleItems() as $item) {
                    $productArr[] = $item->getSku();
                    $productArr[] = ' * ';
                    $productArr[] = round($item->getQtyOrdered());
                    
                }
                
                $items['sku_qty'] = implode('  ', $productArr);
                unset($productArr);

            }
        }
        return $dataSource;
    }
}
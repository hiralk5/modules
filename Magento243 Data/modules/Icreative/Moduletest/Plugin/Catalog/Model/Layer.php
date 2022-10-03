<?php 
namespace Icreative\Moduletest\Plugin\Catalog\Model;

class Layer
{
	public function afterGetProductCollection(
		\Magento\CatalogSearch\Model\ResourceModel\Fulltext\Collection $subject, 
		$printQuery = false, 
		$logQuery = false
      // \Magento\Catalog\Model\Layer $subject,
      // \Magento\Catalog\Model\ResourceModel\Product\Collection $collection
  ) {
		$orderBy = $subject->getSelect()->getPart(\Zend_Db_Select::ORDER);
        $outOfStockOrderBy = array('is_salable DESC');
        /* reset default product collection filter */
        $subject->getSelect()->reset(\Zend_Db_Select::ORDER);
        $subject->getSelect()->order($outOfStockOrderBy);

        return [$printQuery, $logQuery];
      //$collection->getSelect()->order('is_salable DESC');
      //return $collection;

  }
		/*echo "here";

public function afterGetProductCollection(
      \Magento\Catalog\Model\Layer $subject,
      \Magento\Catalog\Model\ResourceModel\Product\Collection $collection
  ) {
      $collection->getSelect()->order('is_salable DESC');
      return $collection;
  }
		
		if(escapeHtml(__('In stock')))
		{
			echo "In STOCK";
		}
		else
		{
			echo "OUT OF STOck";
		}*/
	
}
?>
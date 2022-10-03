<?php 

namespace Icreative\Moduletest\Plugin;

class ProductDefaultQty{

	public function afterGetProductDefaultQty(\Magento\Catalog\Block\Product\View $subject,$qty){
		
		return $qty + 5;

	}
}

?>
<?php 

namespace Icreative\Moduletest\Plugin;

class PageHeading{

	public function afterGetPageHeading(\Magento\Theme\Block\Html\Title $subject, $result){
		
		return " Test778 ". $result;

	}
}

?>
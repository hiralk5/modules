<?php 

namespace Icreative\Moduletest\Block;
 
use Magento\Framework\App\Filesystem\DirectoryList;
 
class Index extends \Magento\Framework\View\Element\Template
{
     protected $_filesystem;
 
    public function __construct(
      \Magento\Framework\View\Element\Template\Context $context
    ) {
          parent::__construct($context);
     }
}

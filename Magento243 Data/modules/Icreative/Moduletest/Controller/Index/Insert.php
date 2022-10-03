<?php 
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);


namespace Icreative\Moduletest\Controller\Index;
 
class Insert extends \Magento\Framework\App\Action\Action
{
     protected $_pageFactory;
 
     public function __construct(
          \Magento\Framework\App\Action\Context $context,
          \Magento\Framework\View\Result\PageFactory $pageFactory
          )
     {
          $this->_pageFactory = $pageFactory;
          return parent::__construct($context);
     }
 
     public function execute()
     {
          return $this->_pageFactory->create();
     }
}

?>
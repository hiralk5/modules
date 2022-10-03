<?php 

namespace Icreative\Moduletest\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class StoreDataInAnotherTable implements ObserverInterface
{
	protected $resourceConnection;
    protected $eavAttributeFactory;
    protected $observerexample;

    public function __construct(
        \Magento\Framework\App\ResourceConnection $resourceConnection,
        \Magento\Eav\Model\Entity\AttributeFactory $eavAttributeFactory,
    	\Icreative\Moduletest\Model\ObserverExampleFactory $observerexample) 
    {
        $this->resourceConnection = $resourceConnection;
        $this->eavAttributeFactory = $eavAttributeFactory;
        $this->observerexample = $observerexample;
	}


	public function execute(\Magento\Framework\Event\Observer $observer)
	{
		$item = $observer->getEvent()->getData();           
		$model = $this->observerexample->create();
		$model->setData($item);
		$model->save();
      
	}
}

?>
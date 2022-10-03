<?php

namespace Icreative\Moduletest\Controller\Index;

class Save extends \Magento\Framework\App\Action\Action
{
	protected $moduletestModel;

	public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Icreative\Moduletest\Model\ModuletestFactory $moduletestModel
    ) {
    	$this->moduletestModel = $moduletestModel;
        parent::__construct($context);
    }

    public function execute()
    {
    	
    	$faqData = $this->getRequest()->getParams();
    	$model = $this->moduletestModel->create();
		$model->setData($faqData);
    	// $question = $this->getRequest()->getParam('question');
    	// $answer = $this->getRequest()->getParam('answer');
    	// $status = $this->getRequest()->getParam('status');
		// $model->addData([
		// 	"question" => $question,
		// 	"answer" => $answer,
		// 	"status" => $status
		// 	]);
		 $this->_eventManager->dispatch('faq_after_save',$faqData);
	
        $saveData = $model->save();
        
    }
}

?>
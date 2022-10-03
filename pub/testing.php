<?php 
error_reporting(E_ALL);
ini_set('display_errors', '1');

use Magento\Framework\App\Bootstrap;
require '../app/bootstrap.php';
$bootstrap = Bootstrap::create(BP, $_SERVER);
$objectManager = $bootstrap->getObjectManager();
$state = $objectManager->get('Magento\Framework\App\State');
$state->setAreaCode('frontend');
echo "=======";

// $id = 2;

$objectManager =  \Magento\Framework\App\ObjectManager::getInstance();        

$categoryFactory = $objectManager->get('\Magento\Customer\Model\CustomerFactory');
 $cart = $objectManager->get('\Magento\Checkout\Model\Cart');

 print_r($categoryFactory);die;
<?php
 
namespace Icreative\Moduletest\Setup;
 
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
 
class InstallData implements InstallDataInterface
{
 
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
 
        $tableName = $setup->getTable('aktiv_faq_test');
        //Check for the existence of the table
        if ($setup->getConnection()->isTableExists($tableName) == true) {
            $data = [
                [
                    'question' => 'How to Speed Up Magento 2 Website',
                    'answer' => 'Speeding up your Magento 2 website is very important, it affects user experience. Customers will feel satisfied when your site responds quickly',
                    'status' => 1,
                ],
                [
                    'question' => 'Optimize SEO for Magento Website',
                    'answer' => 'One of the important reasons why many people choose Magento 2 for their website is the ability to create SEO friendly',
                    'status' => 1,
                ],
                [
                    'question' => 'Top 10 eCommerce Websites',
                    'answer' => 'These are the websites of famous e-commerce corporations in the world. With very large revenue contributing to the world economy',
                    'status' => 0,
                ],
            ];
            foreach ($data as $item) {
                //Insert data
                $setup->getConnection()->insert($tableName, $item);
            }
        }
        $setup->endSetup();
    }
}
<?php
namespace Producttype\Offerminmax\Setup\Patch\Data;

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class Addyesnodatapatch implements DataPatchInterface
{
   private $_moduleDataSetup;

   private $_eavSetupFactory;

   public function __construct(
       ModuleDataSetupInterface $moduleDataSetup,
       EavSetupFactory $eavSetupFactory
   ) {
       $this->_moduleDataSetup = $moduleDataSetup;
       $this->_eavSetupFactory = $eavSetupFactory;
   }

   public function apply()
   {
       /** @var EavSetup $eavSetup */
       $eavSetup = $this->_eavSetupFactory->create(['setup' => $this->_moduleDataSetup]);

       $eavSetup->addAttribute(\Magento\Catalog\Model\Product::ENTITY, 'is_newal', [
           'type' => 'int',
           'backend' => '',
           'frontend' => '',
           'label' => 'Is Newal',
           'input' =>'boolean',
           'class' => '',
           'source' => Magento\Eav\Model\Entity\Attribute\Source\Boolean,
           'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
           'visible' => true,
           'required' => false,
           'user_defined' => false,
           'default' => 'No',
           'searchable' => false,
           'filterable' => false,
           'comparable' => false,
           'visible_on_front' => true,
           'used_in_product_listing' => true,
           
       ]);
   }

   public static function getDependencies()
   {
       return [];
   }

   public function getAliases()
   {
       return [];
   }

   public static function getVersion()
   {
      return '1.0.0';
   }
}
<?php

namespace Feature\Category\Setup;

// use Magento\Eav\Model\Entity\Attribute\Source\Boolean;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Catalog\Setup\CategorySetupFactory;
use Magento\Framework\Module\Setup\Migration;


class UpgradeData implements UpgradeDataInterface
{
    private $eavSetupFactory;

    public function __construct(EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        if ($context->getVersion() && version_compare($context->getVersion(), '1.0.9') < 0) {


            /* For Remove Attribute */
            $eavSetup->removeAttribute(\Magento\Catalog\Model\Category::ENTITY, 'is_new');

            /* For Create New Attribute */
            $eavSetup->addAttribute(
                \Magento\Catalog\Model\Category::ENTITY,
                'is_new',[
                    'type' => 'int',
                    'label' => 'Is New',
                    'input' => 'boolean',
                    'source' => '',
                    'required' => false,
                    'sort_order' => 35,
                    'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                    'user_defined' => false,
                    'default' => 0,
                    'visible' => true,
                    'group' => 'General',
                ]
            );
            $eavSetup->updateAttribute(\Magento\Catalog\Model\Category::ENTITY, 'is_new', 'position', 101);

          

            $eavSetup->removeAttribute(\Magento\Catalog\Model\Category::ENTITY, 'category_icon');

            $eavSetup->addAttribute(
                \Magento\Catalog\Model\Category::ENTITY,
                'category_icon',[
                    'type' => 'varchar',
                    'label' => 'Icon',
                    'input' => 'image',
                    'backend' => 'Magento\Catalog\Model\Category\Attribute\Backend\Image',
                    'required' => false,
                    'sort_order' => 5,
                    'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                    'group' => 'General',
                ]
            );

            $eavSetup->updateAttribute(\Magento\Catalog\Model\Category::ENTITY, 'category_icon', 'position', 101);

            
        }
        $setup->endSetup();
        
    }
}
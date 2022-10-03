<?php
namespace Label\Product\Setup;

use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;

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
        if ($context->getVersion() && version_compare($context->getVersion(), '1.0.3') < 0) {


            /* For Remove Attribute */
            $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY, 'product_label_fieldset');

            /* For Create New Attribute */
            $eavSetup->addAttribute(
                \Magento\Catalog\Model\Product::ENTITY,
                'product_label_fieldset',[
                    'type' => 'text',
                    'label' => 'Product Label[dynamic]',
                    'input' => 'text',
                    'required' => false,
                    'sort_order' => 35,
                    'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                    'default' => null,
                    'visible' => true,
                    // 'backend' => 'Magento\Eav\Model\Entity\Attribute\Backend\ArrayBackend',
                    'group' => 'customization-tab',                ]
            );
            $eavSetup->updateAttribute(\Magento\Catalog\Model\Product::ENTITY, 'product_label_fieldset', 'position', 101);
        }
        $setup->endSetup();
        
    }
}
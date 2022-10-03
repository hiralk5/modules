<?php

namespace Product\Attribute\Setup;

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;

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
        if ($context->getVersion() && version_compare($context->getVersion(), '1.0.5') < 0) {

            $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY, 'product_top');

            /* For Create New Attribute */
            $eavSetup->addAttribute(
                \Magento\Catalog\Model\Product::ENTITY,
                'product_top',[
                    'type' => 'text',
                    'label' => 'Product Top',
                    'input' => 'textarea',
                    // 'input'        => 'text',
                    'required' => false,
                    'sort_order' => 101,
                     'visible'      => true,
                     'default'      => null,
                    'global' =>\Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                    'wysiwyg_enabled' => true,
                    'is_html_allowed_on_front' => true,
                    'group' => 'Customization Tab',
                ]
            );
            $eavSetup->updateAttribute(\Magento\Catalog\Model\Product::ENTITY, 'product_top', 'position', 101);

            $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY, 'product_custom_name');

            /* For Create New Attribute */
            $eavSetup->addAttribute(
                \Magento\Catalog\Model\Product::ENTITY,
                'product_custom_name',[
                    'type' => 'text',
                'label' => 'Product Custom Name',
                'input' => 'text',
                'required' => false,
                'sort_order' => 101,
                'visible'      => true,
                'required'     => false,
                'global' =>\Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                'group' => 'Customization Tab',
                'visible_on_front' => true,
                'used_in_product_listing' => true,
                ]
            );
            $eavSetup->updateAttribute(\Magento\Catalog\Model\Product::ENTITY, 'product_custom_name', 'position', 101);




            $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY, 'subtitle');

            /* For Create New Attribute */
            $eavSetup->addAttribute(
                \Magento\Catalog\Model\Product::ENTITY,
                'subtitle',[
                    'type'         => 'varchar',
                    'label'        => 'Subtitle',
                    'input'        => 'text',
                    'sort_order'   => 100,
                    'source'       => '',
                    'global'       => 1,
                    'visible'      => true,
                    'required'     => false,
                    'user_defined' => false,
                    'default'      => null,
                    'group'        => 'Customization Tab',
                    'backend'      => '',
                ]
            );
            $eavSetup->updateAttribute(\Magento\Catalog\Model\Product::ENTITY, 'subtitle', 'position', 101);


            /* For Remove Attribute */
            $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY, 'is_visible_subtitle');

            /* For Create New Attribute */
            $eavSetup->addAttribute(
                \Magento\Catalog\Model\Product::ENTITY,
                'is_visible_subtitle',[
                    'type' => 'int',
                    'label' => 'Sub Product visible',
                    'input' => 'boolean',
                    'source' => '',
                    'required' => false,
                    'sort_order' => 35,
                    'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                    'user_defined' => false,
                    'default' => 0,
                    'visible' => true,
                    'group' => 'Customization Tab',
                ]
            );
            $eavSetup->updateAttribute(\Magento\Catalog\Model\Product::ENTITY, 'is_visible_subtitle', 'position', 101);

            

            

            $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY, 'product_color');

            $eavSetup->addAttribute(
                \Magento\Catalog\Model\Product::ENTITY,
                'product_color',[
                    'type' => 'varchar',
                    'label' => 'Product Color',
                    'input' => 'select',
                    'sort_order' => 107,
                    'source' => 'Product\Attribute\Model\Config\Source\ColorOption',
                    'global' => 1,
                    'visible' => true,
                    'required' => false,
                    'user_defined' => false,
                    'default' => null,
                    'group' => 'Customization Tab',
                    'backend' => '',
                ]
            );
            $eavSetup->updateAttribute(\Magento\Catalog\Model\Product::ENTITY, 'product_color', 'position', 101);

            
            $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY, 'product_material');

            $eavSetup->addAttribute(
                \Magento\Catalog\Model\Product::ENTITY,
                'product_material',[
                    'group' => 'Customization Tab',
                    'label' => 'Product Material',
                    'type'  => 'text',
                    'input' => 'multiselect',
                    'source' => 'Product\Attribute\Model\Config\Source\MaterialSelection',
                    'required' => false,
                    'sort_order' => 30,
                    'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                    'used_in_product_listing' => true,
                    'backend' => 'Magento\Eav\Model\Entity\Attribute\Backend\ArrayBackend',
                    'visible_on_front' => false
                ]
            );

            /* For Update Attribute */
            $eavSetup->updateAttribute(\Magento\Catalog\Model\Product::ENTITY, 'product_material', 'position', 101);

            $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY, 'product_name_test');

            $eavSetup->addAttribute(
                \Magento\Catalog\Model\Product::ENTITY,
                'product_name_test',[
                    'group' => 'Customization Tab',
                    'label' => 'Product Name Test',
                    'type'  => 'text',
                    'input' => 'text',
                    'required' => false,
                    'sort_order' => 30,
                    'global' => 1 ,
                    'used_in_product_listing' => true,
                    'visible'      => true,
                    'required'     => false,
                    'user_defined' => false,
                ]
            );

            /* For Update Attribute */
            $eavSetup->updateAttribute(\Magento\Catalog\Model\Product::ENTITY, 'product_name_test', 'position', 101);
            $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY, 'product_temprature');

            $eavSetup->addAttribute(
                \Magento\Catalog\Model\Product::ENTITY,
                'product_temprature',[
                    'group' => 'Customization Tab',
                    'label' => 'Product Temprature',
                    'type'  => 'text',
                    'input' => 'text',
                    'required' => false,
                    'sort_order' => 30,
                    'default' => null,
                    'global' => 1,
                    'used_in_product_listing' => true,
                    'visible'      => true,
                    'required'     => false,
                    'user_defined' => false,
                ]
            );

            /* For Update Attribute */
            $eavSetup->updateAttribute(\Magento\Catalog\Model\Product::ENTITY, 'product_temprature', 'position', 101);

        }
        $setup->endSetup();
        
    }
}
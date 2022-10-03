<?php

namespace Category\Attribute\Setup;

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
        if ($context->getVersion() && version_compare($context->getVersion(), '1.0.4') < 0) {


            /* For Remove Attribute */
            $eavSetup->removeAttribute(\Magento\Catalog\Model\Category::ENTITY, 'is_visible_subtitle');

            /* For Create New Attribute */
            $eavSetup->addAttribute(
                \Magento\Catalog\Model\Category::ENTITY,
                'is_visible_subtitle',[
                    'type' => 'int',
                    'label' => 'Sub Category visible',
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
            $eavSetup->updateAttribute(\Magento\Catalog\Model\Category::ENTITY, 'is_visible_subtitle', 'position', 101);

            $eavSetup->removeAttribute(\Magento\Catalog\Model\Category::ENTITY, 'category_top');

            /* For Create New Attribute */
            $eavSetup->addAttribute(
                \Magento\Catalog\Model\Category::ENTITY,
                'category_top',[
                    'type' => 'text',
                    'label' => 'Category Top',
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
            $eavSetup->updateAttribute(\Magento\Catalog\Model\Category::ENTITY, 'category_top', 'position', 101);

            $eavSetup->removeAttribute(\Magento\Catalog\Model\Category::ENTITY, 'subtitle');

            /* For Create New Attribute */
            $eavSetup->addAttribute(
                \Magento\Catalog\Model\Category::ENTITY,
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
            $eavSetup->updateAttribute(\Magento\Catalog\Model\Category::ENTITY, 'subtitle', 'position', 101);

            $eavSetup->removeAttribute(\Magento\Catalog\Model\Category::ENTITY, 'category_color');

            $eavSetup->addAttribute(
                \Magento\Catalog\Model\Category::ENTITY,
                'category_color',[
                    'type' => 'varchar',
                    'label' => 'Category Color',
                    'input' => 'select',
                    'sort_order' => 107,
                    'source' => 'Category\Attribute\Model\Config\Source\ColorOption',
                    'global' => 1,
                    'visible' => true,
                    'required' => true,
                    'user_defined' => false,
                    'default' => null,
                    'group' => 'Customization Tab',
                    'backend' => '',
                ]
            );
            $eavSetup->updateAttribute(\Magento\Catalog\Model\Category::ENTITY, 'category_color', 'position', 101);

            $eavSetup->removeAttribute(\Magento\Catalog\Model\Category::ENTITY, 'category_image');

            $eavSetup->addAttribute(
                \Magento\Catalog\Model\Category::ENTITY,
                'category_image',[
                    'type' => 'varchar',
                    'label' => 'Custom Image',
                    'input' => 'image',
                    'backend' => 'Magento\Catalog\Model\Category\Attribute\Backend\Image',
                    'required' => false,
                    'sort_order' => 5,
                    'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                    'group' => 'Customization Tab',
                ]
            );

            $eavSetup->updateAttribute(\Magento\Catalog\Model\Category::ENTITY, 'category_image', 'position', 101);

            $eavSetup->removeAttribute(\Magento\Catalog\Model\Category::ENTITY, 'category_material');

            $eavSetup->addAttribute(
                \Magento\Catalog\Model\Category::ENTITY,
                'category_material',[
                    'group' => 'Customization Tab',
                    'label' => 'Category Material',
                    'type'  => 'text',
                    'input' => 'multiselect',
                    'source' => 'Category\Attribute\Model\Config\Source\MaterialSelection',
                    'required' => false,
                    'sort_order' => 30,
                    'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                    'used_in_product_listing' => true,
                    // 'backend' => 'Magento\Eav\Model\Entity\Attribute\Backend\ArrayBackend',
                    'visible_on_front' => false
                ]
            );

            /* For Update Attribute */
            $eavSetup->updateAttribute(\Magento\Catalog\Model\Category::ENTITY, 'category_material', 'position', 101);
        }
        $setup->endSetup();
        
    }
}
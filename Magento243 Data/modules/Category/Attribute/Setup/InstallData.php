<?php
namespace Category\Attribute\Setup;

use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
	private $eavSetupFactory;

	public function __construct(EavSetupFactory $eavSetupFactory)
	{
		$this->eavSetupFactory = $eavSetupFactory;
	}
	
	public function install(
		ModuleDataSetupInterface $setup,
		ModuleContextInterface $context
	)
	{
		$eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);

		$eavSetup->addAttribute(
			\Magento\Catalog\Model\Category::ENTITY,
			'custom_attribute',
			[
				'type' => 'text',
                    'label' => 'Category Top',
                    'input' => 'text',
                    'required' => false,
                    'sort_order' => 101,
                    'visible'      => true,
					'required'     => false,
                    'global' =>\Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                    // 'wysiwyg_enabled' => true,
                    // 'is_html_allowed_on_front' => true,
                    'group' => 'General Information',

				
			// ],[
			// 	'type'         => 'varchar',
			// 	'label'        => 'Title ity' ,
			// 	'input'        => 'text',
			// 	'sort_order'   => 100,
			// 	'source'       => '',
			// 	'global'       => 1,
			// 	'visible'      => true,
			// 	'required'     => false,
			// 	'user_defined' => false,
			// 	'default'      => null,
			// 	'group'        => 'General Information',
			// 	'backend'      => '',
                    
                ]
		);    
	}
}
<?php
namespace Attribute\Category\Setup;

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
        if ($context->getVersion() && version_compare($context->getVersion(), '1.0.1') < 0) {


            /* For Remove Attribute */
            $eavSetup->removeAttribute(\Magento\Catalog\Model\Category::ENTITY, 'category_description');
		
		$eavSetup->addAttribute(
			\Magento\Catalog\Model\Category::ENTITY,
			'category_description',
			[
				'type' => 'text',
                'label' => 'Category Description',
                'input' => 'text',
                'required' => false,
                'sort_order' => 101,
                'visible'      => true,
				'required'     => false,
                'global' =>\Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                'group' => 'General Information',
			]
		);    
	}

}
}
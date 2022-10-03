<?php
namespace Label\Product\Ui\DataProvider\Product\Form\Modifier;
use Magento\Catalog\Model\Locator\LocatorInterface;
use Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\AbstractModifier;
use Magento\Ui\Component\Form\Fieldset;
use Magento\Ui\Component\Form\Field;
use Magento\Ui\Component\Form\Element\Input;
use Magento\Framework\Stdlib\ArrayManager;
use Magento\Ui\Component\DynamicRows;
use Magento\Ui\Component\Container;
use Magento\Ui\Component\Form\Element\ActionDelete;
use Magento\Ui\Component\Form\Element\Select;
use Magento\Ui\Component\Form\Element\DataType\Text;
class Highlights extends AbstractModifier
{
    const CODE_PRODUCT_LABEL='product_label_fieldset';
    
    /**
     * @var ArrayManager
     */
    private $arrayManager;
    private $eavConfig;
    private $ingredientOptions;
    private $strengthOptions;

    /**
     * @param ArrayManager $arrayManager
     */
    public function __construct(
        ArrayManager $arrayManager,
        \Magento\Eav\Model\Config $eavConfig
    ) {
        $this->arrayManager = $arrayManager;
        $this->eavConfig = $eavConfig;
    }

    /**
     * @inheritdoc
     * @since 102.0.0
     */
    public function modifyData(array $data)
    {
        return $data;
    }

    /**
     * Add tier price info to meta array.
     *
     * @since 102.0.0
     * @param array $meta
     * @return array
     */
    public function modifyMeta(array $meta)
    {
        $labelPath = $this->arrayManager->findPath(
            self::CODE_PRODUCT_LABEL,
            $meta,
            null,
            'children'
        );
        if ($labelPath) {
            $labelMeta = $this->arrayManager->get($labelPath, $meta);
            $updatedStructure = $this->getUpdatedLabel($labelMeta);
            $meta = $this->arrayManager->remove($labelPath, $meta);
            $meta = $this->arrayManager->merge(
                $this->arrayManager->slicePath($labelPath, 0, -1),
                $meta,
                $updatedStructure
            );
        }
        return $meta;
    }

    /**
     * Get updated tier price structure.
     *
     * @param array $labelMeta
     
     * @return array
     */
    private function getUpdatedLabel(&$labelMeta)
    {
        return [
            self::CODE_PRODUCT_LABEL => [
                'arguments' => [
                    'data' => [
                        'config' => [
                            'componentType' => 'dynamicRows',
                            'label' => __('Product Label'),
                            'renderDefaultRecord' => false,
                            'recordTemplate' => 'record',
                            'dataScope' => '',
                            'dndConfig' => [
                                'enabled' => false,
                            ],
                            'disabled' => false,
                            'addButton' => true,
                            'addButtonLabel' => 'Add New Record',
                            'deleteValue' => true,
                            'sortOrder' => isset($labelMeta['arguments']['data']['config']['sortOrder'])
                                ? $labelMeta['arguments']['data']['config']['sortOrder'] : 100,
                        ],
                    ],
                ],
                'children' => [
                    'record' => [
                        'arguments' => [
                            'data' => [
                                'config' => [
                                    'componentType' => Container::NAME,
                                    'isTemplate' => true,
                                    'is_collection' => true,
                                    'component' => 'Magento_Ui/js/dynamic-rows/record',
                                    'dataScope' => '',
                                ],
                            ],
                        ],
                        'children' => [
                            'position' => [
                                'arguments' => [
                                    'data' => [
                                        'config' => [
                                            'label' => __('Position'),
                                            'componentType' => Field::NAME,
                                            'formElement' => Select::NAME,
                                            'dataScope' =>'position',
                                            'dataType' => Text::NAME,
                                            'selectType' => 'position',
                                            'sortOrder' => 1,
                                            'options' => [
                                                [ 'label' => __(' ') , 'value' => ' ' ],
                                                [ 'label' => __('Upper Left') , 'value' => "upperleft" ],
                                                [ 'label' => __('Upper Right') , 'value' => "upperright" ],
                                                [ 'label' => __('Lower Left') , 'value' => "lowerleft" ],
                                                [ 'label' => __('Lower Rigt') , 'value' => "lowerright" ],
                                            ],
                                            'visible' => true,
                                            'disabled' => false,
                                        ],
                                    ],
                                ],
                            ],
                            'title' => [
                                'arguments' => [
                                    'data' => [
                                        'config' => [
                                            'label' => __('Title'),
                                            'componentType' =>Field::NAME,
                                            'formElement' => Input::NAME,
                                            'dataType' => 'text',
                                            // 'elementTmpl' => 'ui/form/element/text',
                                            'dataScope' => 'title',
                                            'sortOrder' => 2,
                                            'visible' => true,
                                            'disabled' => false,
                                        ],
                                    ],
                                ],
                            ],
                            'actionDelete' => [
                                'arguments' => [
                                    'data' => [
                                        'config' => [
                                            'componentType' => 'actionDelete',
                                            'dataType' => Text::NAME,
                                            'label' => __('Action'),
                                            'additionalClasses'=>'action_delete_button',
                                        ],
                                    ],
                                ],
                            ],
                        ]
                    ],
                ],
            ],
        ];
    }
}
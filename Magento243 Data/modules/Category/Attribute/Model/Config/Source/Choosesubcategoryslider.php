<?php
namespace Category\Attribute\Model\Config\Source;

class Choosesubcategoryslider extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    /**
     * Catalog config
     *
     * @var \Magento\Catalog\Model\Config
     */
    protected $_catalogConfig;

    /**
     * Construct
     *
     * @param \Magento\Catalog\Model\Config $catalogConfig
     */
    public function __construct(\Magento\Catalog\Model\Config $catalogConfig)
    {
        $this->_catalogConfig = $catalogConfig;
    }

    /**
     * Retrieve Catalog Config Singleton
     *
     * @return \Magento\Catalog\Model\Config
     */
    protected function _getCatalogConfig()
    {
        return $this->_catalogConfig;
    }

    /**
     * {@inheritdoc}
     */
    public function getAllOptions()
    {
        if ($this->_options === null) {
            $this->_options = [
                ['label' => __('Label1'), 'value' => 'value1'],
                ['label' => __('Label2'), 'value' => 'value2'],
                ['label' => __('Label3'), 'value' => 'value3'],
                ['label' => __('Label4'), 'value' => 'value4']

            ];

        }
        return $this->_options;
    }
}
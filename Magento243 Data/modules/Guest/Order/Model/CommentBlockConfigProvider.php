<?php

namespace Guest\Order\Model;

use Magento\Checkout\Model\ConfigProviderInterface;
use Magento\Store\Model\ScopeInterface;

class CommentBlockConfigProvider implements ConfigProviderInterface
{
    const checkout_is_guest = 'checkout/options/checkout_is_guest';

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $_scopeConfiguration;

    /**
     * CommentBlockConfigProvider constructor.
     *
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfiguration
     */
    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfiguration
    ) {
        $this->_scopeConfiguration = $scopeConfiguration;
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        /** @var array() $displayConfig */
        $displayConfig = [];

        /** @var boolean $enabled */
        $enabled = $this->_scopeConfiguration->getValue(self::checkout_is_guest, ScopeInterface::SCOPE_STORE);
        $displayConfig['show_is_guest_block'] = ($enabled) ? true : false;
        return $displayConfig;
    }
}

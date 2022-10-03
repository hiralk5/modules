<?php

namespace Rest\CustomApi\Model;

/**
 * Marketplace Product Model.
 *
 * @method \Rest\Marketplace\Model\ResourceModel\Product _getResource()
 * @method \Rest\Marketplace\Model\ResourceModel\Product getResource()
 */
class BillingApi  implements \Rest\CustomApi\Api\Data\BillingApiInterface
{
    /**
     * Get ID.
     *
     * @return int
     */
    public function getId()
    {
        return 10;
    }

    /**
     * Set ID.
     *
     * @param int $id
     *
     * @return \Rest\Marketplace\Api\Data\ProductInterface
     */
    public function setId($id)
    {
    }

    /**
     * Get title.
     *
     * @return string|null
     */
    public function getTitle()
    {
        return 'this is test title';
    }

    /**
     * Set title.
     *
     * @param string $title
     *
     * @return \Rest\Marketplace\Api\Data\ProductInterface
     */
    public function setTitle($title)
    {
    }

    /**
     * Get desc.
     *
     * @return string|null
     */
    public function getDescription()
    {
        return 'this is test api description';
    }

    /**
     * Set Desc.
     *
     * @param string $desc
     *
     * @return \Rest\Marketplace\Api\Data\ProductInterface
     */
    public function setDescription($desc)
    {
    }
}
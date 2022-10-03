<?php

namespace Rest\CustomApi\Api;

interface BillingApiManagementInterface
{
    /**
     * get Billing Api data.
     *
     * @api
     *
     * @param int $id
     *
     * @return \Rest\CustomApi\Api\Data\BillingApiInterface
     */
    public function getApiData($id);
}
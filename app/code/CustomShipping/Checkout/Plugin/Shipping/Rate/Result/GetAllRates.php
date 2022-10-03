<?php

/**
 * Copyright © 2016 MageWorx. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace CustomShipping\Checkout\Plugin\Shipping\Rate\Result;

class GetAllRates
{

    
    public function afterGetAllRates($subject, $result)
    {
        foreach ($result as $key => $rate) {
            if ($rate->getIsDisabled()) {
                unset($result[$key]);
            }
        }

        return $result;
    }
}

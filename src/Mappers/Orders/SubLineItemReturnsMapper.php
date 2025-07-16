<?php

namespace Piggy\Api\Mappers\Orders;

use Piggy\Api\Models\Orders\SubLineItemReturn;
use stdClass;

class SubLineItemReturnsMapper
{
    /**
     * @param  stdClass[]  $data
     * @return SubLineItemReturn[]
     */
    public static function map(array $data): array
    {
        $mapper = new SubLineItemReturnMapper();

        $subLineItemReturns = [];
        foreach ($data as $item) {
            $subLineItemReturns[] = $mapper->map($item);
        }

        return $subLineItemReturns;
    }
}
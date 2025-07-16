<?php

namespace Piggy\Api\Mappers\Orders;

use Piggy\Api\Models\Orders\OrderReturn;
use stdClass;

class OrderReturnsMapper
{
    /**
     * @param  stdClass[]  $data
     * @return OrderReturn[]
     */
    public static function map(array $data): array
    {
        $mapper = new OrderReturnMapper();

        $orderReturns = [];
        foreach ($data as $item) {
            $orderReturns[] = $mapper->map($item);
        }

        return $orderReturns;
    }
}
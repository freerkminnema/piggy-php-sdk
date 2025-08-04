<?php

namespace Piggy\Api\StaticMappers\Orders;

use Piggy\Api\Mappers\Orders\OrderReturnMapper;
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
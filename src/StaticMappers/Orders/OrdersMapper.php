<?php

namespace Piggy\Api\StaticMappers\Orders;

use Piggy\Api\Models\Orders\Order;
use stdClass;

class OrdersMapper
{
    /**
     * @param  stdClass[]  $data
     * @return Order[]
     */
    public static function map(array $data): array
    {
        $mapper = new OrderMapper();

        $orders = [];
        foreach ($data as $item) {
            $orders[] = $mapper->map($item);
        }

        return $orders;
    }
}
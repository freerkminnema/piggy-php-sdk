<?php

namespace Piggy\Api\StaticMappers\Orders;

use Piggy\Api\Models\Orders\SubLineItem;
use stdClass;

class SubLineItemsMapper
{
    /**
     * @param  stdClass[]  $data
     * @return SubLineItem[]
     */
    public static function map(array $data): array
    {
        $mapper = new SubLineItemMapper();

        $subLineItems = [];
        foreach ($data as $item) {
            $subLineItems[] = $mapper->map($item);
        }

        return $subLineItems;
    }
}
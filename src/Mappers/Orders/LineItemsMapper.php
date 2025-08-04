<?php

namespace Piggy\Api\Mappers\Orders;

use Piggy\Api\Models\Orders\LineItem;
use stdClass;

class LineItemsMapper
{
    /**
     * @param  stdClass[]  $data
     * @return LineItem[]
     */
    public static function map(array $data): array
    {
        $mapper = new LineItemMapper();

        $lineItems = [];
        foreach ($data as $item) {
            $lineItems[] = $mapper->map($item);
        }

        return $lineItems;
    }
}
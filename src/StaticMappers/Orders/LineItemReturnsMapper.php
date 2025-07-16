<?php

namespace Piggy\Api\StaticMappers\Orders;

use Piggy\Api\Models\Orders\LineItemReturn;
use stdClass;

class LineItemReturnsMapper
{
    /**
     * @param  stdClass[]  $data
     * @return LineItemReturn[]
     */
    public static function map(array $data): array
    {
        $mapper = new LineItemReturnMapper();

        $lineItemReturns = [];
        foreach ($data as $item) {
            $lineItemReturns[] = $mapper->map($item);
        }

        return $lineItemReturns;
    }
}
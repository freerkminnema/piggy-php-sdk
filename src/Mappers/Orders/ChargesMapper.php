<?php

namespace Piggy\Api\Mappers\Orders;

use Piggy\Api\Models\Orders\LineItem;
use stdClass;

class ChargesMapper
{
    /**
     * @param  stdClass[]  $data
     * @return LineItem[]
     */
    public static function map(array $data): array
    {
        $mapper = new ChargeMapper();

        $charges = [];
        foreach ($data as $item) {
            $charges[] = $mapper->map($item);
        }

        return $charges;
    }
}
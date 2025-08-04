<?php

namespace Piggy\Api\StaticMappers\Orders;

use Piggy\Api\Models\Orders\LineItemReturn;
use stdClass;

class LineItemReturnMapper
{
    public static function map(stdClass $data): LineItemReturn
    {
        return new LineItemReturn(
            $data->uuid,
            $data->quantity,
            $data->line_item
        );
    }
}
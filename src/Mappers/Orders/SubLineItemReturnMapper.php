<?php

namespace Piggy\Api\Mappers\Orders;

use Piggy\Api\Models\Orders\SubLineItemReturn;
use stdClass;

class SubLineItemReturnMapper
{
    public static function map(stdClass $data): SubLineItemReturn
    {
        return new SubLineItemReturn(
            $data->uuid,
            $data->quantity,
            $data->sub_line_item
        );
    }
}
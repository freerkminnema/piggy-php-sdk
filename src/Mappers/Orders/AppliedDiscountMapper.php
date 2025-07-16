<?php

namespace Piggy\Api\Mappers\Orders;

use Piggy\Api\Models\Orders\AppliedDiscount;
use stdClass;

class AppliedDiscountMapper
{
    public static function map(stdClass $data): AppliedDiscount
    {
        return new AppliedDiscount(
            $data->uuid,
            $data->external_identifier,
            $data->name,
            $data->amount,
            $data->type,
            $data->value,
            $data->applied_to,
            $data->line_items,
            $data->sub_line_items
        );
    }
}
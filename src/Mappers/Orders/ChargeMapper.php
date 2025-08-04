<?php

namespace Piggy\Api\Mappers\Orders;

use Piggy\Api\Models\Orders\Charge;
use stdClass;

class ChargeMapper
{
    public static function map(stdClass $data): Charge
    {
        return new Charge(
            $data->uuid,
            $data->external_identifier,
            $data->type,
            $data->name,
            $data->amount,
            $data->discount_amount,
            $data->total_amount
        );
    }
}
<?php

namespace Piggy\Api\Mappers\Orders;

use Piggy\Api\Mappers\Products\ProductMapper;
use Piggy\Api\Models\Orders\SubLineItem;
use stdClass;

class SubLineItemMapper
{
    public static function map(stdClass $data): SubLineItem
    {
        $lineItem = null;
        if (isset($data->line_item)) {
            $mapper = new LineItemMapper();
            $lineItem = $mapper->map($data->line_item);
        }

        $product = null;
        if (isset($data->product)) {
            $mapper = new ProductMapper();
            $product = $mapper->map($data->product);
        }

        return new SubLineItem(
            $data->uuid,
            $data->external_identifier,
            $data->name,
            $data->quantity,
            $data->price,
            $data->discount_amount,
            $data->total_amount,
            $lineItem,
            $product
        );
    }
}
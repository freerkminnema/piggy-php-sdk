<?php

namespace Piggy\Api\StaticMappers\Orders;

use Piggy\Api\Models\Orders\SubLineItem;
use Piggy\Api\StaticMappers\Products\ProductMapper;
use stdClass;

class SubLineItemMapper
{
    public static function map(stdClass $data): SubLineItem
    {
        $lineItem = null;
        if (isset($data->line_item)) {
            $lineItem = LineItemMapper::map($data->line_item);
        }

        $product = null;
        if (isset($data->product)) {
            $product = ProductMapper::map($data->product);
        }

        return new SubLineItem(
            $data->uuid,
            $data->external_identifier,
            $data->name,
            $data->quantity,
            $data->price,
            $data->discount_amount,
            $data->total_amount,
            $data->created_at,
            $data->updated_at,
            $lineItem,
            $product
        );
    }
}
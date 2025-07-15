<?php

namespace Piggy\Api\StaticMappers\Orders;

use Piggy\Api\Models\Orders\LineItem;
use Piggy\Api\StaticMappers\Products\ProductMapper;
use stdClass;

class LineItemMapper
{
    public static function map(stdClass $data): LineItem
    {
        $product = null;
        if (isset($data->product)) {
            $product = ProductMapper::map($data->product);
        }

        return new LineItem(
            $data->uuid,
            $data->external_identifier,
            $data->name,
            $data->quantity,
            $data->price,
            $data->discount_amount,
            $data->total_amount,
            $data->created_at ?? '',
            $data->updated_at ?? '',
            $product,
            $data->sub_line_items
        );
    }
}
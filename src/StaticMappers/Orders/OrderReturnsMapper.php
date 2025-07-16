<?php

namespace Piggy\Api\StaticMappers\Orders;

use Piggy\Api\Models\Orders\LineItem;
use Piggy\Api\StaticMappers\Products\ProductMapper;
use stdClass;

class OrderReturnsMapper
{
    public static function map(stdClass $data): LineItem
    {
        $product = null;
        if (isset($data->product)) {
            $product = ProductMapper::map($data->product);
        }

        $subLineItems = null;
        if (isset($data->sub_line_items)) {
            $subLineItems = SubLineItemsMapper::map($data->sub_line_items);
        }

        return new LineItem(
            $data->uuid,
            $data->external_identifier,
            $data->name,
            $data->quantity,
            $data->price,
            $data->discount_amount,
            $data->total_amount,
            $product,
            $subLineItems
        );
    }
}
<?php

namespace Piggy\Api\Mappers\Orders;

use Piggy\Api\Mappers\Products\ProductMapper;
use Piggy\Api\Models\Orders\LineItem;
use stdClass;

class LineItemMapper
{
    public static function map(stdClass $data): LineItem
    {
        $product = null;
        if (isset($data->product)) {
            $mapper = new ProductMapper();
            $product = $mapper->map($data->product);
        }

        $subLineItems = [];
        if (isset($data->sub_line_items)) {
            $mapper = new SubLineItemsMapper();
            $subLineItems = $mapper->map($data->sub_line_items);
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
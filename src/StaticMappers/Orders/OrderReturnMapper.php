<?php

namespace Piggy\Api\StaticMappers\Orders;

use Piggy\Api\Models\Orders\OrderReturn;
use stdClass;

class OrderReturnMapper
{
    public static function map(stdClass $data): OrderReturn
    {
        $lineItemReturns = [];
        if (isset($data->line_item_returns)) {
            $lineItemReturns = SubLineItemReturnsMapper::map($data->line_item_returns);
        }

        $subLineItemReturns = [];
        if (isset($data->sub_line_item_returns)) {
            $subLineItemReturns = SubLineItemReturnsMapper::map($data->sub_line_item_returns);
        }

        return new OrderReturn(
            $data->uuid,
            $data->status,
            $data->order,
            $lineItemReturns,
            $subLineItemReturns
        );
    }
}
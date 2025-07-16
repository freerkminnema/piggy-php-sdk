<?php

namespace Piggy\Api\StaticMappers\Orders;

use Piggy\Api\Models\Orders\Order;
use Piggy\Api\StaticMappers\Contacts\ContactMapper;
use Piggy\Api\StaticMappers\Shops\ShopMapper;
use stdClass;

class OrderMapper
{
    public static function map(stdClass $data): Order
    {
        $contact = null;
        if (isset($data->contact)) {
            $contact = ContactMapper::map($data->contact);
        }

        $shop = null;
        if (isset($data->business_profile)) {
            $shop = ShopMapper::map($data->business_profile);
        }

        $lineItems = [];
        if (isset($data->line_items)) {
            $lineItems = LineItemsMapper::map($data->line_items);
        }

        return new Order(
            $data->uuid,
            $data->external_identifier,
            $data->currency,
            $data->reference ?? null,
            $data->status,
            $data->payment_status,
            $data->formatted_total_order_amount,
            isset($data->order_amount) ? (int) $data->order_amount : null,
            (int) $data->total_charges_amount,
            (int) $data->total_discount_amount,
            (int) $data->total_order_amount,
            $data->paid_at ?? null,
            $data->created_at ?? '',
            $data->updated_at ?? '',
            $contact,
            $shop,
            $lineItems,
            $data->applied_discounts,
            $data->charges
        );
    }
}
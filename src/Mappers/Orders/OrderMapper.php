<?php

namespace Piggy\Api\Mappers\Orders;

use Piggy\Api\Mappers\Contacts\ContactMapper;
use Piggy\Api\Mappers\Shops\ShopMapper;
use Piggy\Api\Models\Orders\Order;
use stdClass;

class OrderMapper
{
    public function map(stdClass $data): Order
    {
        $contact = null;
        if (isset($data->contact)) {
            $mapper = new ContactMapper();
            $contact = $mapper->map($data->contact);
        }

        $shop = null;
        if (isset($data->business_profile)) {
            $mapper = new ShopMapper();
            $shop = $mapper->map($data->business_profile);
        }

        $lineItems = [];
        if (isset($data->line_items)) {
            $mapper = new LineItemMapper();
            $lineItems = $mapper->map($data->line_items);
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
            $data->created_at,
            $data->updated_at,
            $contact,
            $shop,
            $lineItems,
            $data->applied_discounts,
            $data->charges
        );
    }
}
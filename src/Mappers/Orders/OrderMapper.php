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
            $mapper = new LineItemsMapper();
            $lineItems = $mapper->map($data->line_items);
        }

        $appliedDiscounts = [];
        if (isset($data->applied_discounts)) {
            $mapper = new AppliedDiscountsMapper();
            $appliedDiscounts = $mapper->map($data->applied_discounts);
        }

        $charges = [];
        if (isset($data->charges)) {
            $mapper = new ChargesMapper();
            $charges = $mapper->map($data->charges);
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
            $data->completed_at ?? null,
            $data->created_at,
            $data->updated_at,
            $contact,
            $shop,
            $lineItems,
            $appliedDiscounts, // $data->applied_discounts,
            $charges // $data->charges
        );
    }
}
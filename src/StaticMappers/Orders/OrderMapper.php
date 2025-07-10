<?php

namespace Piggy\Api\StaticMappers\Orders;

use Piggy\Api\Models\Orders\Order;
use Piggy\Api\StaticMappers\Contacts\ContactMapper;
use stdClass;

class OrderMapper
{
    public static function map(stdClass $data): Order
    {
        $contact = null;
        if (isset($data->contact)) {
            $contact = ContactMapper::map($data->contact);
        }

        return new Order(
            $data->uuid,
            $data->external_identifier,
            $contact
        );
    }
}
<?php

namespace Piggy\Api\Mappers\Products;

use Piggy\Api\Models\Products\Product;
use stdClass;

class ProductMapper
{
    public function map(stdClass $data): Product
    {
        return new Product(
            $data->uuid,
            $data->externalIdentifier,
            $data->name,
            $data->description,
            $data->categories
        );
    }
}

<?php

namespace Piggy\Api\Mappers\Products;

use Piggy\Api\Mappers\Categories\CategoriesMapper;
use Piggy\Api\Models\Products\Product;
use stdClass;

class ProductMapper
{
    public function map(stdClass $data): Product
    {
        $categories = null;
        if (isset($data->categories)) {
            $mapper = new CategoriesMapper();
            $categories = $mapper->map($data->categories);
        }

        return new Product(
            $data->uuid,
            $data->external_identifier,
            $data->name,
            $data->description,
            $categories
        );
    }
}

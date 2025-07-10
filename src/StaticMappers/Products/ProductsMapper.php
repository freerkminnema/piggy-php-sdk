<?php

namespace Piggy\Api\StaticMappers\Products;

use Piggy\Api\Models\Products\Product;
use stdClass;

class ProductsMapper
{
    /**
     * @param  stdClass[]  $data
     * @return Product[]
     */
    public static function map(array $data): array
    {
        $mapper = new ProductMapper();

        $products = [];
        foreach ($data as $item) {
            $products[] = $mapper->map($item);
        }

        return $products;
    }
}

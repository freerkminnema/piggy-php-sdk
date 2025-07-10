<?php

namespace Piggy\Api\Mappers\Products;

use Piggy\Api\Models\Products\Product;
use stdClass;

class ProductsMapper
{
    /**
     * @param  stdClass[]  $data
     * @return Product[]
     */
    public function map(array $data): array
    {
        $mapper = new ProductMapper();

        $products = [];
        foreach ($data as $item) {
            $products[] = $mapper->map($item);
        }

        return $products;
    }
}

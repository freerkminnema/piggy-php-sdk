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

        $perks = [];
        foreach ($data as $item) {
            $perks[] = $mapper->map($item);
        }

        return $perks;
    }
}

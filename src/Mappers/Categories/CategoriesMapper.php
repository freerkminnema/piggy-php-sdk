<?php

namespace Piggy\Api\Mappers\Categories;

use Piggy\Api\Models\Categories\Category;
use stdClass;

class CategoriesMapper
{
    /**
     * @param  stdClass[]  $data
     * @return Category[]
     */
    public function map(array $data): array
    {
        $mapper = new CategoryMapper();

        $categories = [];
        foreach ($data as $item) {
            $categories[] = $mapper->map($item);
        }

        return $categories;
    }
}

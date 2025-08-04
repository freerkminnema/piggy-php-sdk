<?php

namespace Piggy\Api\StaticMappers\Categories;

use Piggy\Api\Models\Categories\Category;
use stdClass;

class CategoriesMapper
{
    /**
     * @param  stdClass[]  $data
     * @return Category[]
     */
    public static function map(array $data): array
    {
        $mapper = new CategoryMapper();

        $categories = [];
        foreach ($data as $item) {
            $categories[] = $mapper->map($item);
        }

        return $categories;
    }
}
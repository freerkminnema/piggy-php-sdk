<?php

namespace Piggy\Api\Mappers\Orders;

use Piggy\Api\Models\Orders\AppliedDiscount;
use stdClass;

class AppliedDiscountsMapper
{
    /**
     * @param  stdClass[]  $data
     * @return AppliedDiscount[]
     */
    public static function map(array $data): array
    {
        $mapper = new AppliedDiscountMapper();

        $appliedDiscounts = [];
        foreach ($data as $item) {
            $appliedDiscounts[] = $mapper->map($item);
        }

        return $appliedDiscounts;
    }
}
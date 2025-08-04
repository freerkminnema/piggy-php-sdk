<?php

namespace Piggy\Api\Mappers\Tiers;

use Piggy\Api\Models\Tiers\Tier;
use stdClass;

class TierMapper
{
    public function map(stdClass $data): ?Tier
    {
        if (!$data->name) {
            return null;
        }

        return new Tier(
            $data->name,
            $data->position ?? 0,
            $data->uuid ?? null,
            $data->description ?? null,
            $data->media ? get_object_vars($data->media) : null
        );
    }
}

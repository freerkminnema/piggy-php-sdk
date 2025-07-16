<?php

namespace Piggy\Api\Models\Orders;

class SubLineItemReturn
{
    /**
     * @var string
     */
    protected $uuid;

    /**
     * @var int
     */
    protected $quantity;

    /**
     * @var array
     */
    protected $subLineItem = [];

    public function __construct(
        string $uuid,
        int $quantity,
        array $subLineItem = []
    )
    {
        $this->uuid = $uuid;
        $this->quantity = $quantity;
        $this->subLineItem = $subLineItem;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getSubLineItem(): array
    {
        return $this->subLineItem;
    }
}
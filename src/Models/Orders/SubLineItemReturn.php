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
     * @var array<string, mixed>
     */
    protected $subLineItem = [];

    /**
     * @param array<string, mixed> $subLineItem
     */
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

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @return array<string, mixed>
     */
    public function getSubLineItem(): array
    {
        return $this->subLineItem;
    }
}
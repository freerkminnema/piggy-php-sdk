<?php

namespace Piggy\Api\Models\Orders;

class LineItemReturn
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
    protected $lineItem = [];

    public function __construct(
        string $uuid,
        int $quantity,
        array $lineItem = []
    )
    {
        $this->uuid = $uuid;
        $this->quantity = $quantity;
        $this->lineItem = $lineItem;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getLineItem(): array
    {
        return $this->lineItem;
    }
}
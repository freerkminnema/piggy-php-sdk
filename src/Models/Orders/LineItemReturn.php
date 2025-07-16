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
     * @var array<string, mixed>
     */
    protected $lineItem = [];

    /**
     * @param array<string, mixed> $lineItem
     */
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
    public function getLineItem(): array
    {
        return $this->lineItem;
    }
}
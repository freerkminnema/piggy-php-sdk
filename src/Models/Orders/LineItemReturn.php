<?php

namespace Piggy\Api\Models\Orders;

use stdClass;

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
     * @var stdClass
     */
    protected $lineItem;

    public function __construct(
        string $uuid,
        int $quantity,
        stdClass $lineItem
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
     * @return stdClass
     */
    public function getLineItem(): stdClass
    {
        return $this->lineItem;
    }
}
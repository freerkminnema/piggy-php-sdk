<?php

namespace Piggy\Api\Models\Orders;

use stdClass;

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
     * @var stdClass
     */
    protected $subLineItem;

    public function __construct(
        string $uuid,
        int $quantity,
        stdClass $subLineItem
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
     * @return stdClass
     */
    public function getSubLineItem(): stdClass
    {
        return $this->subLineItem;
    }
}
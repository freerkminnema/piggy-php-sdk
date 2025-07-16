<?php

namespace Piggy\Api\Models\Orders;

use Piggy\Api\Models\Products\Product;

class SubLineItem
{
    /**
     * @var string
     */
    protected $uuid;

    /**
     * @var string|null
     */
    protected $externalIdentifier;

    /**
     * @var string|null
     */
    protected $name;

    /**
     * @var int
     */
    protected $quantity;

    /**
     * @var string
     */
    protected $price;

    /**
     * @var int|null
     */
    protected $discountAmount;

    /**
     * @var int
     */
    protected $totalAmount;

    /**
     * @var LineItem|null
     */
    protected $lineItem;

    /**
     * @var Product|null
     */
    protected $product;

    public function __construct(
        string $uuid,
        ?string $externalIdentifier,
        ?string $name,
        int $quantity,
        string $price,
        ?int $discountAmount,
        int $totalAmount,
        ?LineItem $lineItem,
        ?Product $product
    ) {
        $this->uuid = $uuid;
        $this->externalIdentifier = $externalIdentifier;
        $this->name = $name;
        $this->quantity = $quantity;
        $this->price = $price;
        $this->discountAmount = $discountAmount;
        $this->totalAmount = $totalAmount;
        $this->lineItem = $lineItem;
        $this->product = $product;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getExternalIdentifier(): ?string
    {
        return $this->externalIdentifier;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getPrice(): string
    {
        return $this->price;
    }

    public function getDiscountAmount(): ?int
    {
        return $this->discountAmount;
    }

    public function getTotalAmount(): int
    {
        return $this->totalAmount;
    }
    
    public function getLineItem(): ?LineItem
    {
        return $this->lineItem;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }
}
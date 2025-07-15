<?php

namespace Piggy\Api\Models\Orders;

use Piggy\Api\Models\Products\Product;

class SubLineItem
{
    /**
     * @var string $uuid
     */
    protected $uuid;

    /**
     * @var string|null $externalIdentifier
     */
    protected $externalIdentifier;

    /**
     * @var string|null $name
     */
    protected $name;

    /**
     * @var int $quantity
     */
    protected $quantity;

    /**
     * @var string $price
     */
    protected $price;

    /**
     * @var int|null $discountAmount
     */
    protected $discountAmount;

    /**
     * @var int $totalAmount
     */
    protected $totalAmount;

    /**
     * @var string $createdAt
     */
    protected $createdAt;

    /**
     * @var string $updatedAt
     */
    protected $updatedAt;

    /**
     * @var LineItem $lineItem
     */
    protected $lineItem;

    /**
     * @var Product|null $product
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
        string $createdAt,
        string $updatedAt,
        LineItem $lineItem,
        ?Product $product
    ) {
        $this->uuid = $uuid;
        $this->externalIdentifier = $externalIdentifier;
        $this->name = $name;
        $this->quantity = $quantity;
        $this->price = $price;
        $this->discountAmount = $discountAmount;
        $this->totalAmount = $totalAmount;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
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

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    public function getLineItem(): LineItem
    {
        return $this->lineItem;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }
}
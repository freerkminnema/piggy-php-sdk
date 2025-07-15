<?php

namespace Piggy\Api\Models\Orders;

use Piggy\Api\Models\Products\Product;

class LineItem
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
     * @var string
     */
    protected $createdAt;

    /**
     * @var string
     */
    protected $updatedAt;

    /**
     * @var Product|null
     */
    protected $product;

    /**
     * @var SubLineItem[]
     */
    protected $subLineItems;

    /** @param SubLineItem[] $subLineItems */
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
        ?Product $product,
        array $subLineItems
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
        $this->product = $product;
        $this->subLineItems = $subLineItems;
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

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    /**
     * @return array|SubLineItem[]
     */
    public function getSubLineItems(): array
    {
        return $this->subLineItems;
    }
}
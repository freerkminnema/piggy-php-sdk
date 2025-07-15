<?php

namespace Piggy\Api\Models\Orders;

class Charge
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
     * @var string
     */
    protected $type;

    /**
     * @var string|null
     */
    protected $name;

    /**
     * @var int
     */
    protected $amount;

    /**
     * @var int|null
     */
    protected $discountAmount;

    /**
     * @var int
     */
    protected $totalAmount;

    public function __construct(
        string $uuid,
        ?string $externalIdentifier,
        string $type,
        ?string $name,
        int $amount,
        ?int $discountAmount,
        int $totalAmount
    ) {
        $this->uuid = $uuid;
        $this->externalIdentifier = $externalIdentifier;
        $this->type = $type;
        $this->name = $name;
        $this->amount = $amount;
        $this->discountAmount = $discountAmount;
        $this->totalAmount = $totalAmount;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getExternalIdentifier(): ?string
    {
        return $this->externalIdentifier;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getDiscountAmount(): ?int
    {
        return $this->discountAmount;
    }

    public function getTotalAmount(): int
    {
        return $this->totalAmount;
    }
}
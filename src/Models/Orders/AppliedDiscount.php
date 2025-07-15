<?php

namespace Piggy\Api\Models\Orders;

class AppliedDiscount
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
    protected $amount;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $value;

    /**
     * @var string
     */
    protected $appliedTo;

    /**
     * @var array<string, string>
     */
    protected $lineItems;

    /**
     * @var array<string, string>
     */
    protected $subLineItems;

    /**
     * @param LineItem[] $lineItems
     * @param SubLineItem[] $subLineItems
     */
    public function __construct(
        string $uuid,
        ?string $externalIdentifier,
        ?string $name,
        int $amount,
        string $type,
        string $value,
        string $appliedTo,
        array $lineItems,
        array $subLineItems
    ) {
        $this->uuid = $uuid;
        $this->externalIdentifier = $externalIdentifier;
        $this->name = $name;
        $this->amount = $amount;
        $this->type = $type;
        $this->value = $value;
        $this->appliedTo = $appliedTo;
        $this->lineItems = $lineItems;
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

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getAppliedTo(): string
    {
        return $this->appliedTo;
    }

    /**
     * @return array<string, string>
     */
    public function getLineItems(): array
    {
        return $this->lineItems;
    }

    /**
     * @return array<string, string>
     */
    public function getSubLineItems(): array
    {
        return $this->subLineItems;
    }
}
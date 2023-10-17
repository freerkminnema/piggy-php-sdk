<?php

namespace Piggy\Api\Models\Vouchers;

class Promotion
{
    public $uuid;
    public $name;
    public $description;
    public $voucher_limit;
    public $limit_per_contact;
    public $expiration_duration;

    public function __construct(
        string $uuid,
        string $name,
        string $description,
        ?int $voucher_limit = null,
        ?int $limit_per_contact = null,
        ?int $expiration_duration = null
    )
    {
        $this->uuid = $uuid;
        $this->name = $name;
        $this->description = $description;
        $this->voucher_limit = $voucher_limit;
        $this->limit_per_contact = $limit_per_contact;
        $this->expiration_duration = $expiration_duration;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getVoucherLimit(): int
    {
        return $this->voucher_limit;
    }

    public function setVoucherLimit(int $voucher_limit): void
    {
        $this->voucher_limit = $voucher_limit;
    }

    public function getLimitPerContact(): ?int
    {
        return $this->limit_per_contact;
    }

    public function setLimitPerContact(?int $limit_per_contact): void
    {
        $this->limit_per_contact = $limit_per_contact;
    }

    public function getExpirationDuration(): ?int
    {
        return $this->expiration_duration;
    }

    public function setExpirationDuration(?int $expiration_duration): void
    {
        $this->expiration_duration = $expiration_duration;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): void
    {
        $this->uuid = $uuid;
    }
}


<?php

namespace Piggy\Api\Models\ContactAttributes;

use Piggy\Api\Models\Loyalty\CreditBalance;

/**
 * Class ContactAttribute
 * @package Piggy\Api\Models
 */
class ContactAttribute
{

    /** @var string */
    public $name;

    /**
     * @var string|null
     */
    public $label;

    /**
     * @var string|null
     */
    public $description;

    /**
     * @var string
     */
    public $type;

    /**
     * @var boolean|null
     */
    public $isSoftReadOnly;

    /**
     * @var boolean|null
     */
    public $isHardReadOnly;

    /**
     * @var boolean
     */
    public $isPiggyDefined;

    /**
     * @var Options|null
     */
    public $options;

    public function __construct(string $name, ?string $label, ?string $description, string $type, bool $isSoftReadOnly, bool $isHardReadOnly, bool $isPiggyDefined, ?Options $options)
    {
        $this->name = $name;
        $this->label = $label;
        $this->description = $description;
        $this->type = $type;
        $this->isSoftReadOnly = $isSoftReadOnly;
        $this->isHardReadOnly = $isHardReadOnly;
        $this->isPiggyDefined = $isPiggyDefined;
        $this->options = $options;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return void
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $label
     * @return void
     */
    public function setLabel(string $label): void
    {
        $this->label = $label;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return void
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return void
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return bool
     */
    public function getIsSoftReadOnly(): bool
    {
        return $this->isSoftReadOnly;
    }

    /**
     * @param bool $isSoftReadOnly
     * @return void
     */
    public function setIsSoftReadOnly(bool $isSoftReadOnly): void
    {
        $this->isSoftReadOnly = $isSoftReadOnly;
    }

    /**
     * @return bool
     */
    public function getIsHardReadOnly(): bool
    {
        return $this->isHardReadOnly;
    }

    /**
     * @param bool $isHardReadOnly
     * @return void
     */
    public function setIsHardReadOnly(bool $isHardReadOnly): void
    {
        $this->isHardReadOnly = $isHardReadOnly;
    }

    /**
     * @return bool
     */
    public function getIsPiggyDefined(): bool
    {
        return $this->isPiggyDefined;
    }

    /**
     * @param bool $isPiggyDefined
     */
    public function setIsPiggyDefined(bool $isPiggyDefined): void
    {
        $this->isPiggyDefined = $isPiggyDefined;
    }

    /**
     * @return Options
     */
    public function getOptions(): ?Options
    {
        return $this->options;
    }

    /**
     * @param Options|null $options
     */
    public function setOptions(?Options $options): void
    {
        $this->options = $options;
    }



}
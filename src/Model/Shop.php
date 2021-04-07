<?php


namespace Piggy\Api\Model;

/**
 * Class Shop
 * @package Piggy\Api\Model
 */
class Shop
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    //
    // Add Loyalty Program
    //

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
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
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }
}
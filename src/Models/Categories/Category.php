<?php

namespace Piggy\Api\Models\Categories;

class Category
{
    /**
     * @var string
     */
    protected $uuid;

    /**
     * @var string
     */
    protected $externalIdentifier;

    /**
     * @var string
     */
    protected $name;

    /*** @var string
     */
    const resourceUri = '/api/v3/oauth/clients/categories';

    public function __construct(
        string $uuid,
        string $externalIdentifier,
        string $name
    ) {
        $this->uuid = $uuid;
        $this->externalIdentifier = $externalIdentifier;
        $this->name = $name;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getExternalIdentifier(): string
    {
        return $this->externalIdentifier;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
<?php

namespace Piggy\Api\Models\Products;

use GuzzleHttp\Exception\GuzzleException;
use Piggy\Api\ApiClient;
use Piggy\Api\Exceptions\MaintenanceModeException;
use Piggy\Api\Exceptions\PiggyRequestException;
use Piggy\Api\Http\Responses\Response;
use Piggy\Api\Mappers\Products\ProductMapper;
use Piggy\Api\Mappers\Products\ProductsMapper;
use Piggy\Api\Models\Categories\Category;
use Piggy\Api\Models\Contacts\Subscription;

class Product
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

    /**
     * @var string|null
     */
    protected $description;

    /**
     * @var ?Category[]
     */
    protected $categories;

    /**
     * @var string
     */
    const resourceUri = '/api/v3/oauth/clients/products';

    public function __construct(
        string $uuid,
        string $externalIdentifier,
        string $name,
        ?string $description,
        ?array $categories
    ) {
        $this->uuid = $uuid;
        $this->externalIdentifier = $externalIdentifier;
        $this->name = $name;
        $this->description = $description;
        $this->categories = $categories;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @return ?Category[]
     */
    public function getCategories(): ?array
    {
        return $this->categories;
    }
}

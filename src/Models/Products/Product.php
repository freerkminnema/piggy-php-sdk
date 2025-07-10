<?php

namespace Piggy\Api\Models\Products;

use GuzzleHttp\Exception\GuzzleException;
use Piggy\Api\ApiClient;
use Piggy\Api\Exceptions\MaintenanceModeException;
use Piggy\Api\Exceptions\PiggyRequestException;
use Piggy\Api\Http\Responses\Response;
use Piggy\Api\StaticMappers\Products\ProductMapper;
use Piggy\Api\StaticMappers\Products\ProductsMapper;
use Piggy\Api\Models\Categories\Category;

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

    /**
     * @throws GuzzleException
     * @throws MaintenanceModeException
     * @throws PiggyRequestException
     */
    public function list(array $params = []): array
    {
        $response = ApiClient::get(self::resourceUri, $params);

        return ProductsMapper::map($response->getData());
    }

    /**
     * @throws GuzzleException
     * @throws MaintenanceModeException
     * @throws PiggyRequestException
     */
    public function create(string $externalIdentifier, string $name, ?string $description, ?array $categories): Product
    {
        $response = ApiClient::post(self::resourceUri, [
            'external_identifier' => $externalIdentifier,
            'name' => $name,
            'description' => $description,
            'categories' => $categories,
        ]);

        return ProductMapper::map($response->getData());
    }

    /**
     * @throws GuzzleException
     * @throws MaintenanceModeException
     * @throws PiggyRequestException
     */
    public function get(string $uuid, array $params = []): Product
    {
        $response = ApiClient::get(self::resourceUri."/$uuid", $params);

        return ProductMapper::map($response->getData());
    }

    /**
     * @throws GuzzleException
     * @throws MaintenanceModeException
     * @throws PiggyRequestException
     */
    public function find(string $externalIdentifier): Product
    {
        $response = ApiClient::get(self::resourceUri."/find", [
            'external_identifier' => $externalIdentifier,
        ]);

        return ProductMapper::map($response->getData());
    }

    /**
     * @throws GuzzleException
     * @throws MaintenanceModeException
     * @throws PiggyRequestException
     */
    public function findOrCreate(string $externalIdentifier, ?string $name, ?string $description, ?array $categories): Product
    {
        $response = ApiClient::post(self::resourceUri."/find-or-create", [
            'external_identifier' => $externalIdentifier,
            'name' => $name,
            'description' => $description,
            'categories' => $categories,
        ]);

        return ProductMapper::map($response->getData());
    }

    /**
     * @throws GuzzleException
     * @throws MaintenanceModeException
     * @throws PiggyRequestException
     */
    public function update(string $uuid, ?string $externalIdentifier, ?string $name, ?string $description, ?array $categories): Product
    {
        $response = ApiClient::put(self::resourceUri."/$uuid", [
            'external_identifier' => $externalIdentifier,
            'name' => $name,
            'description' => $description,
            'categories' => $categories,
        ]);

        return ProductMapper::map($response->getData());
    }

    /**
     * @throws GuzzleException
     * @throws MaintenanceModeException
     * @throws PiggyRequestException
     */
    public function delete(string $uuid, array $params = []): Response
    {
        return ApiClient::delete(self::resourceUri."/$uuid", $params);
    }

    /**
     * @throws GuzzleException
     * @throws MaintenanceModeException
     * @throws PiggyRequestException
     */
    public function batch(array $products)
    {
        $response = ApiClient::put(self::resourceUri."/batch", [
            'products' => $products,
        ]);

        return $response->getData();
    }
}

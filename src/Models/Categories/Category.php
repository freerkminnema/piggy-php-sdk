<?php

namespace Piggy\Api\Models\Categories;

use GuzzleHttp\Exception\GuzzleException;
use Piggy\Api\ApiClient;
use Piggy\Api\Exceptions\MaintenanceModeException;
use Piggy\Api\Exceptions\PiggyRequestException;
use Piggy\Api\Http\Responses\Response;
use Piggy\Api\StaticMappers\Categories\CategoryMapper;
use Piggy\Api\StaticMappers\Categories\CategoriesMapper;

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

    /**
     * @throws GuzzleException
     * @throws MaintenanceModeException
     * @throws PiggyRequestException
     */
    public function list(array $params = []): array
    {
        $response = ApiClient::get(self::resourceUri, $params);

        return CategoriesMapper::map($response->getData());
    }

    /**
     * @throws GuzzleException
     * @throws MaintenanceModeException
     * @throws PiggyRequestException
     */
    public function create(string $externalIdentifier, string $name): Category
    {
        $response = ApiClient::post(self::resourceUri, [
            'external_identifier' => $externalIdentifier,
            'name' => $name,
        ]);

        return CategoryMapper::map($response->getData());
    }

    /**
     * @throws GuzzleException
     * @throws MaintenanceModeException
     * @throws PiggyRequestException
     */
    public function get(string $uuid, array $params = []): Category
    {
        $response = ApiClient::get(self::resourceUri."/$uuid", $params);

        return CategoryMapper::map($response->getData());
    }

    /**
     * @throws GuzzleException
     * @throws MaintenanceModeException
     * @throws PiggyRequestException
     */
    public function find(string $externalIdentifier): Category
    {
        $response = ApiClient::get(self::resourceUri."/find", [
            'external_identifier' => $externalIdentifier,
        ]);

        return CategoryMapper::map($response->getData());
    }

    /**
     * @throws GuzzleException
     * @throws MaintenanceModeException
     * @throws PiggyRequestException
     */
    public function findOrCreate(string $externalIdentifier, ?string $name): Category
    {
        $response = ApiClient::post(self::resourceUri."/find-or-create", [
            'external_identifier' => $externalIdentifier,
            'name' => $name,
        ]);

        return CategoryMapper::map($response->getData());
    }

    /**
     * @throws GuzzleException
     * @throws MaintenanceModeException
     * @throws PiggyRequestException
     */
    public function update(string $uuid, ?string $externalIdentifier, ?string $name): Category
    {
        $response = ApiClient::put(self::resourceUri."/$uuid", [
            'external_identifier' => $externalIdentifier,
            'name' => $name,
        ]);

        return CategoryMapper::map($response->getData());
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
    public function batch(array $categories)
    {
        $response = ApiClient::put(self::resourceUri."/batch", [
            'categories' => $categories,
        ]);

        return $response->getData();
    }
}
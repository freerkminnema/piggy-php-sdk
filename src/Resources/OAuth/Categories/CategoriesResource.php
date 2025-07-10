<?php

namespace Piggy\Api\Resources\OAuth\Categories;

use Piggy\Api\Exceptions\PiggyRequestException;
use Piggy\Api\Mappers\Categories\CategoryMapper;
use Piggy\Api\Mappers\Categories\CategoriesMapper;
use Piggy\Api\Models\Categories\Category;
use Piggy\Api\Resources\BaseResource;

class CategoriesResource extends BaseResource
{
    /**
     * @var string
     */
    protected $resourceUri = '/api/v3/oauth/clients/categories';

    /**
     * @throws PiggyRequestException
     */
    public function list(array $params = []): array
    {
        $response = $this->client->get($this->resourceUri, $params);

        $mapper = new CategoriesMapper();

        return $mapper->map((array) $response->getData());
    }

    /**
     * @throws PiggyRequestException
     */
    public function create(string $externalIdentifier, string $name): Category
    {
        $response = $this->client->post($this->resourceUri, [
            'external_identifier' => $externalIdentifier,
            'name' => $name,
        ]);

        $mapper = new CategoryMapper();

        return $mapper->map($response->getData());
    }

    /**
     * @throws PiggyRequestException
     */
    public function get(string $uuid, array $params = []): Category
    {
        $response = $this->client->get("$this->resourceUri/$uuid", $params);

        $mapper = new CategoryMapper();

        return $mapper->map($response->getData());
    }

    /**
     * @throws PiggyRequestException
     */
    public function find(string $externalIdentifier): Category
    {
        $response = $this->client->get("$this->resourceUri/find", [
            'external_identifier' => $externalIdentifier,
        ]);

        $mapper = new CategoryMapper();

        return $mapper->map($response->getData());
    }

    /**
     * @throws PiggyRequestException
     */
    public function findOrCreate(string $externalIdentifier, ?string $name): Category
    {
        $response = $this->client->post("$this->resourceUri/find-or-create", [
            'external_identifier' => $externalIdentifier,
            'name' => $name,
        ]);

        $mapper = new CategoryMapper();

        return $mapper->map($response->getData());
    }

    /**
     * @throws PiggyRequestException
     */
    public function update(string $uuid, ?string $externalIdentifier, ?string $name): Category
    {
        $response = $this->client->put("$this->resourceUri/$uuid", [
            'external_identifier' => $externalIdentifier,
            'name' => $name,
        ]);

        $mapper = new CategoryMapper();

        return $mapper->map($response->getData());
    }

    /**
     * @throws PiggyRequestException
     */
    public function delete(string $uuid, array $params = [])
    {
        $response = $this->client->destroy("$this->resourceUri/$uuid", $params);

        return $response->getData();
    }

    /**
     * @throws PiggyRequestException
     */
    public function batch(array $categories)
    {
        $response = $this->client->put("$this->resourceUri/batch", [
            'categories' => $categories,
        ]);

        return $response->getData();
    }
}
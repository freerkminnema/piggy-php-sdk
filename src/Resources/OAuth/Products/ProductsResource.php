<?php

namespace Piggy\Api\Resources\OAuth\Products;

use Piggy\Api\Exceptions\PiggyRequestException;
use Piggy\Api\Mappers\Products\ProductMapper;
use Piggy\Api\Mappers\Products\ProductsMapper;
use Piggy\Api\Models\Products\Product;
use Piggy\Api\Resources\BaseResource;

class ProductsResource extends BaseResource
{
    /**
     * @var string
     */
    protected $resourceUri = '/api/v3/oauth/clients/external-products';

    /**
     * @param  mixed[]  $params
     * @return Product[]
     *
     * @throws PiggyRequestException
     */
    public function list(array $params = []): array
    {
        $response = $this->client->get($this->resourceUri, $params);

        $mapper = new ProductsMapper();

        return $mapper->map((array) $response->getData());
    }

    /**
     * @throws PiggyRequestException
     */
    public function create(string $externalIdentifier, string $name, ?string $description): Product
    {
        $response = $this->client->post($this->resourceUri, [
            'external_identifier' => $externalIdentifier,
            'name' => $name,
            'description' => $description,
        ]);

        $mapper = new ProductMapper();

        return $mapper->map($response->getData());
    }

    /**
     * @param  mixed[]  $params
     *
     * @throws PiggyRequestException
     */
    public function get(string $perkUuid, array $params = []): Product
    {
        $response = $this->client->get("$this->resourceUri/$perkUuid", $params);

        $mapper = new ProductMapper();

        return $mapper->map($response->getData());
    }

    /**
     * @throws PiggyRequestException
     */
    public function update(string $perkUuid, string $label): Product
    {
        $response = $this->client->put("$this->resourceUri/$perkUuid", [
            'label' => $label,
        ]);

        $mapper = new ProductMapper();

        return $mapper->map($response->getData());
    }

    /**
     * @param mixed[] $params
     * @return null
     *
     * @throws PiggyRequestException
     */
    public function delete(string $perkUuid, array $params = [])
    {
        $response = $this->client->destroy("$this->resourceUri/$perkUuid", $params);

        return $response->getData();
    }
}
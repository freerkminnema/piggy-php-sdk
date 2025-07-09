<?php

namespace Piggy\Api\Resources\Register\Products;

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
    protected $resourceUri = '/api/v3/register/external-products';

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
     * @param mixed[] $options
     *
     * @throws PiggyRequestException
     */
    public function create(string $label, string $name, string $dataType, array $options): Product
    {
        $response = $this->client->post($this->resourceUri, [
            'label' => $label,
            'name' => $name,
            'dataType' => $dataType,
            'options' => $options,
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
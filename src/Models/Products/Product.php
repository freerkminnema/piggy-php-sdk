<?php

namespace Piggy\Api\Models\Products;

use GuzzleHttp\Exception\GuzzleException;
use Piggy\Api\ApiClient;
use Piggy\Api\Exceptions\MaintenanceModeException;
use Piggy\Api\Exceptions\PiggyRequestException;
use Piggy\Api\Http\Responses\Response;
use Piggy\Api\Mappers\Products\ProductMapper;
use Piggy\Api\Mappers\Products\ProductsMapper;

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
     * @var string
     */
    const resourceUri = '/api/v3/oauth/clients/external-products';

    public function __construct(
        string $uuid,
        string $externalIdentifier,
        string $name,
        ?string $description
    ) {
        $this->uuid = $uuid;
        $this->externalIdentifier = $externalIdentifier;
        $this->name = $name;
        $this->description = $description;
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

    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param  mixed[]  $params
     * @return Product[]
     *
     * @throws MaintenanceModeException|GuzzleException|PiggyRequestException
     */
    public static function list(array $params = []): array
    {
        $response = ApiClient::get(self::resourceUri, $params);

        return ProductsMapper::map((array) $response->getData());
    }

    /**
     * @param  mixed[]  $body
     *
     * @throws MaintenanceModeException|GuzzleException|PiggyRequestException
     */
    public static function create(array $body): Product
    {
        $response = ApiClient::post(self::resourceUri, $body);

        return ProductMapper::map($response->getData());
    }

    /**
     * @param  mixed[]  $params
     *
     * @throws MaintenanceModeException|GuzzleException|PiggyRequestException
     */
    public static function get(string $perkUuid, array $params = []): Product
    {
        $response = ApiClient::get(self::resourceUri."/$perkUuid", $params);

        return ProductMapper::map($response->getData());
    }

    /**
     * @param  mixed[]  $body
     *
     * @throws MaintenanceModeException|GuzzleException|PiggyRequestException
     */
    public static function update(string $perkUuid, array $body): Product
    {
        $response = ApiClient::put(self::resourceUri."/$perkUuid", $body);

        return ProductMapper::map($response->getData());
    }

    /**
     * @param  mixed[]  $params
     *
     * @throws MaintenanceModeException|GuzzleException|PiggyRequestException
     */
    public static function delete(string $perkUuid, array $params = []): Response
    {
        return ApiClient::delete(self::resourceUri."/$perkUuid", $params);
    }
}

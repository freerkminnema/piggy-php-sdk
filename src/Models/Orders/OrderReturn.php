<?php

namespace Piggy\Api\Models\Orders;

use GuzzleHttp\Exception\GuzzleException;
use Piggy\Api\ApiClient;
use Piggy\Api\Exceptions\MaintenanceModeException;
use Piggy\Api\Exceptions\PiggyRequestException;
use Piggy\Api\StaticMappers\Orders\OrderMapper;

class OrderReturn
{
    /**
     * @var string
     */
    protected $uuid;

    /**
     * @var string
     */
    protected $status;

    /**
     * @var array<string, mixed>
     */
    protected $order = [];

    /**
     * @var LineItemReturn[]
     */
    protected $lineItemReturns = [];

    /**
     * @var SubLineItemReturn[]
     */
    protected $subLineItemReturns = [];

    /**
     * @var string
     */
    const resourceUri = '/api/v3/oauth/clients/order-returns';

    /**
     * @param array<string, mixed> $order
     * @param LineItemReturn[] $lineItemReturns
     * @param SubLineItemReturn[] $subLineItemReturns
     */
    public function __construct(
        string $uuid,
        string $status,
        array $order = [],
        array $lineItemReturns = [],
        array $subLineItemReturns = []
    )
    {
        $this->uuid = $uuid;
        $this->status = $status;
        $this->order = $order;
        $this->lineItemReturns = $lineItemReturns;
        $this->subLineItemReturns = $subLineItemReturns;
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return array<string, mixed>
     */
    public function getOrder(): array
    {
        return $this->order;
    }

    /**
     * @return LineItemReturn[]
     */
    public function getLineItemReturns(): array
    {
        return $this->lineItemReturns;
    }

    /**
     * @return SubLineItemReturn[]
     */
    public function getSubLineItemReturns(): array
    {
        return $this->subLineItemReturns;
    }

    /**
     * @param array<string, mixed> $body
     *
     * @return Order
     *
     * @throws GuzzleException|MaintenanceModeException|PiggyRequestException
     */
    public static function create(array $body): Order
    {
        $response = ApiClient::post(self::resourceUri, $body);

        return OrderMapper::map($response->getData());
    }
}
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
     * @var array
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

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getOrder(): array
    {
        return $this->order;
    }

    public function getLineItemReturns(): array
    {
        return $this->lineItemReturns;
    }

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
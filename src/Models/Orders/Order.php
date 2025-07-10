<?php

namespace Piggy\Api\Models\Orders;

use GuzzleHttp\Exception\GuzzleException;
use Piggy\Api\ApiClient;
use Piggy\Api\Exceptions\MaintenanceModeException;
use Piggy\Api\Exceptions\PiggyRequestException;
use Piggy\Api\Models\Contacts\Contact;
use Piggy\Api\Models\Shops\Shop;
use Piggy\Api\StaticMappers\Orders\OrdersMapper;

class Order
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
     * @var Contact
     */
    protected $contact;

    /**
     * @var Shop
     */
    protected $shop;

    /**
     * @var string
     */
    protected $currency;

    /**
     * @var string|null
     */
    protected $reference;

    /**
     * @var string
     */
    protected $status;

    /**
     * @var string
     */
    protected $paymentStatus;

    /**
     * @var string
     */
    protected $formattedTotalAmount;

    /**
     * @var int|null
     */
    protected $orderAmount;

    /**
     * @var int
     */
    protected $totalChargesAmount;

    /**
     * @var int
     */
    protected $totalDiscountAmount;

    /**
     * @var int
     */
    protected $totalOrderAmount;

    /**
     * @var string|null
     */
    protected $paidAt;

    // TODO: Add Line items
    // TODO: Add Applied discounts
    // TODO: Add Charges

    /**
     * @var string|null
     */
    protected $createdAt;

    /**
     * @var string
     */
    protected $updatedAt;

    /**
     * @var string
     */
    const resourceUri = '/api/v3/oauth/clients/orders';

    public function __construct(
        string $uuid,
        string $externalIdentifier,
        Contact $contact
    ) {
        $this->uuid = $uuid;
        $this->externalIdentifier = $externalIdentifier;
        $this->contact = $contact;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getExternalIdentifier(): string
    {
        return $this->externalIdentifier;
    }

    public function getContact(): Contact
    {
        return $this->contact;
    }

    /**
     * @param array<string, mixed> $params
     *
     * @return Order[]
     *
     * @throws GuzzleException|MaintenanceModeException|PiggyRequestException
     */
    public static function list(array $params = []): array
    {
        $response = ApiClient::get(self::resourceUri, $params);

        return OrdersMapper::map($response->getData());
    }
}
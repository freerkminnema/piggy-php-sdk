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
    protected $formattedTotalOrderAmount;

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

    // TODO: Add Line Items
    // TODO: Add Applied Discounts
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
        Contact $contact,
        Shop $shop,
        string $currency,
        ?string $reference,
        string $status,
        string $paymentStatus,
        string $formattedTotalOrderAmount,
        ?int $orderAmount,
        int $totalChargesAmount,
        int $totalDiscountAmount,
        int $totalOrderAmount,
        ?string $paidAt,
        string $createdAt,
        string $updatedAt
    ) {
        $this->uuid = $uuid;
        $this->externalIdentifier = $externalIdentifier;
        $this->contact = $contact;
        $this->shop = $shop;
        $this->currency = $currency;
        $this->reference = $reference;
        $this->status = $status;
        $this->paymentStatus = $paymentStatus;
        $this->formattedTotalOrderAmount = $formattedTotalOrderAmount;
        $this->orderAmount = $orderAmount;
        $this->totalChargesAmount = $totalChargesAmount;
        $this->totalDiscountAmount = $totalDiscountAmount;
        $this->totalOrderAmount = $totalOrderAmount;
        $this->paidAt = $paidAt;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
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

    public function getShop(): Shop
    {
        return $this->shop;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getPaymentStatus(): string
    {
        return $this->paymentStatus;
    }

    public function getFormattedTotalOrderAmount(): string
    {
        return $this->formattedTotalOrderAmount;
    }

    public function getOrderAmount(): ?int
    {
        return $this->orderAmount;
    }

    public function getTotalChargesAmount(): int
    {
        return $this->totalChargesAmount;
    }

    public function getTotalDiscountAmount(): int
    {
        return $this->totalDiscountAmount;
    }

    public function getTotalOrderAmount(): int
    {
        return $this->totalOrderAmount;
    }

    public function getPaidAt(): ?string
    {
        return $this->paidAt;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
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
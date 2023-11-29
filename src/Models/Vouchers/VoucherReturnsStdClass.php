<?php

namespace Piggy\Api\Models\Vouchers;

use DateTime;
use GuzzleHttp\Exception\GuzzleException;
use Piggy\Api\ApiClient;
use Piggy\Api\Exceptions\MaintenanceModeException;
use Piggy\Api\Exceptions\PiggyRequestException;
use Piggy\Api\Models\Contacts\Contact;
use Piggy\Api\StaticMappers\Vouchers\VoucherLockMapper;
use Piggy\Api\StaticMappers\Vouchers\VoucherMapper;
use Piggy\Api\StaticMappers\Vouchers\VouchersMapper;
use stdClass;

class VoucherReturnsStdClass
{
    /**
     * @var string
     */
    protected $uuid;

    /**
     * @var string
     */
    protected $code;

    /**
     * @var string
     */
    protected $status;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var DateTime
     */
    protected $expiration_date;

    /**
     * @var DateTime|null
     */
    protected $activation_date;

    /**
     * @var DateTime|null
     */
    protected $redeemed_at;

    /**
     * @var bool
     */
    protected $is_redeemed;

    /**
     * @var Promotion
     */
    protected $promotion;

    /**
     * @var Contact|null
     */
    protected $contact;

    /**
     * @var string
     */
    protected static $resourceUri = "/api/v3/oauth/clients/vouchers";

    /**
     * @param string $uuid
     * @param string $status
     * @param string|null $code
     * @param string|null $name
     * @param string|null $description
     * @param Promotion|null $promotion
     * @param Contact|null $contact
     * @param DateTime|null $redeemedAt
     * @param bool|null $isRedeemed
     * @param DateTime|null $activationDate
     * @param DateTime|null $expirationDate
     */
    public function __construct(
        string     $uuid,
        string     $status,
        ?string    $code,
        ?string    $name,
        ?string    $description,
        ?Promotion $promotion,
        ?Contact   $contact,
        ?DateTime  $redeemedAt,
        ?bool      $isRedeemed,
        ?DateTime  $activationDate,
        ?DateTime  $expirationDate
    )
    {
        $this->uuid = $uuid;
        $this->code = $code;
        $this->name = $name;
        $this->status = $status;
        $this->description = $description;
        $this->promotion = $promotion;
        $this->contact = $contact;
        $this->redeemed_at = $redeemedAt;
        $this->is_redeemed = $isRedeemed;
        $this->activation_date = $activationDate;
        $this->expiration_date = $expirationDate;
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @return string|null
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @return Promotion|null
     */
    public function getPromotion(): ?Promotion
    {
        return $this->promotion;
    }

    /**
     * @return DateTime|null
     */
    public function getExpirationDate(): ?DateTime
    {
        return $this->expiration_date;
    }

    /**
     * @return DateTime|null
     */
    public function getActivationDate(): ?DateTime
    {
        return $this->activation_date;
    }

    /**
     * @return DateTime|null
     */
    public function getRedeemedAt(): ?DateTime
    {
        return $this->redeemed_at;
    }

    /**
     * @return bool|null
     */
    public function isRedeemed(): ?bool
    {
        return $this->is_redeemed;
    }

    /**
     * @return Contact|null
     */
    public function getContact(): ?Contact
    {
        return $this->contact;
    }

    /**
     * @param array $body
     * @return stdClass
     * @throws MaintenanceModeException|GuzzleException|PiggyRequestException
     */
    public static function create(array $body): stdClass
    {
        $response = ApiClient::post(self::$resourceUri, $body);

        return $response->getData();
    }

    /**
     * @param array $params
     * @return stdClass
     * @throws MaintenanceModeException|GuzzleException|PiggyRequestException
     */
    public static function batch(array $params): stdClass
    {
        $response = ApiClient::post(self::$resourceUri . "/batch", $params);

        return $response->getData();
    }

    /**
     * @param array $params
     * @return array
     * @throws MaintenanceModeException|GuzzleException|PiggyRequestException
     */
    public static function list(array $params = []): array
    {
        $response = ApiClient::get(self::$resourceUri, $params);

        return (array)$response->getData();
    }

    /**
     * @param array $params
     * @return stdClass
     * @throws MaintenanceModeException|GuzzleException|PiggyRequestException
     */
    public static function find(array $params): stdClass
    {
        $response = ApiClient::get(self::$resourceUri . "/find", $params);

        return $response->getData();
    }

    /**
     * @param array $params
     * @return stdClass
     * @throws MaintenanceModeException|GuzzleException|PiggyRequestException
     */
    public static function redeem(array $params): stdClass
    {
        $response = ApiClient::post(self::$resourceUri . "/redeem", $params);

        return $response->getData();
    }

    /**
     * @param string $voucherUuid
     * @param array $body
     * @return stdClass
     * @throws MaintenanceModeException|GuzzleException|PiggyRequestException
     */
    public static function lock(string $voucherUuid, array $body = []): stdClass
    {
        $response = ApiClient::post(self::$resourceUri . "/$voucherUuid/lock/", $body);

        return $response->getData();
    }

    /**
     * @param string $voucherUuid
     * @param array $body
     * @return stdClass
     * @throws MaintenanceModeException|GuzzleException|PiggyRequestException
     */
    public static function release(string $voucherUuid, array $body): stdClass
    {
        $response = ApiClient::post(self::$resourceUri . "/$voucherUuid/release/", $body);

        return $response->getData();
    }

    /**
     * @param string $voucherUuid
     * @param array $body
     * @return stdClass
     * @throws MaintenanceModeException|GuzzleException|PiggyRequestException
     */
    public static function update(string $voucherUuid, array $body): stdClass
    {
        $response = ApiClient::put(self::$resourceUri . "/$voucherUuid", $body);

        return $response->getData();
    }
}

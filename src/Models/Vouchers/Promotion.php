<?php

namespace Piggy\Api\Models\Vouchers;

use GuzzleHttp\Exception\GuzzleException;
use Piggy\Api\Environment;
use Piggy\Api\Mappers\Vouchers\PromotionMapper;
use Piggy\Api\Mappers\Vouchers\PromotionsMapper;

class Promotion
{
    /**
     * @var string
     */
    protected $uuid;
    /**
     * @var string
     */
    protected $name;
    /**
     * @var string
     */
    protected $description;
    /**
     * @var int|null
     */
    protected $voucher_limit;
    /**
     * @var int|null
     */
    protected $limit_per_contact;
    /**
     * @var int|null
     */
    protected $expiration_duration;

    /**
     * @var string
     */
    protected static $resourceUri = "/api/v3/oauth/clients/promotions";

    /**
     * @var string
     */
    protected static $mapper = PromotionMapper::class;

    /**
     * @param string $uuid
     * @param string $name
     * @param string $description
     * @param int|null $voucher_limit
     * @param int|null $limit_per_contact
     * @param int|null $expiration_duration
     */
    public function __construct(
        string $uuid,
        string $name,
        string $description,
        ?int   $voucher_limit = null,
        ?int   $limit_per_contact = null,
        ?int   $expiration_duration = null
    )
    {
        $this->uuid = $uuid;
        $this->name = $name;
        $this->description = $description;
        $this->voucher_limit = $voucher_limit;
        $this->limit_per_contact = $limit_per_contact;
        $this->expiration_duration = $expiration_duration;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return int|null
     */
    public function getVoucherLimit(): ?int
    {
        return $this->voucher_limit;
    }

    /**
     * @return int|null
     */
    public function getLimitPerContact(): ?int
    {
        return $this->limit_per_contact;
    }

    /**
     * @return int|null
     */
    public function getExpirationDuration(): ?int
    {
        return $this->expiration_duration;
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @param array $body
     * @return Promotion
     * @throws GuzzleException
     */
    public static function create(array $body): Promotion
    {
        $response = Environment::post(self::$resourceUri, $body);

        $mapper = new self::$mapper;

        return $mapper->map($response->getData());
    }

    /**
     * @param array $params
     * @return array
     * @throws GuzzleException
     */
    public static function list(array $params = []): array
    {
        $response = Environment::get(self::$resourceUri, $params);

        $mapper = new PromotionsMapper();

        return $mapper->map((array)$response->getData());
    }
}


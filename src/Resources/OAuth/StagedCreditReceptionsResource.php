<?php

namespace Piggy\Api\Resources\OAuth;

use Piggy\Api\Exceptions\BadResponseException;
use Piggy\Api\Exceptions\RequestException;
use Piggy\Api\Mappers\StagedCreditReceptionMapper;
use Piggy\Api\Models\StagedCreditReception;
use Piggy\Api\Resources\BaseResource;

/**
 * Class StagedCreditReceptionsResource
 * @package Piggy\Api\Resources\OAuth
 */
class StagedCreditReceptionsResource extends BaseResource
{
    /**
     * @var string
     */
    protected $resourceUri = "/api/v2/oauth/clients/staged-credit-receptions";

    /**
     * @param int $id
     * @return StagedCreditReception
     * @throws RequestException
     * @throws BadResponseException
     */
    public function get(int $id): StagedCreditReception
    {
        $response = $this->client->get("{$this->resourceUri}/{$id}", []);

        $mapper = new StagedCreditReceptionMapper();

        return $mapper->map($response->getData());
    }

    /**
     * @param $hash
     * @param $email
     * @param null $locale
     * @return StagedCreditReception
     * @throws BadResponseException
     * @throws RequestException
     */
    public function send($hash, $email, $locale = null): StagedCreditReception
    {
        $body = [
            "hash" => $hash,
            "email" => $email,
            "locale" => $locale
        ];

        $response = $this->client->post("{$this->resourceUri}/send", $body);

        $mapper = new StagedCreditReceptionMapper();

        return $mapper->map($response->getData());
    }

    /**
     * @param int $shopId
     * @param int $purchaseAmount
     * @param int|null $credits
     * @return StagedCreditReception
     * @throws BadResponseException
     * @throws RequestException
     */
    public function create(int $shopId, int $purchaseAmount, int $credits = null): StagedCreditReception
    {
        $body = [
            "shop_id" => $shopId,
            "purchase_amount" => $purchaseAmount,
            "credits" => $credits,
        ];

        $response = $this->client->post($this->resourceUri, $body);

        $mapper = new StagedCreditReceptionMapper();

        return $mapper->map($response->getData());
    }
}
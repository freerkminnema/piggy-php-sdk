<?php

namespace Piggy\Api\Resources\Register\Loyalty\Receptions;

use Piggy\Api\Exceptions\PiggyRequestException;
use Piggy\Api\Mappers\Loyalty\Receptions\CreditReceptionMapper;
use Piggy\Api\Mappers\Loyalty\Receptions\RewardReceptionMapper;
use Piggy\Api\Models\Loyalty\Receptions\CreditReception;
use Piggy\Api\Models\Loyalty\Receptions\DigitalRewardReception;
use Piggy\Api\Models\Loyalty\Receptions\PhysicalRewardReception;
use Piggy\Api\Resources\BaseResource;

/**
 * Class RewardReceptionsResource
 * @package Piggy\Api\Resources\Register\Loyalty\Receptions
 */
class RewardReceptionsResource extends BaseResource
{
    /**
     * @var string
     */
    protected $resourceUri = "/api/v3/register/reward-receptions";

    /**
     * @param string $contactUuid
     * @param string $rewardUuid
     *
     * @return DigitalRewardReception|PhysicalRewardReception|null
     * @throws PiggyRequestException
     */
    public function create(string $contactUuid, string $rewardUuid, ?string $contactIdentifierValue = null)
    {
        $response = $this->client->post($this->resourceUri, [
            "contact_uuid" => $contactUuid,
            "reward_uuid" => $rewardUuid,
            "contact_identifier_value" => $contactIdentifierValue,
        ]);

        $mapper = new RewardReceptionMapper();

        return $mapper->map($response->getData());
    }

    /**
     * @param string $rewardReceptionUuid
     * @return CreditReception
     * @throws PiggyRequestException
     */
    public function reverse(string $rewardReceptionUuid): CreditReception
    {
        $response = $this->client->post("$this->resourceUri/$rewardReceptionUuid/reverse", []);

        $mapper = new CreditReceptionMapper();

        return $mapper->map($response->getData());
    }
}

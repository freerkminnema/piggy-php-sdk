<?php

namespace Piggy\Api\Resources\OAuth\Contacts;

use Piggy\Api\Exceptions\PiggyRequestException;
use Piggy\Api\Mappers\ContactIdentifiers\ContactIdentifierMapper;
use Piggy\Api\Models\Contacts\ContactIdentifier;
use Piggy\Api\Resources\BaseResource;

/**
 * Class ContactIdentifiersResource
 */
class ContactIdentifiersResource extends BaseResource
{
    /**
     * @var string
     */
    protected $resourceUri = '/api/v3/oauth/clients/contact-identifiers';

    /**
     * @throws PiggyRequestException
     */
    public function get(string $contactIdentifierValue): ContactIdentifier
    {
        $response = $this->client->get("$this->resourceUri/find", [
            'contact_identifier_value' => $contactIdentifierValue,
        ]);

        $mapper = new ContactIdentifierMapper();

        return $mapper->map($response->getData());
    }

    /**
     * @throws PiggyRequestException
     */
    public function create(string $contactIdentifierValue, ?string $contactIdentifierName = '', ?string $contactUuid = null): ContactIdentifier
    {
        $data = [
            'contact_identifier_value' => $contactIdentifierValue,
        ];

        if ($contactIdentifierName != null) {
            $data['contact_identifier_name'] = $contactIdentifierName;
        }

        if ($contactUuid != null) {
            $data['contact_uuid'] = $contactUuid;
        }

        $response = $this->client->post($this->resourceUri, $data);
        $mapper = new ContactIdentifierMapper();

        return $mapper->map($response->getData());
    }

    public function link(string $contactIdentifierValue, string $contactUuid): ContactIdentifier
    {
        $response = $this->client->put("$this->resourceUri/link", [
            'contact_identifier_value' => $contactIdentifierValue,
            'contact_uuid' => $contactUuid,
        ]);

        $mapper = new ContactIdentifierMapper();

        return $mapper->map($response->getData());
    }
}

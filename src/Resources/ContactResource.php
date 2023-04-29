<?php

namespace TagMyDoc\LeadFox\Resources;

use TagMyDoc\LeadFox\Requests\CreateContactRequest;
use TagMyDoc\LeadFox\Requests\DeleteContactRequest;
use TagMyDoc\LeadFox\Requests\GetContactRequest;
use TagMyDoc\LeadFox\Requests\GetContactsRequest;
use TagMyDoc\LeadFox\Requests\UpdateContactRequest;
use TagMyDoc\LeadFox\Requests\UpsertContactRequest;
use TagMyDoc\LeadFox\Responses\Contact;

class ContactResource extends Resource
{
    public function all(...$arguments): array
    {
        $response = $this->connector->send(new GetContactsRequest(...$arguments));

        return $response->dtoOrFail();
    }

    public function get(string $id): Contact
    {
        $response = $this->connector->send(new GetContactRequest($id));

        return $response->dtoOrFail();
    }

    public function create(string $email, array $properties = []): Contact
    {
        $response = $this->connector->send(new CreateContactRequest($email, $properties));

        return $response->dtoOrFail();
    }

    public function upsert(string $email, array $properties = []): Contact
    {
        $response = $this->connector->send(new UpsertContactRequest($email, $properties));

        return $response->dtoOrFail();
    }

    public function update(string $email, array $properties = []): Contact
    {
        $response = $this->connector->send(new UpdateContactRequest($email, $properties));

        return $response->dtoOrFail();
    }

    public function delete(string $id): bool
    {
        return $this->connector->send(new DeleteContactRequest($id))->status() === 204;
    }
}
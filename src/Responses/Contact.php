<?php

namespace TagMyDoc\LeadFox\Responses;

use Carbon\Carbon;
use Saloon\Contracts\Response;

class Contact
{
    public function __construct(
        public readonly string $id,
        public readonly string $owner,
        public readonly string $email,
        public readonly ?string $name,
        public readonly string $lifecycle,
        public readonly bool $subscribed,
        public readonly Carbon $created,
        public readonly Carbon $modified,
        public readonly array $lists,
        public readonly array $mailingLists,
        public readonly array $properties
    )
    {
    }

    public static function fromResponse(Response $response): self
    {
        return new static(
            id: $response->json('_id'),
            owner: $response->json('_owner'),
            email: $response->json('email'),
            name: $response->json('name'),
            lifecycle: $response->json('lifecycle'),
            subscribed: $response->json('subscribed'),
            created: Carbon::parse($response->json('created')),
            modified: Carbon::parse($response->json('modified')),
            lists: $response->json('lists'),
            mailingLists: $response->json('mailinglists'),
            properties: $response->json('properties')
        );
    }

    public static function fromObject(array $object): self
    {
        return new static(
            id: $object['_id'],
            owner: $object['_owner'],
            email: $object['email'],
            name: $object['name'],
            lifecycle: $object['lifecycle'],
            subscribed: $object['subscribed'],
            created: Carbon::parse($object['created']),
            modified: Carbon::parse($object['modified']),
            lists: $object['lists'],
            mailingLists: $object['mailinglists'],
            properties: $object['properties'],
        );
    }
}
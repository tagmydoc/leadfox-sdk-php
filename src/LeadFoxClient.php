<?php

namespace TagMyDoc\LeadFox;

use Saloon\Contracts\Authenticator;
use Saloon\Http\Connector;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;
use TagMyDoc\LeadFox\Resources\ContactResource;

class LeadFoxClient extends Connector
{
    use AlwaysThrowOnErrors;

    public function __construct(protected string $apiKey, protected string $secretKey)
    {
    }

    public function resolveBaseUrl(): string
    {
        return 'https://rest.leadfox.co/v1';
    }

    protected function defaultAuth(): ?Authenticator
    {
        return new LeadFoxAuthenticator($this->apiKey, $this->secretKey);
    }

    protected function defaultHeaders(): array
    {
        return [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ];
    }

    public function contacts(): ContactResource
    {
        return new ContactResource($this);
    }
}
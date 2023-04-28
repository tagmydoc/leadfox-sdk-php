<?php

namespace TagMyDoc\LeadFox\Requests;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class AuthenticationRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(protected string $apiKey, protected string $secretKey)
    {
    }

    public function defaultBody(): array
    {
        return [
            'apikey' => $this->apiKey,
            'secret' => $this->secretKey
        ];
    }

    public function resolveEndpoint(): string
    {
        return '/auth';
    }
}
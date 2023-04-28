<?php

namespace TagMyDoc\LeadFox\Requests;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class UpsertContactRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(protected string $email, protected array $properties = [])
    {
    }

    public function resolveEndpoint(): string
    {
        return '/contact/upsert';
    }

    public function defaultBody(): array
    {
        return [
            'email' => $this->email,
            ...$this->properties
        ];
    }
}
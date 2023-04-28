<?php

namespace TagMyDoc\LeadFox\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetContactsRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(protected ?string $email = null)
    {
    }

    protected function defaultQuery(): array
    {
        $filters = '';

        if ($this->email) {
            $filters = 'email = ' . rawurlencode($this->email);
        }

        return [
            'filters' => $filters
        ];
    }

    public function resolveEndpoint(): string
    {
        return '/contact';
    }
}
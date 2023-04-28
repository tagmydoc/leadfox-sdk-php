<?php

namespace TagMyDoc\LeadFox\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DeleteContactRequest extends Request
{
    protected Method $method = Method::DELETE;

    public function __construct(protected string $id)
    {
    }

    public function resolveEndpoint(): string
    {
        return "/contact/$this->id";
    }
}
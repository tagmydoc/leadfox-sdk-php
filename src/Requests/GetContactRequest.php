<?php

namespace TagMyDoc\LeadFox\Requests;

use Saloon\Contracts\Response;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use TagMyDoc\LeadFox\Responses\Contact;

class GetContactRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(protected string $id)
    {
    }

    public function resolveEndpoint(): string
    {
        return "/contact/$this->id";
    }

    public function createDtoFromResponse(Response $response): mixed
    {
        return Contact::fromResponse($response);
    }
}
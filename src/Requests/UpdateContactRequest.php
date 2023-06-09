<?php

namespace TagMyDoc\LeadFox\Requests;

use Saloon\Contracts\Body\HasBody;
use Saloon\Contracts\Response;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;
use TagMyDoc\LeadFox\Responses\Contact;

class UpdateContactRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PUT;

    public function __construct(protected string $id, protected array $properties = [])
    {
    }

    public function resolveEndpoint(): string
    {
        return "/contact/$this->id";
    }

    public function defaultBody(): array
    {
        return $this->properties;
    }

    public function createDtoFromResponse(Response $response): mixed
    {
        return Contact::fromResponse($response);
    }
}
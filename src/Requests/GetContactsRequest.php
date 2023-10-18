<?php

namespace TagMyDoc\LeadFox\Requests;

use Saloon\Contracts\Response;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use TagMyDoc\LeadFox\Responses\Contact;

class GetContactsRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(protected ?string $email = null, protected string|array|null $fields = null, protected ?int $skip = null, protected ?int $limit = null)
    {
    }

    protected function defaultQuery(): array
    {
        $params = [];
        $filters = [];

        if ($this->email) {
            $filters[] = "email = {$this->email}";
        }

        if (count($filters) > 0) {
            $params['filters'] = $filters;
        }

        if ($this->limit) {
            $params['limit'] = $this->limit;
        }

        if ($this->skip) {
            $params['skip'] = $this->skip;
        }

        if (is_array($this->fields)) {
            $params['fields'] = implode(',', $this->fields);
        } elseif (is_string($this->fields)) {
            $params['fields'] = $this->fields;
        }

        return $params;
    }

    public function resolveEndpoint(): string
    {
        return '/contact';
    }

    public function createDtoFromResponse(Response $response): mixed
    {
        $contacts = [];

        foreach ($response->json() as $contact) {
            $contacts[] = Contact::fromObject($contact);
        }

        return $contacts;
    }
}
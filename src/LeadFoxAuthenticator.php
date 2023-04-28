<?php

namespace TagMyDoc\LeadFox;

use Saloon\Contracts\Authenticator;
use Saloon\Contracts\PendingRequest;
use TagMyDoc\LeadFox\Requests\AuthenticationRequest;

class LeadFoxAuthenticator implements Authenticator
{
    protected ?string $jwtToken = null;

    public function __construct(protected string $apiKey, protected string $secretKey)
    {
    }

    public function set(PendingRequest $pendingRequest): void
    {
        // Make sure to ignore the authentication request to prevent loops.
        if ($pendingRequest->getRequest() instanceof AuthenticationRequest) {
            return;
        }

        if ($this->jwtToken === null) {
            // Make a request to the Authentication endpoint using the same connector.
            $response = $pendingRequest->getConnector()->send(new AuthenticationRequest($this->apiKey, $this->secretKey));
            $this->jwtToken = $response->json('jwt');
        }

        // Finally, authenticate the previous PendingRequest before it is sent.
        $pendingRequest->headers()->add('Authorization', "JWT $this->jwtToken");
    }
}
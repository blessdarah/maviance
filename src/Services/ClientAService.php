<?php

declare(strict_types=1);

namespace Maviance\PHPTest\Services;

use GuzzleHttp\Client;
use Maviance\PHPTest\Interfaces\ClientInterface;
use Maviance\PHPTest\Interfaces\StoreInterface;

class ClientAService implements ClientInterface
{
    protected $store;

    protected string $baseUri;

    protected $guzzleClient;

    public function __construct(StoreInterface $store)
    {
        $this->baseUri = 'https://balance.free.beeceptor.com';
        $this->guzzleClient = new Client();
        $this->store = $store;
    }

    public function getBalance(string|int $accountId): float
    {
        $response = $this->guzzleClient->get("$this->baseUri/acount-balance/$accountId");
        if ($response->getStatusCode() === 200) {
            return (float) $response->getBody()->getContents();
        }
    }
}

<?php

declare(strict_types=1);

namespace Maviance\PHPTest\Services;

use GuzzleHttp\Client;
use Maviance\PHPTest\Interfaces\ClientInterface;
use Maviance\PHPTest\Interfaces\StoreInterface;

class ClientBService implements ClientInterface
{
    protected $store;

    protected string $baseUri;

    protected $client;

    public function __construct(StoreInterface $store)
    {
        $this->baseUri = 'https://balance.free.beeceptor.com/getaccbal';
        $this->store = $store;
        $this->client = new Client;
    }

    /** Get user account balance */
    public function getBalance(string|int $accountId): float|string
    {
        $response = $this->client->get($this->baseUri);

        return $response->getBody()->getContents();
    }
}

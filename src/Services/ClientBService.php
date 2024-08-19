<?php

declare(strict_types=1);

namespace Maviance\PHPTest\Services;

use GuzzleHttp\Client;
use Maviance\PHPTest\Interfaces\ClientInterface;
use Maviance\PHPTest\Models\Balance;

class ClientBService implements ClientInterface
{
    protected string $baseUri;

    protected $client;

    public function __construct()
    {
        $this->baseUri = 'https://balance.free.beeceptor.com/getaccbal';
        $this->client = new Client();
    }

    public function create(string $accountId): Balance
    {
        $amount = $this->getBalance($accountId);
        $balance = new Balance($accountId, $amount);

        return $balance;
    }

    /** Get user account balance */
    public function getBalance(string|int $accountId): float|string
    {
        $response = $this->client->get($this->baseUri);

        return $response->getBody()->getContents();
    }
}

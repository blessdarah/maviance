<?php

declare(strict_types=1);

namespace Maviance\PHPTest\Services;

use GuzzleHttp\Client;
use Maviance\PHPTest\Interfaces\ClientInterface;
use Maviance\PHPTest\Models\Balance;

class ClientAService implements ClientInterface
{
    protected string $baseUri;

    protected $guzzleClient;

    public function __construct()
    {
        $this->baseUri = 'https://balance.free.beeceptor.com';
        $this->guzzleClient = new Client;
    }

    public function create(string $accountId): Balance
    {
        $amount = $this->getBalance($accountId);
        $balance = new Balance($accountId, $amount);

        return $balance;
    }

    public function getBalance(string|int $accountId): float
    {
        $response = $this->guzzleClient->get("$this->baseUri/account-balance/$accountId");
        if ($response->getStatusCode() === 200) {
            return (float) $response->getBody()->getContents();
        }
    }
}

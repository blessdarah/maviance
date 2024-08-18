<?php

declare(strict_types=1);

namespace Maviance\PHPTest\Services;

use Exception;
use Maviance\PHPTest\Interfaces\ClientInterface;
use Maviance\PHPTest\Interfaces\StoreInterface;

class ClientAService implements ClientInterface
{
    protected $store;

    protected string $uri;

    public function __construct(StoreInterface $store)
    {
        $this->uri = 'https://balance.free.beeceptor.com/account-balance/';
        $this->store = $store;
    }

    public function getBalance(string|int $accountId): float
    {
        $response = file_get_contents($this->uri . $accountId, true);
        if ($response === false) {
            throw new Exception('Could not fetch account balance');
        }

        return (float) $response;
    }
}

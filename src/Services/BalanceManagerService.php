<?php

declare(strict_types=1);

namespace Maviance\PHPTest\Services;

use Maviance\PHPTest\Interfaces\ClientInterface;
use Maviance\PHPTest\Interfaces\StoreInterface;
use Maviance\PHPTest\Models\Balance;
use Monolog\Logger;

class BalanceManagerService
{
    private StoreInterface $store;

    private ClientInterface $client;

    private Logger $logger;

    public function __construct(ClientInterface $client, StoreInterface $store)
    {
        $this->store = $store;
        $this->client = $client;
        $this->logger = new Logger('app');
    }

    public function refresh(string $accountId)
    {
        try {
            $balance_amount = $this->client->getBalance($accountId);
            $balance = new Balance(accountId: $accountId, amount: $balance_amount);
            $balance->setSuccessful(true);
            $this->logger->info(\sprintf('AccountId - %s. Balance: %s', $accountId, $balance_amount));
        } catch (\Throwable $th) {
            $balance->setSuccessful(false);
            $balance->setError(\sprintf('Error: class - %s - Message - %s', get_class($th), $th->getMessage()));
            $this->logger->error(\sprintf('Error: class - %s - Message - %s', get_class($th), $th->getMessage()));
        } finally {
            $this->store->save($balance);
        }
    }
}

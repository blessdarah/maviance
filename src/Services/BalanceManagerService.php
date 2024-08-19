<?php

declare(strict_types=1);

namespace Maviance\PHPTest\Services;

use Maviance\PHPTest\Factory\ClientFactory;
use Maviance\PHPTest\Interfaces\StoreInterface;
use Maviance\PHPTest\Models\Balance;
use Monolog\Logger;

class BalanceManagerService
{
    private StoreInterface $store;

    private Logger $logger;

    public function __construct(StoreInterface $store)
    {
        $this->store = $store;
        $this->logger = new Logger('app');
    }

    public function refresh(string $accountId): void
    {
        $client = ClientFactory::createClient($accountId);
        try {
            $balance_amount = $client->getBalance($accountId);
            $balance = new Balance(accountId: $accountId, amount: (float) $balance_amount);
            $balance->setSuccessful(true);
            $this->logger->info(\sprintf('AccountId - %s. Balance: %s', $accountId, $balance_amount));
            $this->store->save($balance);
        } catch (\Exception $e) {
            $balance->setSuccessful(false);
            $balance->setError(\sprintf('Error: class - %s - Message - %s', get_class($e), $e->getMessage()));
            $this->logger->error(\sprintf('Error: class - %s - Message - %s', get_class($e), $e->getMessage()));
            echo 'Error: '.$e->getMessage();
        }
    }
}

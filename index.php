<?php

require __DIR__ . '/vendor/autoload.php';

use Maviance\PHPTest\Models\Balance;
use Maviance\PHPTest\Persistence\FileStore;
use Maviance\PHPTest\Services\BalanceManagerService;
use Maviance\PHPTest\Services\ClientAService;

$store = new FileStore('logs.txt');
$clientA = new ClientAService($store);
$manager = new BalanceManagerService($clientA, $store);
$store->save(new Balance('443', 300));
$manager->refreshStore('445');

<?php

require __DIR__.'/vendor/autoload.php';

use Maviance\PHPTest\Models\Balance;
use Maviance\PHPTest\Persistence\FileStore;
use Maviance\PHPTest\Services\BalanceManagerService;
use Maviance\PHPTest\Services\ClientAService;
use Maviance\PHPTest\Services\ClientBService;

$store = new FileStore('logs.txt');

$clientA = new ClientAService($store);
$clientB = new ClientBService($store);

$managerA = new BalanceManagerService($clientA, $store);
$managerB = new BalanceManagerService($clientB, $store);

$store->save(new Balance('443', 300));
$store->save(new Balance('443', 300));

require './src/Views/index.php';

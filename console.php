<?php

require __DIR__.'/vendor/autoload.php';

use Maviance\PHPTest\Console\Commands\GetBalanceCommand;
use Maviance\PHPTest\Console\Commands\RefreshBalanceCommand;

$availableCommands = [
    'refresh:balance' => RefreshBalanceCommand::class,
    'get:balance' => GetBalanceCommand::class,
];

if ($argc < 2) {
    echo "Usage: php console.php <command> [arguments]\n";
    exit(1);
}

$commandName = $argv[1];
$arguments = array_slice($argv, 2);

if (! isset($availableCommands[$commandName])) {
    echo "Unknown command: $commandName\n";
    exit(1);
}

$commandClass = $availableCommands[$commandName];
$command = new $commandClass;

// Assuming all commands have an `execute` method
call_user_func_array([$command, 'execute'], $arguments);

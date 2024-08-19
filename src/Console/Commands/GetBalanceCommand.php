<?php

namespace Maviance\PHPTest\Console\Commands;

use Maviance\PHPTest\Persistence\FileStore;

class GetBalanceCommand
{
    public function execute(?string $name): void
    {
        try {
            $file_store = new FileStore;
            $bal = $file_store->getBalance($name);
            echo "Balance for user $name: $bal units";
        } catch (\Exception $e) {
            echo "Error: we don't have data for the given account";
        }
    }
}

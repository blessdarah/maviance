<?php

namespace Maviance\PHPTest\Console\Commands;

use Maviance\PHPTest\Persistence\FileStore;
use Maviance\PHPTest\Services\BalanceManagerService;

class RefreshBalanceCommand
{
    /**
     * @method execute - The script to run when command is called from the terminal
     *
     * @param  string  $name  - Account id
     */
    public function execute(?string $name = null): void
    {
        try {
            $file_store = new FileStore;
            $manager = new BalanceManagerService($file_store);
            $manager->refresh($name);
            echo 'Balance has been fetched';
        } catch (\Exception $e) {
            echo 'Could not fetch from server';
        }
    }
}

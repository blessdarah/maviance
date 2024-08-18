<?php

declare(strict_types=1);

namespace Maviance\PHPTest\Interfaces;

use Maviance\PHPTest\Models\Balance;

interface StoreInterface
{
    /** How to store data to the store */
    public function save(Balance $balance): bool;

    /** Read data from the store */
    public function getBalance(string|int $accountId): float;
}

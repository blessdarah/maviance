<?php

declare(strict_types=1);

namespace Maviance\PHPTest\Interfaces;

use Maviance\PHPTest\Models\Balance;

interface ClientInterface
{
    public function create(string $accountId): Balance;

    public function getBalance(string|int $accountId): float|string;
}

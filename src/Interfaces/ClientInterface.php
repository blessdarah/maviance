<?php

declare(strict_types=1);

namespace Maviance\PHPTest\Interfaces;

interface ClientInterface
{
    public function getBalance(string|int $accountId): float|string;
}

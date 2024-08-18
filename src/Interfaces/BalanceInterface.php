<?php

declare(strict_types=1);

namespace Maviance\PHPTest\Interfaces;

interface BalanceInterface
{
    public function getBalance(): float;

    public function getAccountId(): string;
}

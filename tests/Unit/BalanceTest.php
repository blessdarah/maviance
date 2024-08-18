<?php

use Maviance\PHPTest\Models\Balance;
use PHPUnit\Framework\TestCase;

class BalanceTest extends TestCase
{
    public function test_throws_exception_when_balance_is_negative()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Amount cannot be negative');
        new Balance('445', -1);
    }

    public function test_creates_balance_when_positive_amount_used()
    {
        $balance = new Balance('445', 100);
        $this->assertEquals(100.0, $balance->getAmount());
    }
}

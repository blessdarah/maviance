<?php

declare(strict_types=1);

use Maviance\PHPTest\Services\BalanceManagerService;
use PHPUnit\Framework\TestCase;

class BalanceManagerTest extends TestCase
{
    public function test_can_pull_data_from_api()
    {
        $manager_mock = $this->createMock(BalanceManagerService::class);
        $manager_mock->method('refreshStore');
    }
}

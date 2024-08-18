<?php

use Maviance\PHPTest\Models\Balance;
use Maviance\PHPTest\Persistence\FileStore;
use PHPUnit\Framework\TestCase;

class FileStoreTest extends TestCase
{
    public function test_can_save_a_valid_balance()
    {
        $store = new FileStore('test');
        $balance = new Balance('445', 300);
        $store->save($balance);
        $this->assertIsReadable($store->getFilePath());
        $this->assertEquals(json_encode($balance), file_get_contents($store->getFilePath()));
    }
}

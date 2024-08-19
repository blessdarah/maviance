<?php

declare(strict_types=1);

namespace Maviance\PHPTest\Persistence;

use Maviance\PHPTest\Interfaces\StoreInterface;
use Maviance\PHPTest\Models\Balance;
use SebastianBergmann\CodeCoverage\FileCouldNotBeWrittenException;

class FileStore implements StoreInterface
{
    private string $file_path;

    public function __construct()
    {
        $this->file_path = __DIR__ . '/../Storage/';
    }

    public function getFilePath(): string
    {
        return $this->file_path;
    }

    public function save(Balance $balance): bool
    {
        $response = file_put_contents($this->file_path . $balance->getAccountId() . '.json', json_encode($balance->toArray()));
        if ($response === false) {
            throw new FileCouldNotBeWrittenException('File could not be written to');
        }

        return true;
    }

    public function getBalance(string|int $accountId): float
    {
        $store_path = $this->file_path . "$accountId.json";
        $file_result = file_get_contents($store_path);
        if (!file_exists($store_path)) {
            throw new \Exception('File does not exist');
        }
        $balance = json_decode($file_result);

        return $balance->amount ?? 0;
    }
}

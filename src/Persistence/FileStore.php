<?php

declare(strict_types=1);

namespace Maviance\PHPTest\Persistence;

use Maviance\PHPTest\Interfaces\StoreInterface;
use Maviance\PHPTest\Models\Balance;
use SebastianBergmann\CodeCoverage\FileCouldNotBeWrittenException;

class FileStore implements StoreInterface
{
    private string $file_path;

    public function __construct(string $fileName)
    {
        $this->file_path = __DIR__ . '/../Storage/' . $fileName;
    }

    public function getFilePath()
    {
        return $this->file_path;
    }

    public function save(Balance $balance): bool
    {
        $response = file_put_contents($this->file_path, json_encode($balance));
        if ($response === false) {
            throw new FileCouldNotBeWrittenException('File could not be written to');
        }

        return true;
    }

    public function getBalance(string|int $accountId): float
    {
        $data = json_decode(file_get_contents($this->file_path), true);

        return $data ?? 0;
    }
}

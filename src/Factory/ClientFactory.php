<?php

namespace Maviance\PHPTest\Factory;

use Exception;
use Maviance\PHPTest\Services\ClientAService;
use Maviance\PHPTest\Services\ClientBService;

/**
 * Factory to help crient the proper clients
 * */
class ClientFactory
{
    /**
     * Automatically create the appropriate client for use
     */
    public static function createClient(string $accountId)
    {
        switch ($accountId) {
            case '456':
                return new ClientAService;
            case '556':
                return new ClientBService;
            default:
                throw new Exception('Account type not recognized');
        }
    }
}

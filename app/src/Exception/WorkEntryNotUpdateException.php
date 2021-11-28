<?php

namespace App\Exception;

use Exception;

class WorkEntryNotUpdateException  extends Exception
{
    /**
     * @throws WorkEntryNotUpdateException
     */
    public static function throwException(string $message = null)
    {
        throw new self(sprintf('Error, WorkEntry not updated (%s)', $message));
    }
}
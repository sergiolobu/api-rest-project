<?php

namespace App\Exception;

use Exception;

class WorkEntryNotRemoveException  extends Exception
{
    /**
     * @throws WorkEntryNotRemoveException
     */
    public static function throwException(string $message = null)
    {
        throw new self(sprintf('Error, WorkEntry not remove (%s)', $message));
    }
}
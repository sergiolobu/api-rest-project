<?php

namespace App\Exception;

use Exception;

class WorkEntryNotCreatedException  extends Exception
{
    /**
     * @throws WorkEntryNotCreatedException
     */
    public static function throwException($message = null)
    {
        throw new self(sprintf('Error, WorkEntry not created (%s)', $message));
    }
}
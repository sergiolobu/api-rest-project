<?php

namespace App\Exception;

use Exception;

class WorkEntryNotFoundException extends Exception
{
    /**
     * @throws WorkEntryNotFoundException
     */
    public static function throwException()
    {
        throw new self('Work entry not found');
    }
}
<?php

namespace App\Exception;

use Exception;

class WorkEntryDatesInvalidException extends Exception
{
    /**
     * @throws WorkEntryDatesInvalidException
     */
    public static function throwException()
    {
        throw new self('Error (End Date is less than Start Date)');
    }
}
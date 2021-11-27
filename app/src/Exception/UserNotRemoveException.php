<?php

namespace App\Exception;

use Exception;

class UserNotRemoveException extends Exception
{
    /**
     * @throws UserNotRemoveException
     */
    public static function throwException(string $message)
    {
        throw new self(sprintf('Error, user not remove (%s)',$message));
    }
}
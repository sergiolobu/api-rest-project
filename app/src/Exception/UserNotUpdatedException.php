<?php

namespace App\Exception;

use Exception;

class UserNotUpdatedException extends Exception
{
    /**
     * @throws UserNotUpdatedException
     */
    public static function throwException(string $message)
    {
        throw new self(sprintf('Error, user not updated (%s)',$message));
    }
}
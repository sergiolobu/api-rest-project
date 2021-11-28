<?php

namespace App\Exception;

use Exception;

class UserNotFoundException extends Exception
{
    /**
     * @throws UserNotFoundException
     */
    public static function throwException()
    {
        throw new self('User not found');
    }
}
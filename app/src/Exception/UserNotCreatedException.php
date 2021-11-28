<?php

namespace App\Exception;

use Exception;

class UserNotCreatedException extends Exception
{
    /**
     * @throws UserNotCreatedException
     */
    public static function throwException()
    {
        throw new self('Error, user not created');
    }
}
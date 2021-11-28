<?php

namespace App\Service\User;

use App\Entity\User;
use App\Exception\UserNotRemoveException;
use App\Repository\UserRepository;

class DeleteUser
{
    const USER_DELETED_SUCCESS = 0;

    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke(User $user): int
    {
        try {
            $this->userRepository->delete($user);
        }catch (\Exception $exception){
            UserNotRemoveException::throwException($exception->getMessage());
        }

        return self::USER_DELETED_SUCCESS;
    }
}
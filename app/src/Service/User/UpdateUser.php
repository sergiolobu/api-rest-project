<?php

namespace App\Service\User;

use App\Entity\User;
use App\Exception\UserNotUpdatedException;
use App\Repository\UserRepository;

class UpdateUser
{
    const USER_UPDATED_SUCCESS = 0;

    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param User $user
     * @param string $name
     * @param string $email
     * @return int
     * @throws UserNotUpdatedException
     */
    public function __invoke(User $user, string $name, string $email): int
    {

        if ('' !== $email){
            $user->setEmail($email);
        }

        if ('' !== $name){
            $user->setName($name);
        }

        try {
            $this->userRepository->save($user);
        }catch (\Exception $exception){
            UserNotUpdatedException::throwException($exception->getMessage());
        }

        return self::USER_UPDATED_SUCCESS;
    }
}
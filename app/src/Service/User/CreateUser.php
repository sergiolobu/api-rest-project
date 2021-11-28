<?php

namespace App\Service\User;

use App\Entity\User;
use App\Exception\UserNotCreatedException;
use App\Repository\UserRepository;

class CreateUser
{
    const USER_CREATED_SUCCESS = 0;

    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    /**
     * @param string $name
     * @param string $email
     * @return int
     * @throws UserNotCreatedException
     */
    public function __invoke(string $name, string $email): int
    {
        $user = new User();
        $user->setEmail($email);
        $user->setName($name);

        try {
            $this->userRepository->save($user);
        }catch (\Exception $exception){
            UserNotCreatedException::throwException();
        }

        return self::USER_CREATED_SUCCESS;
    }
}
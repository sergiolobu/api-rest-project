<?php

namespace App\Service\User;

use App\Entity\User;
use App\Exception\UserNotFoundException;
use App\Repository\UserRepository;

class GetUser
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @throws UserNotFoundException
     */
    public function __invoke(string $id): User
    {
        $user = $this->userRepository->findOneBy(['id' => $id]);

        if (!$user) {
            UserNotFoundException::throwException();
        }

        return $user;
    }
}
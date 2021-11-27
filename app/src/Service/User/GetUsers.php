<?php

namespace App\Service\User;

use App\Entity\User;
use App\Repository\UserRepository;
use UserNotFoundException;

class GetUsers
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke(): array
    {
        return $this->userRepository->findAll();
    }
}
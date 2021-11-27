<?php

namespace App\Service\User;

use App\Entity\User;

class UserToArrayTransformer
{
    public function get(User $user): array
    {
        return [
            'id' => $user->getId(),
            'name' => $user->getName(),
            'email' => $user->getEmail()
        ];
    }
}
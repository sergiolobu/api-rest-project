<?php

namespace App\Controller\User;

use App\Service\User\GetUsers;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GetAllUserController extends AbstractController
{
    /**
     * @Route("/users", name="all_user", methods={"GET"})
     */
    public function getUsersAction(GetUsers $getAllUsers): JsonResponse
    {
        $users = ($getAllUsers)();

        $data = [];

        foreach ($users as $user)
        {
            $data[] = $user->toArray();
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }

}
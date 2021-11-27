<?php

namespace App\Controller\User;

use App\Service\User\GetUser;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class GetUserController extends AbstractController
{
    /**
     * @Route("/user/{id}", name="get_user", methods={"GET"})
     */
    public function getAction(string $id, GetUser $getUser): JsonResponse
    {
        try {
            $user = ($getUser)($id);
        }catch (Exception $exception){
            return new JsonResponse(['status' => $exception->getMessage()], Response::HTTP_NOT_FOUND);
        }

        $userArray = $user->toArray();

        return new JsonResponse($userArray, Response::HTTP_OK);
    }
}
<?php

namespace App\Controller\User;

use App\Service\User\DeleteUser;
use App\Service\User\GetUser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeleteUserController extends AbstractController
{
    /**
     * @Route("/user/{id}", name="delete_user", methods={"DELETE"})
     */
    public function deleteAction(string $id, GetUser $getUser, DeleteUser $deleteUser): JsonResponse
    {
        try {
            $user = ($getUser)($id);

            ($deleteUser)($user);
        }catch (\Exception $exception){
            return new JsonResponse(['status' => $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new JsonResponse(['status' => 'user delete'], Response::HTTP_OK);
    }
}
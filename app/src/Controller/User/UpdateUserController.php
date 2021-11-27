<?php

namespace App\Controller\User;

use App\Service\User\GetUser;
use App\Service\User\UpdateUser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UpdateUserController extends AbstractController
{
    /**
     * @Route("/user/{id}", name="edit_user", methods={"PUT"})
     */
    public function updateAction(Request $request, string $id, GetUser $getUser, UpdateUser $updateUser): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $name = $data['name'] ?? '';
        $email = $data['email'] ?? '';;

        try {
            $user = ($getUser)($id);

            ($updateUser)($user,$name,$email);
        }catch (\Exception $exception){
            return new JsonResponse(['status' => $exception->getMessage()], Response::HTTP_NOT_MODIFIED);
        }

        return new JsonResponse(['status' => 'user update'], Response::HTTP_CREATED);
    }
}
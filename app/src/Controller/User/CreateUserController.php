<?php

namespace App\Controller\User;

use App\Service\User\CreateUser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreateUserController extends AbstractController
{
    /**
     * @Route("/user", name="create_user", methods={"POST"})
     */
    public function createAction(Request $request, CreateUser $createUser): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $name = $data['name'];
        $email = $data['email'];

        try {
            ($createUser)($name,$email);
        }catch (\Exception $exception){
            return new JsonResponse(['status' => $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new JsonResponse(['status' => 'user created'], Response::HTTP_CREATED);
    }
}
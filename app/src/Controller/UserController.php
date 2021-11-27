<?php
namespace App\Controller;

use App\Repository\UserRepository;
use App\Service\User\GetUsers;
use App\Service\User\GetUser;
use App\Service\User\UserToArrayTransformer;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class UserController extends AbstractController
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @var UserToArrayTransformer
     */
    protected $userToArrayTransformer;

    public function __construct(UserRepository $userRepository, UserToArrayTransformer $userToArrayTransformer)
    {
        $this->userRepository = $userRepository;
        $this->userToArrayTransformer = $userToArrayTransformer;
    }

    /**
     * @Route("/get/users", name="all_user", methods={"GET"})
     */
    public function getUsersAction(GetUsers $getAllUsers): JsonResponse
    {
        $users = ($getAllUsers)();

        $data = [];

        foreach ($users as $user)
        {
            $data[] = $this->userToArrayTransformer->get($user);
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }


    /**
     * @Route("/get/user/{id}", name="get_user", methods={"GET"})
     */
    public function getAction(string $id, GetUser $getUser): JsonResponse
    {
        try {
            $user = ($getUser)($id);
        }catch (Exception $exception){
            return new JsonResponse(['status' => $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $userArray = $this->userToArrayTransformer->get($user);

        return new JsonResponse($userArray, Response::HTTP_OK);
    }


    /**
     * @Route("/create/user", name="create_user", methods={"POST"})
     */
    public function createAction(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $name = $data['name'];
        $email = $data['email'];

        try {
            $this->userRepository->save($name,$email);
        }catch (\Exception $exception){
            return new JsonResponse(['status' => $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new JsonResponse(['status' => 'user created'], Response::HTTP_CREATED);
    }

    /**
     * @Route("/edit/user/{id}", name="edit_user", methods={"PUT"})
     */
    public function updateAction(Request $request, string $id, GetUser $getUser): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $name = $data['name'] ?? null;
        $email = $data['email'] ?? null;

        try {
            $user = ($getUser)($id);

            $this->userRepository->update($user,$name,$email);
        }catch (\Exception $exception){
            return new JsonResponse(['status' => $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new JsonResponse(['status' => 'user update'], Response::HTTP_CREATED);
    }

    /**
     * @Route("/delete/user/{id}", name="delete_user", methods={"DELETE"})
     */
    public function deleteAction(string $id, GetUser $getUser): JsonResponse
    {
        try {
            $user = ($getUser)($id);

            $this->userRepository->delete($user);
        }catch (\Exception $exception){
            return new JsonResponse(['status' => $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new JsonResponse(['status' => 'user delete'], Response::HTTP_CREATED);
    }

}
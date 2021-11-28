<?php

namespace App\Controller\WorkEntry;

use App\Service\User\GetUser;
use App\Service\WorkEntry\CreateWorkEntry;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreateWorkEntryController extends AbstractController
{
    /**
     * @Route("/workentry", name="create_workentry", methods={"POST"})
     */
    public function createAction(Request $request, GetUser $getUser, CreateWorkEntry $createWorkEntry): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        try {
            $user = ($getUser)($data['user_id']);
            $dateStart = $data['startDate'];
            $dateEnd = $data['endDate'];

            ($createWorkEntry)($user,$dateStart, $dateEnd);
        } catch (Exception $exception) {
            return new JsonResponse(['status' => $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new JsonResponse(['status' => 'work entry created'], Response::HTTP_CREATED);
    }
}
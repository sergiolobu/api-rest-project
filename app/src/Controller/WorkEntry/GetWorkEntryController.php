<?php

namespace App\Controller\WorkEntry;

use App\Service\WorkEntry\GetWorkEntry;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GetWorkEntryController extends AbstractController
{
    /**
     * @Route("/workentry/{id}", name="get_workentry", methods={"GET"})
     */
    public function getWorkEntryByIdAction(string $id, GetWorkEntry $getWorkEntry): JsonResponse
    {
        try {
            $workEntry = ($getWorkEntry)($id);
        } catch (Exception $exception) {
            return new JsonResponse(['status' => $exception->getMessage()], Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse($workEntry->toArray(), Response::HTTP_OK);
    }
}
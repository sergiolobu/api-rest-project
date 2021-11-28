<?php

namespace App\Controller\WorkEntry;

use App\Service\WorkEntry\DeleteWorkEntry;
use App\Service\WorkEntry\GetWorkEntry;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeleteWorkEntryController extends AbstractController
{
    /**
     * @Route("/workentry/{id}", name="delete_workentry", methods={"DELETE"})
     */
    public function deleteAction(string $id, GetWorkEntry $getWorkEntry, DeleteWorkEntry $deleteWorkEntry): JsonResponse
    {
        try {
            $workEntry = ($getWorkEntry)($id);
            ($deleteWorkEntry)($workEntry);
        } catch (Exception $exception) {
            return new JsonResponse(['status' => $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new JsonResponse(['status' => 'Work Entry delete'], Response::HTTP_OK);
    }
}
<?php

namespace App\Controller\WorkEntry;

use App\Service\WorkEntry\GetWorkEntry;
use App\Service\WorkEntry\UpdateWorkEntry;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UpdateWorkEntryController extends AbstractController
{
    /**
     * @Route("/workentry/{id}", name="update_workentry", methods={"PUT"})
     */
    public function updateAction(Request $request, int $id, GetWorkEntry $getWorkEntry, UpdateWorkEntry $updateWorkEntry): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $endDate = $data['endDate'] ?? '';
        $startDate = $data['startDate'] ?? '';

        try {
            $workEntry = ($getWorkEntry)($id);
            ($updateWorkEntry)($workEntry, $startDate, $endDate);
        } catch (Exception $exception) {
            return new JsonResponse(['status' => $exception->getMessage()], Response::HTTP_NOT_MODIFIED);
        }

        return new JsonResponse(['status' => 'work entry update'], Response::HTTP_CREATED);
    }
}
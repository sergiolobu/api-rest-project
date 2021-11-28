<?php

namespace App\Controller\WorkEntry;

use App\Service\WorkEntry\GetWorkEntriesByUserId;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GetWorkEntryByUserController extends AbstractController
{
    /**
     * @Route("/workentry/user/{user}", name="get_workentry_by_user_id", methods={"GET"})
     */
    public function getWorkEntryByUserIdAction(string $user, GetWorkEntriesByUserId $getWorkEntriesByUserId): JsonResponse
    {
        $workEntries = ($getWorkEntriesByUserId)($user);

        $workEntryArray = [];

        foreach ($workEntries as $workEntry)
        {
            $workEntryArray[] = $workEntry->toArray();
        }

        return new JsonResponse($workEntryArray, Response::HTTP_OK);
    }
}
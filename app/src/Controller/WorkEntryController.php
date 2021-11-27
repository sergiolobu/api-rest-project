<?php

namespace App\Controller;

use App\Repository\WorkEntryRepository;
use App\Service\User\GetUser;
use App\Service\WorkEntry\GetWorkEntry;
use App\Service\WorkEntry\GetWorkEntriesByUserId;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use WorkEntryNotFoundException;

class WorkEntryController extends AbstractController
{
    /**
     * @var WorkEntryRepository
     */
    protected $workEntryRepository;

    public function __construct(WorkEntryRepository $workEntryRepository)
    {
        $this->workEntryRepository = $workEntryRepository;
    }

    /**
     * @Route("/get/workentry/{id}", name="get_workentry", methods={"GET"})
     * @throws WorkEntryNotFoundException
     */
    public function getWorkEntryByIdAction(string $id, GetWorkEntry $getWorkEntry): JsonResponse
    {
        $workEntry = ($getWorkEntry)($id);

        $data = [
            'id' => $workEntry->getId(),
            'userId' => $workEntry->getUser()->getId(),
            'startAt' => $workEntry->getStartDate()->format('Y-m-d H:i:s'),
            'endAt' => $workEntry->getEndDate()->format('Y-m-d H:i:s'),
        ];

        return new JsonResponse($data, Response::HTTP_OK);;
    }

    /**
     * @Route("/get/workentry/user/{user}", name="get_workentry_by_user_id", methods={"GET"})
     * @throws WorkEntryNotFoundException
     */
    public function getWorkEntryByUserIdAction(string $user, GetWorkEntriesByUserId $getWorkEntriesByUserId): JsonResponse
    {
        $workEntry = ($getWorkEntriesByUserId)($user);

        $data = [];

        foreach ($workEntry as $item)
        {
            $data[] = [
                'id' => $item->getId(),
                'userId' => $item->getUser()->getId(),
                'startAt' => $item->getStartDate()->format('Y-m-d H:i:s'),
                'endAt' => $item->getEndDate()->format('Y-m-d H:i:s'),
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);;
    }


    /**
     * @Route("/create/workentry", name="create_workentry", methods={"POST"})
     */
    public function createAction(Request $request, GetUser $getUser): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        try {
            $user = ($getUser)($data['user_id']);
            $dateStart = $data['startDate'];
            $dateEnd = $data['endDate'];

            $this->workEntryRepository->save($user,$dateStart,$dateEnd);
        }catch (\Exception $exception){
            return new JsonResponse(['status' => $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new JsonResponse(['status' => 'work entry created'], Response::HTTP_CREATED);
    }

    /**
     * @Route("/edit/workentry/{id}", name="update_workentry", methods={"PUT"})
     */
    public function updateAction(Request $request, string $id, GetWorkEntry $getWorkEntry): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $endDate = $data['endDate'] ?? null;
        $startDate = $data['startDate'] ?? null;


        try {
            $workEntry = ($getWorkEntry)($id);

            $this->workEntryRepository->update($workEntry,$endDate,$startDate);
        }catch (\Exception $exception){
            return new JsonResponse(['status' => $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new JsonResponse(['status' => 'user update'], Response::HTTP_CREATED);
    }

    /**
     * @Route("/delete/workentry/{id}", name="delete_workentry", methods={"DELETE"})
     */
    public function deleteAction(string $id): JsonResponse
    {
        $workEntry = $this->workEntryRepository->findOneBy(['id' => $id]);

        if (!$workEntry){
            return new JsonResponse(['status' => 'Work Entry not found'], Response::HTTP_BAD_REQUEST);
        }

        try {
            $this->workEntryRepository->delete($workEntry);
        }catch (\Exception $exception){
            return new JsonResponse(['status' => $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new JsonResponse(['status' => 'Work Entry delete'], Response::HTTP_CREATED);
    }
}
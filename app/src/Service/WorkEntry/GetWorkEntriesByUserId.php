<?php
namespace App\Service\WorkEntry;

use App\Entity\WorkEntry;
use App\Repository\WorkEntryRepository;
use WorkEntryNotFoundException;

class GetWorkEntriesByUserId
{
    /**
     * @var WorkEntryRepository
     */
    private $workEntryRepository;

    public function __construct(WorkEntryRepository $workEntryRepository)
    {
        $this->workEntryRepository = $workEntryRepository;
    }

    /**
     * @throws WorkEntryNotFoundException
     */
    public function __invoke(string $userId): array
    {
        $workEntry = $this->workEntryRepository->findBy(['user' => $userId]);

        if (!$workEntry) {
            WorkEntryNotFoundException::throwException();
        }

        return $workEntry;
    }
}
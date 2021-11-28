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
    private WorkEntryRepository $workEntryRepository;

    public function __construct(WorkEntryRepository $workEntryRepository)
    {
        $this->workEntryRepository = $workEntryRepository;
    }

    public function __invoke(string $userId): array
    {
        return $this->workEntryRepository->findBy(['user' => $userId]);
    }
}
<?php
namespace App\Service\WorkEntry;

use App\Entity\WorkEntry;
use App\Repository\WorkEntryRepository;
use WorkEntryNotFoundException;

class GetWorkEntry
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
    public function __invoke(string $id): WorkEntry
    {
        $workEntry = $this->workEntryRepository->findOneBy(['id' => $id]);

        if (!$workEntry) {
            WorkEntryNotFoundException::throwException();
        }

        return $workEntry;
    }
}
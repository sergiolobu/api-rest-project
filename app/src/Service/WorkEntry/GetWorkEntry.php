<?php
namespace App\Service\WorkEntry;

use App\Entity\WorkEntry;
use App\Exception\WorkEntryNotFoundException;
use App\Repository\WorkEntryRepository;

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
     * @param string $id
     * @return WorkEntry
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
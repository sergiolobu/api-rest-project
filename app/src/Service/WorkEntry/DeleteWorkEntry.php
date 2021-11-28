<?php

namespace App\Service\WorkEntry;

use App\Entity\WorkEntry;
use App\Exception\WorkEntryNotRemoveException;
use App\Repository\WorkEntryRepository;
use Doctrine\ORM\OptimisticLockException;
use Exception;

class DeleteWorkEntry
{
    const WORK_ENTRY_DELETED_SUCCESS = 0;

    /**
     * @var WorkEntryRepository
     */
    private WorkEntryRepository $workEntryRepository;

    public function __construct(WorkEntryRepository $workEntryRepository)
    {
        $this->workEntryRepository = $workEntryRepository;
    }

    /**
     * @param WorkEntry $workEntry
     * @return int
     * @throws WorkEntryNotRemoveException
     */
    public function __invoke(WorkEntry $workEntry): int
    {
        try {
            $this->workEntryRepository->delete($workEntry);
        }catch (Exception $exception){
            WorkEntryNotRemoveException::throwException($exception->getMessage());
        }

        return self::WORK_ENTRY_DELETED_SUCCESS;
    }
}
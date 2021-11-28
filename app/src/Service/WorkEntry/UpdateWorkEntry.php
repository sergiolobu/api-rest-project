<?php

namespace App\Service\WorkEntry;

use App\Entity\WorkEntry;
use App\Exception\WorkEntryNotUpdateException;
use App\Repository\WorkEntryRepository;
use DateTime;
use Doctrine\ORM\OptimisticLockException;
use Exception;

class UpdateWorkEntry
{
    const WORK_ENTRY_UPDATED_SUCCESS = 0;

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
     * @param string $startDate
     * @param string $endDate
     * @return int
     * @throws WorkEntryNotUpdateException
     * @throws Exception
     */
    public function __invoke(WorkEntry $workEntry, string $startDate, string $endDate): int
    {
        if ('' !== $startDate){
            $workEntry->setStartDate(new DateTime($startDate));
        }

        if ('' !== $endDate){
            $workEntry->setEndDate(new DateTime($endDate));
        }

        try {
            $this->workEntryRepository->save($workEntry);
        }catch (Exception $exception){
            WorkEntryNotUpdateException::throwException($exception->getMessage());
        }

        return self::WORK_ENTRY_UPDATED_SUCCESS;

    }
}
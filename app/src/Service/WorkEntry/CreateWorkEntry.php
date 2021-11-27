<?php

namespace App\Service\WorkEntry;

use App\Entity\User;
use App\Entity\WorkEntry;
use App\Exception\WorkEntryNotCreatedException;
use App\Repository\WorkEntryRepository;
use DateTime;
use Exception;

class CreateWorkEntry
{
    const WORK_ENTRY_CREATED_SUCCESS = 0;

    /**
     * @var WorkEntryRepository
     */
    private WorkEntryRepository $workEntryRepository;

    public function __construct(WorkEntryRepository $workEntryRepository)
    {
        $this->workEntryRepository = $workEntryRepository;
    }

    /**
     * @param User $user
     * @param string $startDate
     * @param string $endDate
     * @return int
     * @throws WorkEntryNotCreatedException
     * @throws Exception
     */
    public function __invoke(User $user, string $startDate, string $endDate): int
    {
        $workEntry = new WorkEntry();
        $workEntry->setUser($user);
        $workEntry->setStartDate(new DateTime($startDate));
        $workEntry->setEndDate(new DateTime($endDate));

        try {
            $this->workEntryRepository->save($workEntry);
        }catch (Exception $exception){
            WorkEntryNotCreatedException::throwException($exception->getMessage());
        }

        return self::WORK_ENTRY_CREATED_SUCCESS;
    }
}
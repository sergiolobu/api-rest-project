<?php
namespace App\Repository;

use App\Entity\User;
use App\Entity\WorkEntry;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\Persistence\ManagerRegistry;
use Exception;

class WorkEntryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WorkEntry::class);
    }

    /**
     * @throws OptimisticLockException
     * @throws Exception
     */
    public function save(User $user, $startDate, $endDate)
    {
        $workEntry = new WorkEntry();
        $workEntry->setUser($user);
        $workEntry->setStartDate(new DateTime($startDate));
        $workEntry->setEndDate(new DateTime($endDate));

        $this->getEntityManager()->persist($workEntry);
        $this->getEntityManager()->flush();
    }

    /**
     * @throws OptimisticLockException
     * @throws Exception
     */
    public function update(WorkEntry $workEntry, $startDate, $endDate)
    {
        if (null !== $startDate){
            $workEntry->setStartDate(new DateTime($startDate));
        }

        if (null !== $endDate){
            $workEntry->setEndDate(new DateTime($endDate));
        }

        $this->getEntityManager()->persist($workEntry);
        $this->getEntityManager()->flush();
    }

    /**
     * @throws OptimisticLockException
     * @throws Exception
     */
    public function delete(WorkEntry $workEntry)
    {
        $this->getEntityManager()->remove($workEntry);
        $this->getEntityManager()->flush();
    }
}
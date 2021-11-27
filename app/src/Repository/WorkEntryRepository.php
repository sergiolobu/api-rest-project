<?php
namespace App\Repository;

use App\Entity\WorkEntry;
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
    public function save(WorkEntry $workEntry)
    {
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
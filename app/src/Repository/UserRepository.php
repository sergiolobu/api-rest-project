<?php
namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function save($name, $email)
    {
        $user = new User();
        $user->setEmail($email);
        $user->setName($name);

        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }


    public function update(User $user, $name, $email)
    {
        if (null !== $email){
            $user->setEmail($email);
        }

        if (null !== $name){
            $user->setName($name);
        }

        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }

    public function delete(User $user)
    {
        $this->getEntityManager()->remove($user);
        $this->getEntityManager()->flush();
    }
}
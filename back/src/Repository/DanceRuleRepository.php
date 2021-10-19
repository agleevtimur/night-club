<?php

namespace App\Repository;

use App\Entity\DanceRule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DanceRule|null find($id, $lockMode = null, $lockVersion = null)
 * @method DanceRule|null findOneBy(array $criteria, array $orderBy = null)
 * @method DanceRule[]    findAll()
 * @method DanceRule[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DanceRuleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DanceRule::class);
    }
}

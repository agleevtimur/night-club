<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;

class EntityLiquidation
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function visitors(): void
    {
        $query = $this->entityManager->createQuery('DELETE FROM App\Entity\Visitor v');
        $query->execute();
    }

    public function danceRules(): void
    {
        $query = $this->entityManager->createQuery('DELETE FROM App\Entity\DanceRule dr');
        $query->execute();
    }
}
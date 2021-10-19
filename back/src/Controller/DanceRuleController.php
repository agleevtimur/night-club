<?php

namespace App\Controller;

use App\Entity\DanceRule;
use App\Service\EntityLiquidation;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DanceRuleController extends AbstractController implements TokenAuthenticatedController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function setDanceRules(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        foreach ($data as $danceRuleData) {
            $danceRule = new DanceRule(
                $danceRuleData['genre'],
                $danceRuleData['bodyRule'],
                $danceRuleData['handsRule'],
                $danceRuleData['legsRule'],
                $danceRuleData['headRule'],
                $danceRuleData['relations'] ?? null
            );
            $this->entityManager->persist($danceRule);
        }

        $this->entityManager->flush();

        return $this->json(null);
    }

    public function removeDanceRules(EntityLiquidation $entityLiquidation): JsonResponse
    {
        $entityLiquidation->danceRules();
        return $this->json(null);
    }
}
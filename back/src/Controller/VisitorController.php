<?php

namespace App\Controller;

use App\Entity\DanceRule;
use App\Entity\Visitor;
use App\Repository\DanceRuleRepository;
use App\Repository\VisitorRepository;
use App\Service\EntityLiquidation;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class VisitorController extends AbstractController implements TokenAuthenticatedController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function createVisitors(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        foreach ($data as $visitorData) {
            $visitor = new Visitor($visitorData['name'], $visitorData['genre']);
            $this->entityManager->persist($visitor);
        }

        $this->entityManager->flush();

        return $this->json(null);
    }

    public function getVisitors(
        Request $request,
        VisitorRepository $visitorRepository,
        DanceRuleRepository $danceRuleRepository
    ): JsonResponse
    {
        $genre = $request->get('genre');
        $visitors = $visitorRepository->findAll();
        $danceRules = $danceRuleRepository->findOneBy(['genre' => $genre]);
        $genres = [$genre, ...$danceRules->getRelations() ?? []];
        $result = ['dancing' => [], 'drinking' => []];

        foreach ($visitors as $visitor) {
            $role = array_intersect($visitor->getGenres(), $genres) === [] ? 'drinking' : 'dancing';
            $result[$role][] = ['name' => $visitor->getName()];
        }

        $result['danceRules'] = $danceRules;

        return $this->json($result);
    }

    public function removeVisitors(EntityLiquidation $entityLiquidation): JsonResponse
    {
        $entityLiquidation->visitors();
        return $this->json(null);
    }
}
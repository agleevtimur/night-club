<?php

namespace App\Entity;

use App\Repository\DanceRuleRepository;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * @ORM\Entity(repositoryClass=DanceRuleRepository::class)
 */
class DanceRule implements JsonSerializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column (type="string")
     */
    private string $genre;

    /**
     * @ORM\Column (type="string")
     */
    private string $bodyRule;

    /**
     * @ORM\Column (type="string")
     */
    private string $handsRule;

    /**
     * @ORM\Column (type="string")
     */
    private string $legsRule;

    /**
     * @ORM\Column (type="string")
     */
    private string $headRule;

    /**
     * @ORM\Column (type="json", nullable=true, options={"jsonb":true, "default": null})
     */
    private ?array $relations;

    public function __construct(string $genre, string $bodyRule, string $handsRule, string $legsRule, string $headRule, ?array $relations)
    {
        $this->genre = $genre;
        $this->bodyRule = $bodyRule;
        $this->handsRule = $handsRule;
        $this->legsRule = $legsRule;
        $this->headRule = $headRule;
        $this->relations = $relations;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGenre(): string
    {
        return $this->genre;
    }

    public function getBodyRule(): string
    {
        return $this->bodyRule;
    }

    public function getHandsRule(): string
    {
        return $this->handsRule;
    }

    public function getLegsRule(): string
    {
        return $this->legsRule;
    }

    public function getHeadRule(): string
    {
        return $this->headRule;
    }

    public function getRelations(): ?array
    {
        return $this->relations;
    }

    public function jsonSerialize(): array
    {
        return [
            'body' => $this->bodyRule,
            'head' => $this->headRule,
            'hands' => $this->handsRule,
            'legs' => $this->legsRule
        ];
    }
}

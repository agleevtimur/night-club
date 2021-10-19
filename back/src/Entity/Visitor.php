<?php

namespace App\Entity;

use App\Repository\VisitorRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VisitorRepository::class)
 */
class Visitor
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string")
     */
    private string $name;

    /**
     * @ORM\Column (type="json", options={"jsonb":true})
     */
    private array $genres;

    public function __construct(string $name, array $genres)
    {
        $this->name = $name;
        $this->genres = $genres;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGenres(): array
    {
        return $this->genres;
    }

    public function getName(): string
    {
        return $this->name;
    }
}

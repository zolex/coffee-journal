<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Doctrine\Orm\Filter\RangeFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\JournalRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: JournalRepository::class)]
#[ApiResource]
#[ApiFilter(SearchFilter::class, properties: [
    'type' => 'exact',
    'coffee' => 'exact',
    'rating' => 'exact'
])]
#[ApiFilter(RangeFilter::class, properties: [
    'rating.value'
])]
#[ApiFilter(OrderFilter::class, properties: [
    'type.name' => 'ASC',
    'coffee.name' => 'ASC',
    'rating.value' => 'DESC',
])]
class Journal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'journals')]
    #[ORM\JoinColumn(nullable: false)]
    private CoffeeType $type;

    #[ORM\ManyToOne(inversedBy: 'journals')]
    #[ORM\JoinColumn(nullable: false)]
    private Coffee $coffee;

    #[ORM\ManyToOne(inversedBy: 'journals')]
    #[ORM\JoinColumn(nullable: false)]
    private Rating $rating;

    #[Assert\NotBlank]
    #[Assert\Type(['string', 'float', 'integer'])]
    #[Assert\Range(min: 0.1, max: 100.0)]
    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private string $powderWeight;

    #[Assert\NotBlank]
    #[Assert\Type(['string', 'float', 'integer'])]
    #[Assert\Range(min: 0.1, max: 500.0)]
    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private string $brewedWeight;

    #[Assert\NotBlank]
    #[Assert\Type(['string', 'float', 'integer'])]
    #[Assert\Range(min: 1.0, max: 15.0)]
    #[ORM\Column(type: Types::DECIMAL, precision: 4, scale: 2)]
    private string $pressure;

    #[Assert\NotBlank]
    #[Assert\Type(['string', 'float', 'integer'])]
    #[Assert\Range(min: 1.0, max: 50.0)]
    #[ORM\Column(type: Types::DECIMAL, precision: 4, scale: 2)]
    private string $duration;

    #[Assert\NotBlank]
    #[Assert\Type(['string', 'float', 'integer'])]
    #[Assert\Range(min: 70, max: 100)]
    #[ORM\Column]
    private int $temperature;

    #[Assert\NotBlank]
    #[Assert\Type(['string', 'float', 'integer'])]
    #[Assert\Range(min: 1, max: 100.0)]
    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private string $grindLevel;

    #[Assert\NotBlank]
    #[Assert\Type(['string', 'float', 'integer'])]
    #[Assert\Range(min: 1, max: 100.0)]
    #[ORM\Column(type: Types::DECIMAL, precision: 4, scale: 2)]
    private string $grindDuration;

    #[Assert\NotBlank]
    #[Assert\Type(\DateTimeImmutable::class)]
    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private \DateTimeImmutable $date;

    #[Assert\Type(['string', 'float', 'integer'])]
    #[Assert\Range(min: 0, max: 1000)]
    #[ORM\Column(nullable: true)]
    private ?int $beanAge = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    #[ApiProperty(iris: ["https://schema.org/name"])]
    public function getLabel(): string
    {
        return sprintf("%s #%d", $this->coffee->getFullName(), $this->id);
    }

    public function getCoffee(): Coffee
    {
        return $this->coffee;
    }

    public function setCoffee(Coffee $coffee): static
    {
        $this->coffee = $coffee;

        return $this;
    }

    public function getPowderWeight(): string
    {
        return $this->powderWeight;
    }

    public function setPowderWeight(string $powderWeight): static
    {
        $this->powderWeight = $powderWeight;

        return $this;
    }

    public function getBrewedWeight(): string
    {
        return $this->brewedWeight;
    }

    public function setBrewedWeight(string $brewedWeight): static
    {
        $this->brewedWeight = $brewedWeight;

        return $this;
    }

    public function getRatio(): string
    {
        return sprintf("1/%01.2f", (float)$this->brewedWeight / (float)$this->powderWeight);
    }

    public function getPressure(): string
    {
        return $this->pressure;
    }

    public function setPressure(string $pressure): static
    {
        $this->pressure = $pressure;

        return $this;
    }

    public function getDuration(): string
    {
        return $this->duration;
    }

    public function setDuration(string $duration): static
    {
        $this->duration = $duration;

        return $this;
    }

    public function getTemperature(): int
    {
        return $this->temperature;
    }

    public function setTemperature(int $temperature): static
    {
        $this->temperature = $temperature;

        return $this;
    }

    public function getGrindLevel(): string
    {
        return $this->grindLevel;
    }

    public function setGrindLevel(string $grindLevel): static
    {
        $this->grindLevel = $grindLevel;

        return $this;
    }

    public function getGrindDuration(): string
    {
        return $this->grindDuration;
    }

    public function setGrindDuration(string $grindDuration): static
    {
        $this->grindDuration = $grindDuration;

        return $this;
    }

    public function getDate(): ?\DateTimeImmutable
    {
        return $this->date;
    }

    public function setDate(string|\DateTimeImmutable $date): static
    {
        $this->date = \is_string($date) ? \DateTimeImmutable($date) : $date;

        return $this;
    }

    public function getBeanAge(): ?int
    {
        return $this->beanAge;
    }

    public function setBeanAge(?int $beanAge): static
    {
        $this->beanAge = $beanAge;

        return $this;
    }

    public function getType(): CoffeeType
    {
        return $this->type;
    }

    public function setType(CoffeeType $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getRating(): ?Rating
    {
        return $this->rating;
    }

    public function setRating(?Rating $rating): static
    {
        $this->rating = $rating;

        return $this;
    }
}

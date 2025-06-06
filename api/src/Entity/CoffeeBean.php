<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\CoffeeBeanRepository;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Constraints\Range;

#[ORM\Entity(repositoryClass: CoffeeBeanRepository::class)]
#[ApiResource(order: [
    'coffee.roaster' => 'ASC',
    'coffee.name' => 'ASC',
    'type.name' => 'ASC'
])]
class CoffeeBean
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'beans')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Coffee $coffee;

    #[ORM\ManyToOne(inversedBy: 'beans')]
    #[ORM\JoinColumn(nullable: false)]
    private BeanType $type;

    #[ORM\Column]
    #[NotBlank]
    #[Type(type: 'integer')]
    #[Range(min: 1, max: 100)]
    private ?int $percent = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    #[ApiProperty(iris: ["https://schema.org/name"])]
    #[Groups('hidden')]
    public function getLabel(): string
    {
        return sprintf("%s: %d%%", $this->getType()->getName()->value, $this->percent);
    }

    public function getCoffee(): ?Coffee
    {
        return $this->coffee;
    }

    public function setCoffee(?Coffee $coffee): static
    {
        $this->coffee = $coffee;

        return $this;
    }

    public function getType(): BeanType
    {
        return $this->type;
    }

    public function setType(BeanType $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getPercent(): ?int
    {
        return $this->percent;
    }

    public function setPercent(int $percent): static
    {
        $this->percent = $percent;

        return $this;
    }
}

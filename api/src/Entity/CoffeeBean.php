<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ApiResource(
    normalizationContext: ['groups' => ['coffee_bean:read']],
    order: [
    'coffee.roaster' => 'ASC',
    'coffee.name' => 'ASC',
    'type.name' => 'ASC'
])]
class CoffeeBean
{
    #[Groups(['coffee_bean:read', 'coffee:read'])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotNull]
    #[Groups(['coffee_bean:read', 'coffee:write'])]
    #[ORM\ManyToOne(inversedBy: 'beans')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Coffee $coffee;

    #[Assert\NotNull]
    #[Groups(['coffee_bean:read', 'coffee:read', 'coffee:write'])]
    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private BeanType $type;

    #[Assert\NotBlank]
    #[Assert\Type(type: 'integer')]
    #[Assert\Range(min: 1, max: 100)]
    #[Groups(['coffee_bean:read', 'coffee:read', 'coffee:write'])]
    #[ORM\Column]
    private ?int $percent = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    #[ApiProperty(iris: ["https://schema.org/name"])]
    #[Groups(['coffee_bean:read', 'coffee:read'])]
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

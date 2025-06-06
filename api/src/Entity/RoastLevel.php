<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use App\Config\RoastLevel as RoastLevelEnum;
use App\Repository\RoastLevelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: RoastLevelRepository::class)]
#[ApiResource]
class RoastLevel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ApiProperty(iris: ["https://schema.org/name"])]
    #[ORM\Column(enumType: RoastLevelEnum::class, options: ["default" => RoastLevelEnum::MEDIUM])]
    #[Assert\Choice(options: RoastLevelEnum::ARRAY)]
    private RoastLevelEnum $level = RoastLevelEnum::MEDIUM;

    /**
     * @var Collection<int, Coffee>
     */
    #[ORM\OneToMany(targetEntity: Coffee::class, mappedBy: 'roastLevel')]
    private Collection $coffees;

    public function __construct()
    {
        $this->coffees = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLevel(): RoastLevelEnum
    {
        return $this->level;
    }

    public function setLevel(RoastLevelEnum $level): static
    {
        $this->level = $level;

        return $this;
    }

    /**
     * @return Collection<int, Coffee>
     */
    public function getCoffees(): Collection
    {
        return $this->coffees;
    }

    public function addCoffee(Coffee $coffee): static
    {
        if (!$this->coffees->contains($coffee)) {
            $this->coffees->add($coffee);
            $coffee->setRoastLevel($this);
        }

        return $this;
    }

    public function removeCoffee(Coffee $coffee): static
    {
        if ($this->coffees->removeElement($coffee)) {
            // set the owning side to null (unless already changed)
            if ($coffee->getRoastLevel() === $this) {
                $coffee->setRoastLevel(null);
            }
        }

        return $this;
    }
}

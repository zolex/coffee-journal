<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ApiResource(order: [
    'country' => 'ASC'
])]
class Origin
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ApiProperty(iris: ["https://schema.org/name"])]
    #[ORM\Column(length: 255)]
    private ?string $country = null;

    /**
     * @var Collection<int, Coffee>
     */
    #[ORM\ManyToMany(targetEntity: Coffee::class, mappedBy: 'origin')]
    private Collection $coffees;

    /**
     * @var Collection<int, Roaster>
     */
    #[ORM\ManyToMany(targetEntity: Roaster::class, mappedBy: 'origin')]
    private Collection $roasters;

    public function __construct()
    {
        $this->coffees = new ArrayCollection();
        $this->roasters = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): static
    {
        $this->country = $country;

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
            $coffee->addOrigin($this);
        }

        return $this;
    }

    public function removeCoffee(Coffee $coffee): static
    {
        if ($this->coffees->removeElement($coffee)) {
            $coffee->removeOrigin($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Roaster>
     */
    public function getRoasters(): Collection
    {
        return $this->roasters;
    }

    public function addRoaster(Roaster $roaster): static
    {
        if (!$this->roasters->contains($roaster)) {
            $this->roasters->add($roaster);
            $roaster->addOrigin($this);
        }

        return $this;
    }

    public function removeRoaster(Roaster $roaster): static
    {
        if ($this->roasters->removeElement($roaster)) {
            $roaster->removeOrigin($this);
        }

        return $this;
    }
}

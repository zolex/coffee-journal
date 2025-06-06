<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\RoasterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoasterRepository::class)]
#[ApiResource]
class Roaster
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ApiProperty(iris: ["https://schema.org/name"])]
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, Origin>
     */
    #[ORM\ManyToMany(targetEntity: Origin::class, inversedBy: 'roasters')]
    private Collection $origin;

    #[ORM\Column(length: 255)]
    private ?string $city = null;

    #[ORM\Column(nullable: true)]
    private ?int $rating = null;

    /**
     * @var Collection<int, Coffee>
     */
    #[ORM\OneToMany(targetEntity: Coffee::class, mappedBy: 'roaster')]
    private Collection $coffees;

    public function __construct()
    {
        $this->coffees = new ArrayCollection();
        $this->origin = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(?int $rating): static
    {
        $this->rating = $rating;

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
            $coffee->setRoaster($this);
        }

        return $this;
    }

    public function removeCoffee(Coffee $coffee): static
    {
        if ($this->coffees->removeElement($coffee)) {
            // set the owning side to null (unless already changed)
            if ($coffee->getRoaster() === $this) {
                $coffee->setRoaster(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Origin>
     */
    public function getOrigin(): Collection
    {
        return $this->origin;
    }

    public function addOrigin(Origin $origin): static
    {
        if (!$this->origin->contains($origin)) {
            $this->origin->add($origin);
        }

        return $this;
    }

    public function removeOrigin(Origin $origin): static
    {
        $this->origin->removeElement($origin);

        return $this;
    }
}

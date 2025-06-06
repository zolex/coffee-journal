<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\RatingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RatingRepository::class)]
#[ApiResource]
class Rating
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ApiProperty(iris: ["https://schema.org/name"])]
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $value = null;

    /**
     * @var Collection<int, Journal>
     */
    #[ORM\OneToMany(targetEntity: Journal::class, mappedBy: 'rating')]
    private Collection $journals;

    /**
     * @var Collection<int, Roaster>
     */
    #[ORM\OneToMany(targetEntity: Roaster::class, mappedBy: 'rating')]
    private Collection $roasters;

    /**
     * @var Collection<int, Coffee>
     */
    #[ORM\OneToMany(targetEntity: Coffee::class, mappedBy: 'rating')]
    private Collection $coffees;

    public function __construct()
    {
        $this->journals = new ArrayCollection();
        $this->roasters = new ArrayCollection();
        $this->coffees = new ArrayCollection();
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

    public function getValue(): ?int
    {
        return $this->value;
    }

    public function setValue(int $value): static
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return Collection<int, Journal>
     */
    public function getJournals(): Collection
    {
        return $this->journals;
    }

    public function addJournal(Journal $journal): static
    {
        if (!$this->journals->contains($journal)) {
            $this->journals->add($journal);
            $journal->setRating($this);
        }

        return $this;
    }

    public function removeJournal(Journal $journal): static
    {
        if ($this->journals->removeElement($journal)) {
            // set the owning side to null (unless already changed)
            if ($journal->getRating() === $this) {
                $journal->setRating(null);
            }
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
            $roaster->setRating($this);
        }

        return $this;
    }

    public function removeRoaster(Roaster $roaster): static
    {
        if ($this->roasters->removeElement($roaster)) {
            // set the owning side to null (unless already changed)
            if ($roaster->getRating() === $this) {
                $roaster->setRating(null);
            }
        }

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
            $coffee->setRating($this);
        }

        return $this;
    }

    public function removeCoffee(Coffee $coffee): static
    {
        if ($this->coffees->removeElement($coffee)) {
            // set the owning side to null (unless already changed)
            if ($coffee->getRating() === $this) {
                $coffee->setRating(null);
            }
        }

        return $this;
    }
}

<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\CoffeeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CoffeeRepository::class)]
#[ApiResource]
#[ApiFilter(SearchFilter::class, properties: [
    'roaster' => 'exact',
    'name' => 'ipartial',
    'beans' => 'exact',
    'beans.type' => 'exact',
    'beans.type.name' => 'exact',
    'roastLevel' => 'exact',
])]
#[ApiFilter(OrderFilter::class, properties: [
    'roaster' => 'ASC',
    'name' => 'ASC',
    'roastLevel' => 'ASC',
])]
class Coffee
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'coffees')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Roaster $roaster = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, CoffeeBean>
     */
    #[ORM\OneToMany(targetEntity: CoffeeBean::class, mappedBy: 'coffee', orphanRemoval: true)]
    private Collection $beans;

    /**
     * @var Collection<int, Origin>
     */
    #[ORM\ManyToMany(targetEntity: Origin::class, inversedBy: 'coffees')]
    private Collection $origin;

    #[ORM\ManyToOne(inversedBy: 'coffees')]
    #[ORM\JoinColumn(nullable: true)]
    private ?RoastLevel $roastLevel = null;

    /**
     * @var Collection<int, Journal>
     */
    #[ORM\OneToMany(targetEntity: Journal::class, mappedBy: 'coffee', orphanRemoval: true)]
    private Collection $journals;

    #[ORM\ManyToOne(inversedBy: 'coffees')]
    private ?Rating $rating = null;

    public function __construct()
    {
        $this->beans = new ArrayCollection();
        $this->origin = new ArrayCollection();
        $this->journals = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoaster(): ?Roaster
    {
        return $this->roaster;
    }

    public function setRoaster(?Roaster $roaster): static
    {
        $this->roaster = $roaster;

        return $this;
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

    #[ApiProperty(iris: ["https://schema.org/name"])]
    public function getFullName(): string
    {
        return sprintf("%s - %s", $this->roaster->getName(), $this->name);
    }

    /**
     * @return Collection<int, BeanType>
     */
    public function getBeans(): Collection
    {
        return $this->beans;
    }

    public function addBean(CoffeeBean $bean): static
    {
        if (!$this->beans->contains($bean)) {
            $this->beans->add($bean);
            $bean->setCoffee($this);
        }

        return $this;
    }

    public function removeBean(CoffeeBean $bean): static
    {
        if ($this->beans->removeElement($bean)) {
            // set the owning side to null (unless already changed)
            if ($bean->getCoffee() === $this) {
                $bean->setCoffee(null);
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

    public function getRoastLevel(): ?RoastLevel
    {
        return $this->roastLevel;
    }

    public function setRoastLevel(?RoastLevel $roastLevel): static
    {
        $this->roastLevel = $roastLevel;

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
            $journal->setCoffee($this);
        }

        return $this;
    }

    public function removeJournal(Journal $journal): static
    {
        if ($this->journals->removeElement($journal)) {
            // set the owning side to null (unless already changed)
            if ($journal->getCoffee() === $this) {
                $journal->setCoffee(null);
            }
        }

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

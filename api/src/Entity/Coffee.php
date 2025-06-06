<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use App\Config\RoastLevel;
use App\Repository\CoffeeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CoffeeRepository::class)]
#[ApiResource]
#[ApiFilter(SearchFilter::class, properties: [
    'roaster' => 'exact',
    'name' => 'ipartial',
    'beans.type.name' => 'exact',
    'beans.type' => 'exact',
    'roastLevel' => 'exact',
])]
#[ApiFilter(OrderFilter::class, properties: [
    'roaster.name' => 'ASC',
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

    #[ORM\Column(enumType: RoastLevel::class, options: ["default" => RoastLevel::MEDIUM])]
    #[Assert\Choice(options: RoastLevel::ARRAY)]
    private RoastLevel $roastLevel = RoastLevel::MEDIUM;

    public function __construct()
    {
        $this->beans = new ArrayCollection();
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

    public function getRoastLevel(): RoastLevel
    {
        return $this->roastLevel;
    }

    public function setRoastLevel(RoastLevel $roastLevel): static
    {
        $this->roastLevel = $roastLevel;

        return $this;
    }
}

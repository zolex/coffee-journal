<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use App\Config\BeanType as BeanTypeEnum;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Choice;

#[ORM\Entity]
#[ApiResource(order: ['name' => 'ASC'])]
class BeanType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ApiProperty(iris: ["https://schema.org/name"])]
    #[ORM\Column(enumType: BeanTypeEnum::class)]
    #[Choice(choices: BeanTypeEnum::ARRAY)]
    private BeanTypeEnum $name;

    public function __construct()
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?BeanTypeEnum
    {
        return $this->name;
    }

    public function setName(BeanTypeEnum $name): static
    {
        $this->name = $name;

        return $this;
    }
}

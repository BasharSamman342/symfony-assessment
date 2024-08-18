<?php
declare(strict_types=1);

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;
use Doctrine\DBAL\Types\Types;


class Country
{

    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private ?Uuid $id;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(length: 100)]
    private ?string $region = null;

    #[ORM\Column(length: 100)]
    private ?string $subRegion = null;

    #[ORM\Column(length: 255)]
    private ?string $demonym = null;

    #[ORM\Column(type: Types::BIGINT)]
    private ?string $population = null;

    #[ORM\Column]
    private ?bool $independant = null;

    #[ORM\Column(length: 255)]
    private ?string $flag = null;

    #[ORM\Column(nullable: true)]
    private ?array $currency = null;

    /**
     * @return int
     */
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

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(string $region): static
    {
        $this->region = $region;

        return $this;
    }

    public function getSubRegion(): ?string
    {
        return $this->subRegion;
    }

    public function setSubRegion(string | null $subRegion): static
    {
        $this->subRegion = $subRegion;

        return $this;
    }

    public function getDemonym(): ?string
    {
        return $this->demonym;
    }

    public function setDemonym(string | null $demonym): static
    {
        $this->demonym = $demonym;

        return $this;
    }

    public function getPopulation(): ?string
    {
        return $this->population;
    }

    public function setPopulation(string $population): static
    {
        $this->population = $population;

        return $this;
    }

    public function isIndependant(): ?bool
    {
        return $this->independant;
    }

    public function setIndependant(bool $independant): static
    {
        $this->independant = $independant;

        return $this;
    }

    public function getFlag(): ?string
    {
        return $this->flag;
    }

    public function setFlag(string $flag): static
    {
        $this->flag = $flag;

        return $this;
    }

    public function getCurrency(): ?array
    {
        return $this->currency;
    }

    public function setCurrency(?array $currency): static
    {
        $this->currency = $currency;

        return $this;
    }

}
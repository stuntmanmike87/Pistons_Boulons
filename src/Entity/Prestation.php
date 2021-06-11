<?php

namespace App\Entity;

use App\Repository\PrestationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PrestationRepository::class)
 */
class Prestation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tempsRealisation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $coutHT;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $typePrestation;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getTempsRealisation(): ?string
    {
        return $this->tempsRealisation;
    }

    public function setTempsRealisation(string $tempsRealisation): self
    {
        $this->tempsRealisation = $tempsRealisation;

        return $this;
    }

    public function getCoutHT(): ?string
    {
        return $this->coutHT;
    }

    public function setCoutHT(string $coutHT): self
    {
        $this->coutHT = $coutHT;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getTypePrestation(): ?string
    {
        return $this->typePrestation;
    }

    public function setTypePrestation(string $typePrestation): self
    {
        $this->typePrestation = $typePrestation;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }
}

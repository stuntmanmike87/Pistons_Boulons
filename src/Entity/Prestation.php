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



    /**
     * Fonction qui permet de récupérer l'id de la prestation
     * 
     * @return id
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Fonction qui permet de récupérer le nom de la prestation
     * 
     * @return nom
     */
    public function getNom(): ?string
    {
        return $this->nom;
    }

    /**
     * Fonction qui permet de changer la valeur du nom de la prestation
     * 
     * @param string $nom 
     * 
     * @return $nom
     */
    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Fonction qui permet de récupérer le temps de réalisation de la prestation
     * 
     * @return tempsRealisation
     */
    public function getTempsRealisation(): ?string
    {
        return $this->tempsRealisation;
    }

    /**
     * Fonction qui permet de changer la valeur du tps de réalisation de la prestation
     * 
     * @param string $tempsRealisation 
     * 
     * @return tempsRealisation
     */
    public function setTempsRealisation(string $tempsRealisation): self
    {
        $this->tempsRealisation = $tempsRealisation;

        return $this;
    }

    /**
     * Fonction qui permet de récupérer le cout HT de la prestation
     * 
     * @return coutHT
     */
    public function getCoutHT(): ?string
    {
        return $this->coutHT;
    }

    /**
     * Fonction qui permet de changer la valeur du cout HT de la prestation
     * 
     * @param string $coutHT 
     * 
     * @return coutHT
     */
    public function setCoutHT(string $coutHT): self
    {
        $this->coutHT = $coutHT;

        return $this;
    }

    /**
     * Fonction qui permet de récupérer la description de la prestation
     * 
     * @return description
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Fonction qui permet de changer la valeur de la description de la prestation
     * 
     * @param string $description 
     * 
     * @return description
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Fonction qui permet de récupérer le type de prestation de la prestation
     * 
     * @return typePrestation
     */
    public function getTypePrestation(): ?string
    {
        return $this->typePrestation;
    }

    /**
     * Fonction qui permet de changer la valeur du type de prestation de la prestation
     * 
     * @param string $typePrestation 
     * 
     * @return typePrestation
     */
    public function setTypePrestation(string $typePrestation): self
    {
        $this->typePrestation = $typePrestation;

        return $this;
    }

    /**
     * Fonction qui permet de récupérer le boolean estActif de la prestation
     * 
     * @return isActive
     */
    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    /**
     * Fonction qui permet de changer la valeur du boolean estActif de la prestation
     * 
     * @param boolean $isActive 
     * 
     * @return isActive
     */
    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }
}

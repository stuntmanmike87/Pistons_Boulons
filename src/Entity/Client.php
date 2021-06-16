<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClientRepository::class)
 */
class Client
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
    private $prenom;

    /**
     * @ORM\Column(type="date")
     */
    private $datePremiereSaisie;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $typeVehicule;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $plaqueImmat;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isActif;

    /**
     * Fonction qui permet de récupérer l'id du client
     * 
     * @return id
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Fonction qui permet de récupérer le nom du client
     * 
     * @return nom
     */
    public function getNom(): ?string
    {
        return $this->nom;
    }

     /**
     * Fonction qui permet de changer la valeur du nom du client
     * 
     * @param string $nom 
     * 
     * @return nom
     */
    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Fonction qui permet de récupérer le prénom du client
     * 
     * @return prenom
     */
    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    /**
     * Fonction qui permet de changer la valeur du prénom du client
     * 
     * @param string $prenom 
     * 
     * @return prénom
     */
    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

     /**
     * Fonction qui permet de récupérer la date de première saisie du client
     * 
     * @return datePremiereSaisie
     */
    public function getDatePremiereSaisie(): ?\DateTimeInterface
    {
        return $this->datePremiereSaisie;
    }

    /**
     * Fonction qui permet de changer la valeur de la date de première saisie du client
     * 
     * @param \DateTimeInterface $datePremiereSaisie
     * 
     * @return datePremiereSaisie
     */
    public function setDatePremiereSaisie(\DateTimeInterface $datePremiereSaisie): self
    {
        $this->datePremiereSaisie = $datePremiereSaisie;

        return $this;
    }

     /**
     * Fonction qui permet de récupérer l'adresse du client
     * 
     * @return adresse
     */
    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    /**
     * Fonction qui permet de changer la valeur de l'adresse du client
     * 
     * @param string $adresse
     * 
     * @return adresse
     */
    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }
    
     /**
     * Fonction qui permet de récupérer le type de véhicule du client
     * 
     * @return typeVehicule
     */
    public function getTypeVehicule(): ?string
    {
        return $this->typeVehicule;
    }

    /**
     * Fonction qui permet de changer la valeur du type de véhicule du client
     * 
     * @param string $typeVehicule
     * 
     * @return typeVehicule
     */
    public function setTypeVehicule(string $typeVehicule): self
    {
        $this->typeVehicule = $typeVehicule;

        return $this;
    }

     /**
     * Fonction qui permet de récupérer la plaque d'immatriculation du client
     * 
     * @return plaqueImmat
     */
    public function getPlaqueImmat(): ?string
    {
        return $this->plaqueImmat;
    }

    /**
     * Fonction qui permet de changer la valeur de la plaque d'immatriculation du client
     * 
     * @param string $plaqueImmat
     * 
     * @return plaqueImmat
     */
    public function setPlaqueImmat(string $plaqueImmat): self
    {
        $this->plaqueImmat = $plaqueImmat;

        return $this;
    }
    
     /**
     * Fonction qui permet de récupérer si le client est actif ou pas
     * 
     * @return isActif
     */
    public function getIsActif(): ?bool
    {
        return $this->isActif;
    }

    /**
     * Fonction qui permet de changer la valeur de l'activité du client du client
     * 
     * @param bool $isActif
     * 
     * @return isActif
     */
    public function setIsActif(?bool $isActif): self
    {
        $this->isActif = $isActif;

        return $this;
    }
}

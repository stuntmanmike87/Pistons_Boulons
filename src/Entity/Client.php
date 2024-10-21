<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/** @final */
#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private readonly int $id;

    #[Assert\NotBlank(message: 'Le nom ne peut pas être vide.')]
    #[Assert\Length(min: 1, max: 50, minMessage: 'Le nom doit comporter au moins {{ limit }} caractères ', maxMessage: 'Le nom ne doit pas comporter plus de  {{ limit }} caractères')]
    #[Assert\Regex(pattern: '/\d/', match: false, message: 'Le nom ne peut pas contenir de chiffre')]
    #[ORM\Column(type: Types::STRING, length: 255)]
    private ?string $nom = null;

    #[Assert\NotBlank(message: 'Le prénom ne peut pas être vide.')]
    #[Assert\Length(min: 1, max: 50, minMessage: 'Le prénom doit comporter au moins {{ limit }} caractères ', maxMessage: 'Le prénom ne doit pas comporter plus de  {{ limit }} caractères')]
    #[Assert\Regex(pattern: '/\d/', match: false, message: 'Le prénom ne peut pas contenir de chiffre')]
    #[ORM\Column(type: Types::STRING, length: 255)]
    private ?string $prenom = null;

    #[Assert\NotBlank(message: 'La date de première saisie ne peut pas être vide.')]
    #[Assert\Range(/* min: '-50 years',  */max: 'now', maxMessage: 'La date de première saisie ne peut pas être supérieure à la date du jour.', minMessage: 'La date de première saisie est trop ancienne.')]
    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $datePremiereSaisie = null;

    #[Assert\NotBlank(message: "L'adresse ne peut pas être vide.")]
    #[ORM\Column(type: Types::STRING, length: 255)]
    private ?string $adresse = null;

    #[Assert\NotBlank(message: 'Le type de véhicule ne peut pas être vide.')]
    #[ORM\Column(type: Types::STRING, length: 255)]
    private ?string $typeVehicule = null;

    #[Assert\NotBlank(message: "La plaque d'immatriculation ne peut pas être vide.")]
    #[Assert\Length(min: 9, max: 10, maxMessage: "La plaque d'immatriculation ne peut être pas supérieur à {{ limit }} caractères.", minMessage: "La plaque d'immatriculation ne peut être pas inférieur à {{ limit }} caractères.")]
    #[ORM\Column(type: Types::STRING, length: 255)]
    private ?string $plaqueImmat = null;

    //  * @Assert\Regex(
    //  * pattern="/^[A-Z]{2}[-]\d{3}[-][A-Z]{2}$/",
    //  * match=false,
    //  * message="La plaque d'immatriculation n'est pas valide"
    //  * )
    // /[A-Z]{1,2}+\d{1.4}+[A-Z]{1,2}|\d{1,4}+[A-Z]{1,4}+\d{1,2}/
    // |\d{1,4}[A-Z]{1,4}\d{1,2}
    // /^[A-Z]{2}[-]\d{3}[-][A-Z]{2}$/
    #[ORM\Column(type: Types::BOOLEAN, nullable: true)]
    private ?bool $isActif = null;

    // GETTERS / SETTERS
    /**
     * Fonction qui permet de récupérer l'id du client.
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Fonction qui permet de récupérer le nom du client.
     */
    public function getNom(): ?string
    {
        return $this->nom;
    }

    /**
     * Fonction qui permet de changer la valeur du nom du client.
     */
    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Fonction qui permet de récupérer le prénom du client.
     */
    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    /**
     * Fonction qui permet de changer la valeur du prénom du client.
     */
    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Fonction qui permet de récupérer la date de première saisie du client.
     */
    public function getDatePremiereSaisie(): ?\DateTimeInterface
    {
        return $this->datePremiereSaisie;
    }

    /**
     * Fonction qui permet de changer la valeur de la date de première saisie du client.
     */
    public function setDatePremiereSaisie(\DateTimeInterface $datePremiereSaisie): self
    {
        $this->datePremiereSaisie = $datePremiereSaisie;

        return $this;
    }

    /**
     * Fonction qui permet de récupérer l'adresse du client.
     */
    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    /**
     * Fonction qui permet de changer la valeur de l'adresse du client.
     */
    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Fonction qui permet de récupérer le type de véhicule du client.
     */
    public function getTypeVehicule(): ?string
    {
        return $this->typeVehicule;
    }

    /**
     * Fonction qui permet de changer la valeur du type de véhicule du client.
     */
    public function setTypeVehicule(string $typeVehicule): self
    {
        $this->typeVehicule = $typeVehicule;

        return $this;
    }

    /**
     * Fonction qui permet de récupérer la plaque d'immatriculation du client.
     */
    public function getPlaqueImmat(): ?string
    {
        return $this->plaqueImmat;
    }

    /**
     * Fonction qui permet de changer la valeur de la plaque d'immatriculation du client.
     */
    public function setPlaqueImmat(string $plaqueImmat): self
    {
        $this->plaqueImmat = $plaqueImmat;

        return $this;
    }

    /**
     * Fonction qui permet de récupérer si le client est actif ou pas.
     */
    public function getIsActif(): ?bool
    {
        return $this->isActif;
    }

    /**
     * Fonction qui permet de changer la valeur de l'activité du client du client.
     */
    public function setIsActif(?bool $isActif): self
    {
        $this->isActif = $isActif;

        return $this;
    }

    /**
     * Fonction qui permet de récupérer le client avec son nom , son prénom et sa plaque d'immatriculation.
     */
    public function getClient(): string
    {
        return $this->nom.' '.$this->prenom.' - Véhicule : '.$this->typeVehicule.' - Immatriculation : '.$this->plaqueImmat;
    }

    /**
     * Fonction qui permet de récupérer le client avec son nom , son prénom.
     */
    public function getIdentiteClient(): string
    {
        return $this->nom.' '.$this->prenom;
    }
}

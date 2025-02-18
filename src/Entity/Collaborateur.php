<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\CollaborateurRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**  @final */
#[ORM\Entity(repositoryClass: CollaborateurRepository::class)]
class Collaborateur
{
    // final public const ROLE_COLLABORATEUR = 'ROLE_COLLABORATEUR';

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

    #[Assert\NotBlank(message: 'La date de naissance ne peut pas être vide.')]
    #[Assert\Range(/* min: '-1000 years',  */max: 'now', maxMessage: "La date d'entrée en entreprise ne peut pas être supérieure à la date du jour.", minMessage: 'La date de première saisie est trop ancienne.')]
    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateNaissance = null;

    #[Assert\NotBlank(message: "La date d'entrée en entreprise ne peut pas être vide.")]
    #[Assert\Range(/* min: '-50 years',  */max: 'now', maxMessage: "La date d'entrée en entreprise ne peut pas être supérieure à la date du jour.", minMessage: 'La date de première saisie est trop ancienne.')]
    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateEntreeEntreprise = null;

    #[Assert\NotBlank(message: 'Le numéro de sécurité sociale ne peut pas être vide.')]
    #[Assert\Length(min: 15, max: 15, exactMessage: 'Le numéro de sécurité sociale est incorrecte, il ne comprend pas 15 caractères.')]
    #[ORM\Column(type: Types::STRING, length: 255)]
    private ?string $numSecuriteSocial = null;

    // regex:  '/^                # début de chaîne
    // [12]                      # 1 ou 2 pour le sexe
    // [0-9]{2}[0-1][0-9]        # ça je me rappelle plus
    // (2[AB]|[0-9]{2})          # le département
    // [0-9]{3}[0-9]{3}[0-9]{2}  # ça non plus je ne sais plus
    // $/                        # fin de chaîne
    #[Assert\NotBlank(message: 'Le type de contrat ne peut pas être vide.')]
    #[ORM\Column(type: Types::STRING, length: 255)]
    private ?string $typeContrat = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateHeureDerniereConnexion = null;

    #[Assert\NotBlank(message: 'La durée de travail hebdomadaire ne peut pas être vide.')]
    #[ORM\Column(type: Types::STRING, length: 255)]
    private ?string $dureeTravailHebdo = null;

    #[ORM\Column(type: Types::BOOLEAN, nullable: true)]
    private ?bool $isActif = null;

    #[ORM\OneToOne(targetEntity: User::class, inversedBy: 'collaborateur', cascade: ['persist', 'remove'])]
    private ?User $user = null;

    /**
     * Fonction GETTER qui permet de récupérer l'identifiant.
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Fonction GETTER qui permet de récupérer le nom.
     */
    public function getNom(): ?string
    {
        return $this->nom;
    }

    /**
     * Fonction SETTER qui permet de changer la valeur du nom.
     */
    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Fonction GETTER qui permet de récupérer le prénom.
     */
    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    /**
     * Fonction SETTER qui permet de changer la valeur de prénom.
     */
    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Fonction GETTER qui permet de récupérer la date de naissance.
     */
    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    /**
     * Fonction SETTER qui permet de changer la valeur de la date de naissance.
     */
    public function setDateNaissance(\DateTimeInterface $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    /**
     * Fonction GETTER qui permet de récupérer la date d'entrée en entreprise.
     */
    public function getDateEntreeEntreprise(): ?\DateTimeInterface
    {
        return $this->dateEntreeEntreprise;
    }

    /**
     * Fonction SETTER qui permet de changer la valeur de la date d'entrée dans l'entreprise.
     */
    public function setDateEntreeEntreprise(\DateTimeInterface $dateEntreeEntreprise): self
    {
        $this->dateEntreeEntreprise = $dateEntreeEntreprise;

        return $this;
    }

    /**
     * Fonction GETTER qui permet de récupérer le numéro de sécu sociale.
     */
    public function getNumSecuriteSocial(): ?string
    {
        return $this->numSecuriteSocial;
    }

    /**
     * Fonction SETTER qui permet de changer la valeur du numéro de sécu sociale.
     */
    public function setNumSecuriteSocial(string $numSecuriteSocial): self
    {
        $this->numSecuriteSocial = $numSecuriteSocial;

        return $this;
    }

    /**
     * Fonction GETTER qui permet de récupérer le type de contrat.
     */
    public function getTypeContrat(): ?string
    {
        return $this->typeContrat;
    }

    /**
     * Fonction SETTER qui permet de changer la valeur du type de contrat.
     */
    public function setTypeContrat(string $typeContrat): self
    {
        $this->typeContrat = $typeContrat;

        return $this;
    }

    /**
     * Fonction GETTER qui permet de récupérer la date de derniere connexion.
     */
    public function getDateHeureDerniereConnexion(): ?\DateTimeInterface
    {
        return $this->dateHeureDerniereConnexion;
    }

    /**
     * Fonction SETTER qui permet de changer la valeur de la date de dernière connexion.
     */
    public function setDateHeureDerniereConnexion(?\DateTimeInterface $dateHeureDerniereConnexion): self
    {
        $this->dateHeureDerniereConnexion = $dateHeureDerniereConnexion;

        return $this;
    }

    /**
     * Fonction GETTER qui permet de récupérer la durée de travail hebdo.
     */
    public function getDureeTravailHebdo(): ?string
    {
        return $this->dureeTravailHebdo;
    }

    /**
     * Fonction SETTER qui permet de changer la valeur de durée de travail hebdo.
     */
    public function setDureeTravailHebdo(string $dureeTravailHebdo): self
    {
        $this->dureeTravailHebdo = $dureeTravailHebdo;

        return $this;
    }

    /**
     * Fonction GETTER qui permet de récupérer le boolean isActif.
     */
    public function getIsActif(): ?bool
    {
        return $this->isActif;
    }

    /**
     * Fonction SETTER qui permet de changer la valeur du boolean isActif.
     */
    public function setIsActif(bool $isActif): self
    {
        $this->isActif = $isActif;

        return $this;
    }

    /**
     * Fonction GETTER qui permet de récupérer l'identité du collaborateur.
     */
    public function getCollaborateur(): string
    {
        return $this->nom.' '.$this->prenom;
    }

    /**
     * Fonction GETTER qui permet de récupérer l'user.
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * Fonction SETTER qui permet de changer la valeur de user.
     */
    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /*
     * Fonction GETTER qui permet de récupérer le login de l'utilisateur
     */
    /* public function getUserLog(): ?string
    {
        return $this->user->getUserLog();
        //Cannot call method getUserLog() on App\Entity\User|null.
    } */
}

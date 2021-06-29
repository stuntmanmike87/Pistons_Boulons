<?php

namespace App\Entity;

use App\Repository\CollaborateurRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CollaborateurRepository::class)
 */
class Collaborateur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le nom ne peut pas être vide.")
     * @Assert\Length(
     *      min = 1,
     *      max = 50,
     *      minMessage = "Le nom doit comporter au moins {{ limit }} caractères ",
     *      maxMessage = "Le nom ne doit pas comporter plus de  {{ limit }} caractères"
     * )
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Le nom ne peut pas contenir de chiffre"
     * )
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le prénom ne peut pas être vide.")
     * @Assert\Length(
     *      min = 1,
     *      max = 50,
     *      minMessage = "Le prénom doit comporter au moins {{ limit }} caractères ",
     *      maxMessage = "Le prénom ne doit pas comporter plus de  {{ limit }} caractères"
     * )
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Le prénom ne peut pas contenir de chiffre"
     * )
     */
    private $prenom;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank(message="La date de naissance ne peut pas être vide.")
     * @Assert\Range(
     *      min = "-1000 years",
     *      max = "now",
     *      maxMessage="La date d'entrée en entreprise ne peut pas être supérieure à la date du jour.",
     *      minMessage="La date de première saisie est trop ancienne."
     * )
     */
    private $dateNaissance;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank(message="La date d'entrée en entreprise ne peut pas être vide.")
     * @Assert\Range(
     *      min = "-50 years",
     *      max = "now",
     *      maxMessage="La date d'entrée en entreprise ne peut pas être supérieure à la date du jour.",
     *      minMessage="La date de première saisie est trop ancienne."
     * )
     */
    private $dateEntreeEntreprise;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le numéro de sécurité sociale ne peut pas être vide.")
     * @Assert\Length(
     *      min = 15,
     *      max = 15,
     *      exactMessage = "Le numéro de sécurité sociale est incorrecte, il ne comprend pas 15 caractères.",
     *  )
     */
    private $numSecuriteSocial;
    // regex:  '/^                # début de chaîne
    // [12]                      # 1 ou 2 pour le sexe
    // [0-9]{2}[0-1][0-9]        # ça je me rappelle plus
    // (2[AB]|[0-9]{2})          # le département
    // [0-9]{3}[0-9]{3}[0-9]{2}  # ça non plus je ne sais plus
    // $/                        # fin de chaîne


    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le type de contrat ne peut pas être vide.")
     */
    private $typeContrat;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateHeureDerniereConnexion;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="La durée de travail hebdomadaire ne peut pas être vide.")
     */
    private $dureeTravailHebdo;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isActif;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="collaborateur", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $user;
    /**
     * Fonction GETTER qui permet de récupérer l'identifiant
     * @return Int
     */
    public function getId(): ?int
    {
        return $this->id;
    }
    /**
     * Fonction GETTER qui permet de récupérer le nom
     * @return String
     */
    public function getNom(): ?string
    {
        return $this->nom;
    }
    /**
     * Fonction SETTER qui permet de changer la valeur du nom
     * @param String
     * @return String $nom
     */
    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }
    /**
     * Fonction GETTER qui permet de récupérer le prénom
     * @return String
     */
    public function getPrenom(): ?string
    {
        return $this->prenom;
    }
    /**
     * Fonction SETTER qui permet de changer la valeur de prénom
     * @param String
     * @return String $nom
     */
    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }
    /**
     * Fonction GETTER qui permet de récupérer la date de naissance
     * @return DateTimeInterface
     */
    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }
    /**
     * Fonction SETTER qui permet de changer la valeur de la date de naissance
     * @param DateTimeInterface
     * @return DateTimeInterface $dateNaissance
     */
    public function setDateNaissance(\DateTimeInterface $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }
    /**
     * Fonction GETTER qui permet de récupérer la date d'entrée en entreprise
     * @return DateTimeInterface
     */
    public function getDateEntreeEntreprise(): ?\DateTimeInterface
    {
        return $this->dateEntreeEntreprise;
    }
    /**
     * Fonction SETTER qui permet de changer la valeur de la date d'entrée dans l'entreprise
     * @param DateTimeInterface 
     * @return DateTimeInterface $dateEntreeEntreprise
     */
    public function setDateEntreeEntreprise(\DateTimeInterface $dateEntreeEntreprise): self
    {
        $this->dateEntreeEntreprise = $dateEntreeEntreprise;

        return $this;
    }
    /**
     * Fonction GETTER qui permet de récupérer le numéro de sécu sociale
     * @return String
     */
    public function getNumSecuriteSocial(): ?string
    {
        return $this->numSecuriteSocial;
    }
    /**
     * Fonction SETTER qui permet de changer la valeur du numéro de sécu sociale
     * @param String 
     * @return String $numSecuriteSocial
     */
    public function setNumSecuriteSocial(string $numSecuriteSocial): self
    {
        $this->numSecuriteSocial = $numSecuriteSocial;

        return $this;
    }
    /**
     * Fonction GETTER qui permet de récupérer le type de contrat
     * @return String
     */
    public function getTypeContrat(): ?string
    {
        return $this->typeContrat;
    }
    /**
     * Fonction SETTER qui permet de changer la valeur du type de contrat
     * @param String
     * @return String $typeContrat
     */
    public function setTypeContrat(string $typeContrat): self
    {
        $this->typeContrat = $typeContrat;

        return $this;
    }
    /**
     * Fonction GETTER qui permet de récupérer la date de derniere connexion
     * @return DateTimeInterface
     */
    public function getDateHeureDerniereConnexion(): ?\DateTimeInterface
    {
        return $this->dateHeureDerniereConnexion;
    }
    /**
     * Fonction SETTER qui permet de changer la valeur de la date de dernière connexion 
     * @param DateTimeInterface 
     * @return DateTimeInterface $dateHeureDerniereConnexion
     */
    public function setDateHeureDerniereConnexion(?\DateTimeInterface $dateHeureDerniereConnexion): self
    {
        $this->dateHeureDerniereConnexion = $dateHeureDerniereConnexion;

        return $this;
    }
    /**
     * Fonction GETTER qui permet de récupérer la durée de travail hebdo
     * @return String
     */
    public function getDureeTravailHebdo(): ?string
    {
        return $this->dureeTravailHebdo;
    }
    /**
     * Fonction SETTER qui permet de changer la valeur de durée de travail hebdo
     * @param String
     * @return String $dureeTravailHebdo
     */
    public function setDureeTravailHebdo(string $dureeTravailHebdo): self
    {
        $this->dureeTravailHebdo = $dureeTravailHebdo;

        return $this;
    }
    /**
     * Fonction GETTER qui permet de récupérer le boolean isActif
     * @return Boolean
     */
    public function getIsActif(): ?bool
    {
        return $this->isActif;
    }
    /**
     * Fonction SETTER qui permet de changer la valeur du boolean isActif
     * @param Boolean
     * @return Boolean $isActif
     */
    public function setIsActif(bool $isActif): self
    {
        $this->isActif = $isActif;

        return $this;
    }
    /**
     * Fonction GETTER qui permet de récupérer l'identité du collaborateur
     * @return String
     */
    public function getCollaborateur()
    {
        return $this->nom . ' ' . $this->prenom;
    }
    /**
     * Fonction GETTER qui permet de récupérer l'user
     * @return User
     */
    public function getUser(): ?User
    {
        return $this->user;
    }
    /**
     * Fonction SETTER qui permet de changer la valeur de user
     * @param String
     * @return User $user
     */
    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }
    /**
     * Fonction GETTER qui permet de récupérer le login de l'utilisateur
     * @return String
     */
    public function getUserLog()
    {
        return $this->user->getUserLog();
    }
}

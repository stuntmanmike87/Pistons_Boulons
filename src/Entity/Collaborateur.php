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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(\DateTimeInterface $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getDateEntreeEntreprise(): ?\DateTimeInterface
    {
        return $this->dateEntreeEntreprise;
    }

    public function setDateEntreeEntreprise(\DateTimeInterface $dateEntreeEntreprise): self
    {
        $this->dateEntreeEntreprise = $dateEntreeEntreprise;

        return $this;
    }

    public function getNumSecuriteSocial(): ?string
    {
        return $this->numSecuriteSocial;
    }

    public function setNumSecuriteSocial(string $numSecuriteSocial): self
    {
        $this->numSecuriteSocial = $numSecuriteSocial;

        return $this;
    }

    public function getTypeContrat(): ?string
    {
        return $this->typeContrat;
    }

    public function setTypeContrat(string $typeContrat): self
    {
        $this->typeContrat = $typeContrat;

        return $this;
    }

    public function getDateHeureDerniereConnexion(): ?\DateTimeInterface
    {
        return $this->dateHeureDerniereConnexion;
    }

    public function setDateHeureDerniereConnexion(?\DateTimeInterface $dateHeureDerniereConnexion): self
    {
        $this->dateHeureDerniereConnexion = $dateHeureDerniereConnexion;

        return $this;
    }

    public function getDureeTravailHebdo(): ?string
    {
        return $this->dureeTravailHebdo;
    }

    public function setDureeTravailHebdo(string $dureeTravailHebdo): self
    {
        $this->dureeTravailHebdo = $dureeTravailHebdo;

        return $this;
    }

    public function getIsActif(): ?bool
    {
        return $this->isActif;
    }

    public function setIsActif(bool $isActif): self
    {
        $this->isActif = $isActif;

        return $this;
    }

    public function getCollaborateur(){
        return $this->nom .' '. $this->prenom;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getUserLog(){
        return $this->user->getUserLog();
    }
}

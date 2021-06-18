<?php

namespace App\Entity;

use App\Repository\CollaborateurRepository;
use Doctrine\ORM\Mapping as ORM;

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
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="date")
     */
    private $dateNaissance;

    /**
     * @ORM\Column(type="date")
     */
    private $dateEntreeEntreprise;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numSecuriteSocial;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $typeContrat;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateHeureDerniereConnexion;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $dureeTravailHebdo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $login;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $motDePasse;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isAdmin;

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

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getMotDePasse(): ?string
    {
        return $this->motDePasse;
    }

    public function setMotDePasse(string $motDePasse): self
    {
        $this->motDePasse = $motDePasse;

        return $this;
    }

    public function getIsAdmin(): ?bool
    {
        return $this->isAdmin;
    }

    public function setIsAdmin(bool $isAdmin): self
    {
        $this->isAdmin = $isAdmin;

        return $this;
    }

    public function getCollaborateur(){
        return $this->nom .' '. $this->prenom;
    }
}

<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @final
 * @ORM\Entity(repositoryClass=AdminRepository::class)
 */
class Admin
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $nom = null;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $prenom = null;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="admin", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private ?\App\Entity\User $user = null;

    /**
     * Fonction GETTER qui permet de récupérer l'id
     *
     * @return Int 
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Fonction GETTER qui permet de récupérer le nom
     *
     * @return String 
     */
    public function getNom(): ?string
    {
        return $this->nom;
    }

    /**
     * Fonction SETTER qui permet de changer la valeur du nom
     */
    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

   /**
     * Fonction GETTER qui permet de récupérer le prénom
     *
     * @return String 
     */
    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    /**
     * Fonction SETTER qui permet de changer la valeur du prénom
     */
    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

   /**
     * Fonction GETTER qui permet de récupérer le User
     *
     * @return User
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * Fonction SETTER qui permet de changer la valeur de user
     */
    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Fonction qui permet de récupérer le nom et prénom de l'admin
     */
    public function getAdmin(): string{
        return $this->nom .' '. $this->prenom;
    }
}

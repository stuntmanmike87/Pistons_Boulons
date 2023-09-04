<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use App\Repository\AdminRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @final
 */
#[ORM\Entity(repositoryClass: AdminRepository::class)]
class Admin
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private readonly int $id;//Class App\Entity\Admin has an uninitialized readonly property $id. Assign it in the constructor.

    #[ORM\Column(type: Types::STRING, length: 255)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private ?string $prenom = null;

    #[ORM\OneToOne(targetEntity: User::class, inversedBy: 'admin', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    /**
     * Fonction GETTER qui permet de récupérer l'id
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Fonction GETTER qui permet de récupérer le nom
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

<?php

namespace App\Entity;

use App\Repository\AdminRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AdminRepository::class)
 */
class Admin
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
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="admin", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;
 /**
     * Fonction GETTER qui permet de récupérer l'id
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
     * @param String $nom
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
     * Fonction SETTER qui permet de changer la valeur du prénom
     * @param String $prenom
     */
    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }
   /**
     * Fonction GETTER qui permet de récupérer le User
     * @return User
     */
    public function getUser(): ?User
    {
        return $this->user;
    }
    /**
     * Fonction SETTER qui permet de changer la valeur de user
     * @param User $user
     */
    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }
       /**
     * Fonction qui permet de récupérer le nom et prénom de l'admin
     * 
     * @return String
     */
    public function getAdmin(){
        return $this->nom .' '. $this->prenom;
    }
}

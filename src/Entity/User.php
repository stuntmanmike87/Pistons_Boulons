<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Admin;
use App\Entity\Collaborateur;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
   
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $login;

    /**
     * @ORM\Column(type="array")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\JoinColumn(nullable=true)
     * @ORM\OneToOne(targetEntity=Admin::class, mappedBy="user", cascade={"persist", "remove"})
     * 
     */
    private $admin;

    /**
     *  @ORM\JoinColumn(nullable=true)
     * @ORM\OneToOne(targetEntity=Collaborateur::class, mappedBy="user", cascade={"persist", "remove"})
     *
     */
    private $collaborateur;

    public function getId(): ?int
    {
        return $this->id;
    }
 /**
     * Fonction qui permet de récuperer le login
     * 
     * @return String
     */
    public function getLogin(): ?string
    {
        return $this->login;
    }

    /**
     * Fonction qui permet de changer la valeur du login
     * 
     * @param String $login
     * 
     * @return String $login
     */
    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->login;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }
 /**
     * Fonction qui permet de changer la valeur de l'array Roles
     * 
     * @param Array $roles
     * 
     * @return Array $roles
     */
    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }
 /**
     * Fonction qui permet de changer la valeur du mot de passe
     * 
     * @param String $password
     * 
     * @return String $password
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
 /**
     * Fonction qui permet de récuperer le champ admin
     * 
     * @return Admin
     */
    public function getAdmin()
    {
        return $this->Admin->getAdmin();
    }
     /**
     * Fonction qui permet de changer la valeur de admin
     * 
     * @param Admin $admin
     * 
     * @return Admin $admin
     */
    public function setAdmin(Admin $admin): self
    {
        // set the owning side of the relation if necessary
        if ($admin->getUser() !== $this) {
            $admin->setUser($this);
        }

        $this->admin = $admin;

        return $this;
    }

   /**
     * Fonction qui permet de récuperer les données d'un collaborateur qui sont son nom et son prénom
     * 
     * @return Collaborateur.getCollaborateur()
     */
    public function getCollaborateur()
    {
        return $this->Collaborateur->getCollaborateur();
    }
      /**
     * Fonction qui permet de changer la valeur de collaborateur
     * 
     * @param Collaborateur $collaborateur
     * 
     * @return Collaborateur $collaborateur
     */
    public function setCollaborateur(Collaborateur $collaborateur): self
    {
        // set the owning side of the relation if necessary
        if ($collaborateur->getUser() !== $this) {
            $collaborateur->setUser($this);
        }

        $this->collaborateur = $collaborateur;

        return $this;
    }
 /**
     * Fonction qui permet de récuperer les données d'un collaborateur qui sont son nom et son prénom
     * 
     * @return Collaborateur.getCollaborateur()
     */
    public function getUserLog(){
        return $this->login;
    }
/**
     * Fonction qui permet de savoir si le user est admin ou non
     * @return Boolean 
     */
    public function isAdmin(){
       $roles = $this->getRoles();

       foreach ($roles as $key => $value) {
           if($value=="ROLE_ADMIN"){
               return true;
           }
       }
       return false;

    }

}

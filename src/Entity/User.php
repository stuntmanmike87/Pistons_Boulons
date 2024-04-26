<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/** @final */
#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['login'], message: 'There is already an account with this login')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    // final public const ROLE_USER = 'ROLE_USER';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private readonly int $id;

    #[ORM\Column(type: Types::STRING, length: 180, unique: true)]
    #[Assert\NotBlank]
    #[Assert\Length(min: 2, max: 50)]
    private ?string $login = null;

    /** @var string[] $roles */
    #[ORM\Column(type: Types::JSON)]
    private array $roles = [];

    #[ORM\Column(type: Types::STRING)]
    private ?string $password = null;

    #[ORM\JoinColumn(nullable: true)]
    #[ORM\OneToOne(targetEntity: Admin::class, mappedBy: 'user', cascade: ['persist', 'remove'])]
    private ?Admin $admin = null;

    #[ORM\JoinColumn(nullable: true)]
    #[ORM\OneToOne(targetEntity: Collaborateur::class, mappedBy: 'user', cascade: ['persist', 'remove'])]
    private ?Collaborateur $collaborateur = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Fonction qui permet de récuperer le login.
     */
    public function getLogin(): ?string
    {
        return $this->login;
    }

    /**
     * Fonction qui permet de changer la valeur du login.
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
    #[\Override]
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * Fonction qui permet de changer la valeur de l'array Roles.
     *
     * @param array<string> $roles
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
     * Fonction qui permet de changer la valeur du mot de passe.
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
    #[\Override]
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * Fonction qui permet de récuperer le champ admin.
     */
    public function getAdmin(): ?string
    {
        if (null != $this->admin) {
            return $this->admin->getAdmin();
        }

        return null;
    }

    /**
     * Fonction qui permet de changer la valeur de admin.
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
     * Fonction qui permet de récuperer l'id d'un collaborateur.
     */
    public function getCollaborateur(): ?Collaborateur
    {
        if (null != $this->collaborateur) {
            return $this->collaborateur;
        }

        return null;
    }

    /**
     * Fonction qui permet de changer la valeur d'un collaborateur.
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
     * Fonction qui permet de récuperer le login d'un utilisateur.
     */
    public function getUserLog(): ?string
    {
        return $this->login;
    }

    /**
     * Fonction qui permet de savoir si l'utilisateur est admin ou non.
     */
    public function isAdmin(): bool
    {
        $roles = $this->getRoles();

        foreach ($roles as $key => $value) {
            if ('ROLE_ADMIN' == $value) {
                return true;
            }
        }

        return false;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    #[\Override]
    public function getUserIdentifier(): string// ?string
    {
        return (string) $this->login;
    }
}

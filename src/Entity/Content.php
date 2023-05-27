<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @final
 * @ORM\Entity(repositoryClass=ContentRepository::class)
 */
class Content
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * 
     */
    private int $id;

    /**
     * @ORM\Column(type="text")
     */
    #[Assert\NotBlank(message: 'Le texte ne peut pas être vide.')]
    private ?string $text = null;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Assert\NotBlank(message: 'La position ne peut pas être vide.')]
    private ?string $position = null;

    /**
     * Fonction qui permet de récupérer l'id du contenu
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Fonction qui permet de récupérer le texte du contenu
     */
    public function getText(): ?string
    {
        return $this->text;
    }

    /**
     * Fonction qui permet de changer la valeur du texte du contenu
     *
     * @param string $text le nom du contenu
     */
    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Fonction qui permet de récuperer la valeur de la position du contenu
     */
    public function getPosition(): ?string
    {
        return $this->position;
    }


    /**
     * Fonction qui permet de changer la valeur de la position du contenu
     *
     * @param string $position le nom du contenu
     */
    public function setPosition(string $position): self
    {
        $this->position = $position;

        return $this;
    }
}

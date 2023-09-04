<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use App\Repository\ContentRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @final
 */
#[ORM\Entity(repositoryClass: ContentRepository::class)]
class Content
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private readonly int $id;//Class App\Entity\Content has an uninitialized readonly property $id. Assign it in the constructor.

    #[Assert\NotBlank(message: 'Le texte ne peut pas être vide.')]
    #[ORM\Column(type: Types::TEXT)]
    private ?string $text = null;

    #[Assert\NotBlank(message: 'La position ne peut pas être vide.')]
    #[ORM\Column(type: Types::STRING, length: 255)]
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
     * param string $text le nom du contenu
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
     * param string $position le nom du contenu
     */
    public function setPosition(string $position): self
    {
        $this->position = $position;

        return $this;
    }
}

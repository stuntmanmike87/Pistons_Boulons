<?php

namespace App\Entity;

use App\Repository\ContentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContentRepository::class)
 */
class Content
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $text;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $position;


    /**
     * Fonction qui permet de récupérer l'id du contenu
     * 
     * @return id
     */
    public function getId(): ?int
    {
        return $this->id;
    }



    /**
     * Fonction qui permet de récupérer le texte du contenu
     * 
     * @return text
     */
    public function getText(): ?string
    {
        return $this->text;
    }


    /**
     * Fonction qui permet de changer la valeur du texte du contenu
     * 
     * @param string $text le nom du contenu
     * 
     * @return text
     */
    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Fonction qui permet de récuperer la valeur de la position du contenu
     * 
     * @return position
     */
    public function getPosition(): ?string
    {
        return $this->position;
    }


    /**
     * Fonction qui permet de changer la valeur de la position du contenu
     * 
     * @param string $position le nom du contenu
     * 
     * @return position
     */
    public function setPosition(string $position): self
    {
        $this->position = $position;

        return $this;
    }
}

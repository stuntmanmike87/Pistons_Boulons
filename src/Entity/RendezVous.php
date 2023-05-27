<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Client;
use App\Entity\Collaborateur;
use App\Entity\Prestation;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @final
 * @ORM\Entity(repositoryClass=RendezVousRepository::class)
 */
class RendezVous
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class)
     * @ORM\JoinColumn(nullable=false)
     */
    #[Assert\NotBlank(message: 'Vous devez choisir un client.')]
    private ?\App\Entity\Client $idClient = null;

    /**
     * @ORM\ManyToOne(targetEntity=Collaborateur::class)
     * @ORM\JoinColumn(nullable=false)
     */
    #[Assert\NotBlank(message: 'Vous devez choisir un collaborateur.')]
    private ?\App\Entity\Collaborateur $idCollaborateur = null;

    /**
     * @ORM\ManyToOne(targetEntity=Prestation::class)
     * @ORM\JoinColumn(nullable=false)
     */
    #[Assert\NotBlank(message: 'Vous devez choisir une prestation.')]
    private ?\App\Entity\Prestation $idPrestation = null;

    /**
     * @ORM\Column(type="datetime")
     */
    #[Assert\NotBlank(message: 'La date de rendez-vous ne peut pas être vide.')]
    #[Assert\Range(min: 'now', minMessage: 'La date du rendez-vous ne peut pas être inférieure à la date du jour.')]
    private ?\DateTimeInterface $dateRendezVous = null;

    /**
     * Fonction qui permet de récupérer l'id du rendez-vous
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Fonction qui permet de récupérer l'id du client
     */
    public function getIdClient(): ?Client
    {
        return $this->idClient;
    }

    /**
     * Fonction qui permet de changer la valeur de l'id du client
     */
    public function setIdClient(?Client $idClient): self
    {
        $this->idClient = $idClient;

        return $this;
    }

    /**
     * Fonction qui permet de récupérer l'id du collaborateur
     */
    public function getIdCollaborateur(): ?Collaborateur
    {
        return $this->idCollaborateur;
    }

    /**
     * Fonction qui permet de changer la valeur de l'id du collaborateur
     */
    public function setIdCollaborateur(?Collaborateur $idCollaborateur): self
    {
        $this->idCollaborateur = $idCollaborateur;

        return $this;
    }

    /**
     * Fonction qui permet de récupérer l'id de prestation
     */
    public function getIdPrestation(): ?Prestation
    {
        return $this->idPrestation;
    }

    /**
     * Fonction qui permet de changer la valeur de l'id de la prestation
     */
    public function setIdPrestation(?Prestation $idPrestation): self
    {
        $this->idPrestation = $idPrestation;

        return $this;
    }

    /**
     * Fonction qui permet de récupérer la date du rendez-vous
     */
    public function getDateRendezVous(): ?\DateTimeInterface
    {
        return $this->dateRendezVous;
    }

    /**
     * Fonction qui permet de changer la valeur de la date du rendez-vous
     */
    public function setDateRendezVous(\DateTimeInterface $dateRendezVous): self
    {
        $this->dateRendezVous = $dateRendezVous;

        return $this;
    }

    /**
     * Fonction qui permet de récuperer les données d'un client qui sont son nom , son prénom et sa plaque d'immatriculation
     *
     * @return Client.getClient()
     */
    public function getClient()
    {
        return $this->getClient();
    }

    /**
     * Fonction qui permet de récuperer les données d'un client qui sont son nom , son prénom et sa plaque d'immatriculation
     *
     * @return Client.getClient()
     */
    public function getIdentiteClient()
    {
        return $this->getIdentiteClient();
    }

    /**
     * Fonction qui permet de récuperer les données d'un collaborateur qui sont son nom et son prénom
     *
     * @return Collaborateur.getCollaborateur()
     */
    public function getCollaborateur()
    {
        return $this->getCollaborateur();
    }

    /**
     * Fonction qui permet de récuperer la donnée d'une prestation qui est son nom 
     *
     * @return Prestation.getPrestation()
     */
    public function getPrestation()
    {
        return $this->getPrestation();
    }
}

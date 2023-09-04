<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use App\Entity\Client;
use App\Entity\Collaborateur;
use App\Entity\Prestation;
use App\Repository\RendezVousRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @final
 */
#[ORM\Entity(repositoryClass: RendezVousRepository::class)]
class RendezVous
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private readonly int $id;//Class App\Entity\RendezVous has an uninitialized readonly property $id. Assign it in the constructor.

    #[Assert\NotBlank(message: 'Vous devez choisir un client.')]
    #[ORM\ManyToOne(targetEntity: Client::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Client $idClient = null;

    #[Assert\NotBlank(message: 'Vous devez choisir un collaborateur.')]
    #[ORM\ManyToOne(targetEntity: Collaborateur::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Collaborateur $idCollaborateur = null;

    #[Assert\NotBlank(message: 'Vous devez choisir une prestation.')]
    #[ORM\ManyToOne(targetEntity: Prestation::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Prestation $idPrestation = null;

    #[Assert\NotBlank(message: 'La date de rendez-vous ne peut pas être vide.')]
    #[Assert\Range(min: 'now', minMessage: 'La date du rendez-vous ne peut pas être inférieure à la date du jour.')]
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?DateTimeInterface $dateRendezVous = null;

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
    public function getDateRendezVous(): ?DateTimeInterface
    {
        return $this->dateRendezVous;
    }

    /**
     * Fonction qui permet de changer la valeur de la date du rendez-vous
     */
    public function setDateRendezVous(DateTimeInterface $dateRendezVous): self
    {
        $this->dateRendezVous = $dateRendezVous;

        return $this;
    }

    /**
     * Fonction qui permet de récuperer les données d'un client qui sont son nom , son prénom et sa plaque d'immatriculation
     */
    public function getClient(): mixed
    {
        return $this->getClient();
    }

    /**
     * Fonction qui permet de récuperer les données d'un client qui sont son nom , son prénom et sa plaque d'immatriculation
     */
    public function getIdentiteClient(): mixed
    {
        return $this->getIdentiteClient();
    }

    /**
     * Fonction qui permet de récuperer les données d'un collaborateur qui sont son nom et son prénom
     */
    public function getCollaborateur(): mixed
    {
        return $this->getCollaborateur();
    }

    /**
     * Fonction qui permet de récuperer la donnée d'une prestation qui est son nom 
     */
    public function getPrestation(): mixed
    {
        return $this->getPrestation();
    }
}

<?php

namespace App\Entity;

use App\Repository\RendezVousRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Client;
use App\Entity\Collaborateur;
use App\Entity\Prestation;

/**
 * @ORM\Entity(repositoryClass=RendezVousRepository::class)
 */
class RendezVous
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $idClient;

    /**
     * @ORM\ManyToOne(targetEntity=Collaborateur::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $idCollaborateur;

    /**
     * @ORM\ManyToOne(targetEntity=Prestation::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $idPrestation;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateRendezVous;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdClient(): ?Client
    {
        return $this->idClient;
    }

    public function setIdClient(?Client $idClient): self
    {
        $this->idClient = $idClient;

        return $this;
    }

    public function getIdCollaborateur(): ?Collaborateur
    {
        return $this->idCollaborateur;
    }

    public function setIdCollaborateur(?Collaborateur $idCollaborateur): self
    {
        $this->idCollaborateur = $idCollaborateur;

        return $this;
    }

    public function getIdPrestation(): ?Prestation
    {
        return $this->idPrestation;
    }

    public function setIdPrestation(?Prestation $idPrestation): self
    {
        $this->idPrestation = $idPrestation;

        return $this;
    }

    public function getDateRendezVous(): ?\DateTimeInterface
    {
        return $this->dateRendezVous;
    }

    public function setDateRendezVous(\DateTimeInterface $dateRendezVous): self
    {
        $this->dateRendezVous = $dateRendezVous;

        return $this;
    }

    public function getClient(){
        return $this->Client.getClient();
    }

    public function getCollaborateur(){
        return $this->Collaborateur.getCollaborateur();
    }

    public function getPrestation(){
        return $this->Prestation.getPrestation();
    }
}

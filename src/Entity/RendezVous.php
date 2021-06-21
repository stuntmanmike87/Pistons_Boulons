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

    /**
     * Fonction qui permet de récupérer l'id du rendez-vous
     * 
     * @return id
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Fonction qui permet de récupérer l'id du client
     * 
     * @return idClient
     */
    public function getIdClient(): ?Client
    {
        return $this->idClient;
    }

    /**
     * Fonction qui permet de changer la valeur de l'id du client
     * 
     * @param ?Client $idClient
     * 
     * @return idClient
     */
    public function setIdClient(?Client $idClient): self
    {
        $this->idClient = $idClient;

        return $this;
    }


    /**
     * Fonction qui permet de récupérer l'id du collaborateur
     * 
     * @return idCollaborateur  
     */
    public function getIdCollaborateur(): ?Collaborateur
    {
        return $this->idCollaborateur;
    }

    /**
     * Fonction qui permet de changer la valeur de l'id du collaborateur
     * 
     * @param ?Collaborateur $idCollaborateur 
     * 
     * @return idCollaborateur
     */
    public function setIdCollaborateur(?Collaborateur $idCollaborateur): self
    {
        $this->idCollaborateur = $idCollaborateur;

        return $this;
    }

    /**
     * Fonction qui permet de récupérer l'id de prestation
     * 
     * @return idPrestation
     */
    public function getIdPrestation(): ?Prestation
    {
        return $this->idPrestation;
    }

    /**
     * Fonction qui permet de changer la valeur de l'id de la prestation
     * 
     * @param ?Prestation $idPrestation
     * 
     * @return idPrestation
     */
    public function setIdPrestation(?Prestation $idPrestation): self
    {
        $this->idPrestation = $idPrestation;

        return $this;
    }

    /**
     * Fonction qui permet de récupérer la date du rendez-vous
     * 
     * @return dateRendezVous
     */
    public function getDateRendezVous(): ?\DateTimeInterface
    {
        return $this->dateRendezVous;
    }

    /**
     * Fonction qui permet de changer la valeur de la date du rendez-vous
     * 
     * @param \DateTimeInterface $dateRendezVous
     * 
     * @return dateRendezVous
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
    public function getClient(){
        return $this->Client.getClient();
    }

    /**
     * Fonction qui permet de récuperer les données d'un collaborateur qui sont son nom et son prénom
     * 
     * @return Collaborateur.getCollaborateur()
     */
    public function getCollaborateur(){
        return $this->Collaborateur.getCollaborateur();
    }

    /**
     * Fonction qui permet de récuperer la donnée d'une prestation qui est son nom 
     * 
     * @return Prestation.getPrestation()
     */
    public function getPrestation(){
        return $this->Prestation.getPrestation();
    }
}

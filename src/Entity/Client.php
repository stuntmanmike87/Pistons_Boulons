<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ClientRepository::class)
 */
class Client
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     *@ORM\Column(type="string", length=255)
     *@Assert\NotBlank(message="Le nom ne peut pas être vide.")
     * @Assert\Length(
     *      min = 1,
     *      max = 50,
     *      minMessage = "Le nom doit comporter au moins {{ limit }} caractères ",
     *      maxMessage = "Le nom ne doit pas comporter plus de  {{ limit }} caractères"
     * )
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Le nom ne peut pas contenir de chiffre"
     * )
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le prénom ne peut pas être vide.")
     * @Assert\Length(
     *      min = 1,
     *      max = 50,
     *      minMessage = "Le prénom doit comporter au moins {{ limit }} caractères ",
     *      maxMessage = "Le prénom ne doit pas comporter plus de  {{ limit }} caractères"
     *  )
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Le prénom ne peut pas contenir de chiffre"
     * )
     */
    private $prenom;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank(message="La date de première saisie ne peut pas être vide.")
     * @Assert\Range(
     *      min = "-50 years",
     *      max = "now",
     *      maxMessage="La date de première saisie ne peut pas être supérieure à la date du jour.",
     *      minMessage="La date de première saisie est trop ancienne."
     * )
     */
    private $datePremiereSaisie;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="L'adresse ne peut pas être vide.")
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le type de véhicule ne peut pas être vide.")
     */
    private $typeVehicule;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="La plaque d'immatriculation ne peut pas être vide.")
     * @Assert\Length(
     *      min = "9",
     *      max = "10",
     *      maxMessage="La plaque d'immatriculation ne peut être pas supérieur à {{ limit }} caractères.",
     *      minMessage="La plaque d'immatriculation ne peut être pas inférieur à {{ limit }} caractères."
     * )
     */
    private $plaqueImmat;
    //  * @Assert\Regex(
    //  * pattern="/^[A-Z]{2}[-]\d{3}[-][A-Z]{2}$/",
    //  * match=false,
    //  * message="La plaque d'immatriculation n'est pas valide"
    //  * ) 

    // /[A-Z]{1,2}+\d{1.4}+[A-Z]{1,2}|\d{1,4}+[A-Z]{1,4}+\d{1,2}/
    // |\d{1,4}[A-Z]{1,4}\d{1,2}
    // /^[A-Z]{2}[-]\d{3}[-][A-Z]{2}$/

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * 
     */
    private $isActif;

    // GETTERS / SETTERS
    /**
     * Fonction qui permet de récupérer l'id du client
     * 
     * @return id
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Fonction qui permet de récupérer le nom du client
     * 
     * @return nom
     */
    public function getNom(): ?string
    {
        return $this->nom;
    }

    /**
     * Fonction qui permet de changer la valeur du nom du client
     * 
     * @param string $nom 
     * 
     * @return nom
     */
    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Fonction qui permet de récupérer le prénom du client
     * 
     * @return prenom
     */
    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    /**
     * Fonction qui permet de changer la valeur du prénom du client
     * 
     * @param string $prenom 
     * 
     * @return prénom
     */
    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Fonction qui permet de récupérer la date de première saisie du client
     * 
     * @return datePremiereSaisie
     */
    public function getDatePremiereSaisie(): ?\DateTimeInterface
    {
        return $this->datePremiereSaisie;
    }

    /**
     * Fonction qui permet de changer la valeur de la date de première saisie du client
     * 
     * @param \DateTimeInterface $datePremiereSaisie
     * 
     * @return datePremiereSaisie
     */
    public function setDatePremiereSaisie(\DateTimeInterface $datePremiereSaisie): self
    {
        $this->datePremiereSaisie = $datePremiereSaisie;

        return $this;
    }

    /**
     * Fonction qui permet de récupérer l'adresse du client
     * 
     * @return adresse
     */
    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    /**
     * Fonction qui permet de changer la valeur de l'adresse du client
     * 
     * @param string $adresse
     * 
     * @return adresse
     */
    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Fonction qui permet de récupérer le type de véhicule du client
     * 
     * @return typeVehicule
     */
    public function getTypeVehicule(): ?string
    {
        return $this->typeVehicule;
    }

    /**
     * Fonction qui permet de changer la valeur du type de véhicule du client
     * 
     * @param string $typeVehicule
     * 
     * @return typeVehicule
     */
    public function setTypeVehicule(string $typeVehicule): self
    {
        $this->typeVehicule = $typeVehicule;

        return $this;
    }

    /**
     * Fonction qui permet de récupérer la plaque d'immatriculation du client
     * 
     * @return plaqueImmat
     */
    public function getPlaqueImmat(): ?string
    {
        return $this->plaqueImmat;
    }

    /**
     * Fonction qui permet de changer la valeur de la plaque d'immatriculation du client
     * 
     * @param string $plaqueImmat
     * 
     * @return plaqueImmat
     */
    public function setPlaqueImmat(string $plaqueImmat): self
    {
        $this->plaqueImmat = $plaqueImmat;

        return $this;
    }
    /**
     * Fonction qui permet de récupérer si le client est actif ou pas
     * 
     * @return isActif
     */
    public function getIsActif(): ?bool
    {
        return $this->isActif;
    }
    /**
     * Fonction qui permet de changer la valeur de l'activité du client du client
     * 
     * @param bool $isActif
     * 
     * @return isActif
     */
    public function setIsActif(?bool $isActif): self
    {
        $this->isActif = $isActif;

        return $this;
    }
    /**
     * Fonction qui permet de récupérer le client avec son nom , son prénom et sa plaque d'immatriculation
     * 
     * @return String
     */
    public function getClient()
    {
        return $this->nom . ' ' . $this->prenom . ' - Véhicule : ' . $this->typeVehicule . " - Immatriculation : " . $this->plaqueImmat;
    }
    /**
     * Fonction qui permet de récupérer le client avec son nom , son prénom
     * 
     * @return String
     */
    public function getIdentiteClient()
    {
        return $this->nom . ' ' . $this->prenom;
    }
}

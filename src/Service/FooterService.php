<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\ContentRepository;
use Twig\Extension\AbstractExtension;

final class FooterService extends AbstractExtension
{
    /**
     * Constructeur du service
     */
    public function __construct(private readonly ContentRepository $footerRepository)
    {
    }

    /**
     * Fonction permettant de récupérer le contenu de contact_horaires
     * return array<mixed>
     * array<array<string>>
     */
    public function getGarageHoraires(): mixed
    {
        return $this->footerRepository->findOneByPosition('contact_horaires');   
    }

    /**
     * Fonction permettant de récupérer le contenu de contact_telephone
     * return array<mixed>
     * array<array<string>>
     */
    public function getGarageTelephone(): mixed
    {
        return $this->footerRepository->findOneByPosition('contact_telephone');   
    }

    /**
     * Fonction permettant de récupérer le contenu de contact_adresse
     * return array<mixed>
     * array<array<string>>
     */
    public function getGarageAdresse(): mixed
    {
        return $this->footerRepository->findOneByPosition('contact_adresse'); 
    }

    /**
     * Fonction permettant de récupérer le contenu de contact_email
     * return array<mixed>
     * array<array<string>>
     */
    public function getGarageEmail(): mixed
    {  
        return $this->footerRepository->findOneByPosition('contact_email');   
    }

}
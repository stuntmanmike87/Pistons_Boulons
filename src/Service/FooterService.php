<?php

namespace App\Service;

use App\Repository\ContentRepository;
use Symfony\Contracts\Translation\TranslatorInterface;
use Twig\Extension\AbstractExtension;

class FooterService
    extends AbstractExtension
{
    /**
     * @var $footerRepository
     */
    private $footerRepository;
    /**
     * Constructeur du service
     * @param ContentRepository $footerRepository
     */
    public function __construct(ContentRepository $footerRepository)
    {
        $this->footerRepository = $footerRepository;
    }
    /**
     * Fonction permettant de récupérer le contenu de contact_horaires
     * @return Array 
     */
    public function getGarageHoraires()
    {
        return $this->footerRepository->findOneByPosition('contact_horaires');   
    }
    /**
     * Fonction permettant de récupérer le contenu de contact_telephone
     * @return Array 
     */
    public function getGarageTelephone()
    {
        return $this->footerRepository->findOneByPosition('contact_telephone');   
    }
       /**
     * Fonction permettant de récupérer le contenu de contact_adresse
     * @return Array 
     */
    public function getGarageAdresse()
    {
        return $this->footerRepository->findOneByPosition('contact_adresse'); 
    }
       /**
     * Fonction permettant de récupérer le contenu de contact_email
     * @return Array 
     */
    public function getGarageEmail()
    {  
        return $this->footerRepository->findOneByPosition('contact_email');   
    }

}
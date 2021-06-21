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

    public function __construct(ContentRepository $footerRepository)
    {
        $this->footerRepository = $footerRepository;
    }

    public function getGarageHoraires()
    {
       
        return $this->footerRepository->findOneByPosition('contact_horaires');
        
    }
    public function getGarageTelephone()
    {
       
        return $this->footerRepository->findOneByPosition('contact_telephone');
        
    }
    public function getGarageAdresse()
    {
       
        return $this->footerRepository->findOneByPosition('contact_adresse');
        
    }
    public function getGarageEmail()
    {
       
        return $this->footerRepository->findOneByPosition('contact_email');
        
    }

}
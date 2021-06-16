<?php

namespace App\Service;

use App\Repository\ContentRepository;
use Symfony\Contracts\Translation\TranslatorInterface;
use Twig\Extension\AbstractExtension;

class ConfigService
    extends AbstractExtension
{
    /**
     * @var $configRepository
     */
    private $configRepository;

    public function __construct(ContentRepository $configRepository)
    {
        $this->configRepository = $configRepository;
    }

    public function getGarageHoraires()
    {
       
        return $this->configRepository->findOneByPosition('contact_horaires');
        
    }
    public function getGarageTelephone()
    {
       
        return $this->configRepository->findOneByPosition('contact_telephone');
        
    }
    public function getGarageAdresse()
    {
       
        return $this->configRepository->findOneByPosition('contact_adresse');
        
    }
    public function getGarageEmail()
    {
       
        return $this->configRepository->findOneByPosition('contact_email');
        
    }

}
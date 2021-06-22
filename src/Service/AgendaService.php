<?php

namespace App\Service;


use Twig\Extension\AbstractExtension;
use Symfony\Contracts\Translation\TranslatorInterface;
use App\Repository\RendezVousRepository;
use App\Controller\Month;
use App\Controller\RendezVousController;

class AgendaService
    extends AbstractExtension
{
      /**
     * @var Month $month 
     */
    private Month $month;
  
    public function __construct(RendezVousController $myControlleur)
    {
        if(is_null($myControlleur->getMonth())){
            $this->month = new Month();
        }else{
            $this->month = $myControlleur->getMonth();
        }
    }
    public function toString():string
    {
        return $this->month->toString();
    }
    public function getStartingDay(): \DateTime
    {
        return $this->month->getStartingDay();
    }
    public function getWeeks():int
    {
        return $this->month->getWeeks();
    }
    public function getPreviousMonth():Month
    {
        return $this->month->previousMonth();
    }
    public function getNextMonth():Month
    {
        return $this->month->nextMonth();
    }
    public function withInMonth($date):bool
    {
        return $this->month->withinMonth($date);
    }
    public function getMonth():Month
    {
        return $this->month;
    }

    public function setMonth(?int $month = null ,?int $year = null)
    {
        $this->month = new Month($month,$year);
    }

     /**
     * Cette fonction permet de récuperer les événements classés par jour entre les deux dates entrées en paramètres
     * 
     * @param DateTime $start : début de la période de sélection des events
     * @param DateTime $end : fin de la période de sélection des events
     * 
     * @return Array[events] avec les données des rendez vous pour chaque jour entre les deux dates placées en param
     */
    public function getEventsBetweenByDay (\DateTime $debut, \DateTime $fin, RendezVousRepository $myRepository): array
    {
        $events = $myRepository->findAllByDateRendezVous($debut,$fin);
        $days = [];
        foreach($events as $events){
            $date = explode(' ',$events['dateRendezVous'])[0];
            if (!isset($days[$date])){
                $days[$date] = [$events];
            }else{
                $days[$date][] = $events;
            }
        }
        return $days;
    }
 
   

}
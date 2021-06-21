<?php

namespace App\Service;


use Twig\Extension\AbstractExtension;
use App\Controller\Events;
use App\Controller\Month;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class AgendaService
    extends AbstractExtension
{
    
      /**
     * @var $footerRepository
     */
    private Month $month;

    public function __construct()
    {
        $this->month = new Month();
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

}
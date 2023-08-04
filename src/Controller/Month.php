<?php

declare(strict_types=1);

namespace App\Controller;

use DateTime;
final class Month {

    /** @var array<string> $days */
    public array $days =["Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi","Dimanche"];

    /** @var array<string> $jours */
    public array $jours =["Lun","Mar","Mer","Jeu","Ven","Sam","Dim"];

    /** @var array<string> $months */
    private array $months = ['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre',"Novembre","Décembre"];

    public int $month;

    public int $year;

    public mixed $toString;

    public mixed $start;

    /**
     * Cette fonction permet de créer une occurence d'un mois 
     * @param int $month : correspond au mois
     * @param int $year  : correspond à l'année
     */
    public function __construct(?int $month = null, ?int $year = null)
    {
        if($month === null || $month<1 || $month >12 ){
            $month = (int) date('m');
        }

        if($year === null){
            $year = (int) date('Y');
        }

        $this->month = $month;
        $this->year = $year;
    }

    /**
     * Cette fonction permet de visualiser notre occurence
     * @return String
     */
    public function toString(): string
    {
        return $this->months[$this->month -1]. ' '. $this->year;
    }

    /**
     * Cette fonction permet de connaitre le premier jour du mois en question
     * @return DateTime
     */
    public function getStartingDay(): DateTime
    {
        return new DateTime(sprintf('%d-%d-01', $this->year, $this->month));
    }

   /**
     * Cette fonction permet de connaitre le nombre de semaines dans le mois
     *  @return Int
     */
    public function getWeeks(): int
    {
        $start = $this->getStartingDay();
        $end = (clone $start)->modify('+1 month -1 day');
        $weeks =  (int) $end->format('W')- (int) $start->format('W')+ 1;

        if ($weeks < 0) {
            $weeks  = (int) $end->format('W');
        }

        return $weeks;
    }

     /**
     * Cette fonction permet de savoir si le jour placé en paramètre est dans le mois actuel
     * @param DateTime $date : date 
     * @return bool
     */
    public function withinMonth (DateTime $date): bool
    {
        return $this->getStartingDay()->format('Y-m') === $date->format('Y-m');
    }

     /**
     * Cette fonction créer le mois suivant 
     * @return Month
     */
    public function nextMonth() :Month
    {
        $month = $this->month +1;
        $year = $this->year ;

        if ($month>12 ){
            $month = 1;
            ++$year;
        }

        return new Month($month, $year);
    }

    /**
     * Cette fonction créer le mois précedent 
     * @return Month
     */
    public function previousMonth(): Month
    {
        $month = $this->month -1;
        $year = $this->year ;

        if ($month<1 ){
            $month = 12;
            --$year;
        }

        return new Month($month, $year);
    }
} 

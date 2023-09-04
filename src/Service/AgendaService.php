<?php

declare(strict_types=1);

namespace App\Service;

use App\Controller\Month;
use App\Controller\RendezVousController;
use App\Repository\RendezVousRepository;
use DateTime;
use Twig\Extension\AbstractExtension;

final class AgendaService extends AbstractExtension
{
    /** @var Month $month */
    private Month $month;

    /**
     * Constructeur du service
     */
    public function __construct(RendezVousController $myControlleur)
    {
        $this->month = is_null($myControlleur->getMonth()) ? new Month() : $myControlleur->getMonth();
    }

    /**
     * Fonction permettant de récuperer le mois sous forme d'une chaine de caractères
     */
    public function toString(): string
    {
        return $this->month->toString();
    }

    /**
     * Fonction permettant de récupérer le premier jour du mois
     */
    public function getStartingDay(): DateTime
    {
        return $this->month->getStartingDay();
    }

    /**
     * Fonction permettant de récupérer le nombre de semaine du mois
     */
    public function getWeeks(): int
    {
        return $this->month->getWeeks();
    }

    /**
     * Fonction permettant de récupérer le mois précédent
     */
    public function getPreviousMonth(): Month
    {
        return $this->month->previousMonth();
    }

    /**
     * Fonction permettant de récupérer le mois suivant
     */
    public function getNextMonth(): Month
    {
        return $this->month->nextMonth();
    }

    /**
     * Fonction permettant de savoir si la date placée en param est dans le mois actuel
     */
    public function withInMonth(DateTime $date): bool
    {
        return $this->month->withinMonth($date);
    }

    /**
     * Fonction permettant de récuperer le mois
     */
    public function getMonth(): Month
    {
        return $this->month;
    }

    /**
     * Fonction permettant de savoir si la date placée en param est dans le mois actuelle
     */
    public function setMonth(?int $month = null ,?int $year = null): void
    {
        $this->month = new Month($month,$year);
    }

    /**
     * Cette fonction permet de récuperer les événements classés par jour 
     * entre les deux dates entrées en paramètres
     *
     * param DateTime $start : début de la période de sélection des events
     * param DateTime $end : fin de la période de sélection des events
     *
     * return Array[events] avec les données des rendez vous pour chaque jour 
     * entre les deux dates placées en param
     *
     * @return array<mixed>
     */
    public function getEventsBetweenByDay (DateTime $debut, DateTime $fin, RendezVousRepository $myRepository): array
    {
        $events = $myRepository->findAllByDateRendezVous($debut, $fin);
        $days = [];
        /** @var array<string> $event *//** @var array<string> $events */
        foreach($events as $event){//Foreach overwrites $events with its value variable.
            $date = explode(' ', (string) $events['dateRendezVous'])[0];
            if (!isset($days[$date])){
                $days[$date] = [$events];
            }else{
                $days[$date][] = $events;
            }
        }

        return $days;
    }

}

<?php 
namespace App\Controller;

class Events {


    /**
     * Cette fonction permet de récuperer les événements entre les deux dates entrées en paramètres
     * 
     * @param DateTime $start : début de la période de sélection des events
     * @param DateTime $end : fin de la période de sélection des events
     * 
     * @return Array avec les données des rendez vous entre les deux dates placées en param 
     */
    public function getEventsBetween( \DateTime $start, \DateTime $end) : array{
        
        $pdo = new \PDO('mysql:hosy=localhost;dbname=calendar','root','',[
            \PDO::ATTR_ERRMODE=> \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE=> \PDO::FETCH_ASSOC
            ]);

        $sql ="SELECT * FROM events WHERE start BETWEEN '{$start->format('Y-m-d 00:00:00')}' AND  '{$end->format('Y-m-d 23:59:59')}' ";
        $statement = $pdo->query($sql);
        $results = $statement->fetchAll(); 
        return $results;
    } 
     /**
     * Cette fonction permet de récuperer les événements classés par jour entre les deux dates entrées en paramètres
     * 
     * @param DateTime $start : début de la période de sélection des events
     * @param DateTime $end : fin de la période de sélection des events
     * 
     * @return Array[events] avec les données des rendez vous pour chaque jour entre les deux dates placées en param
     */
    public function getEventsBetweenByDay (\DateTime $start, \DateTime $end): array{
        $events = $this->getEventsBetween($start,$end);
        $days = [];
        foreach($events as $events){
            $date = explode(' ',$events['start'])[0];
            if (!isset($days[$date])){
                $days[$date] = [$events];
            }else{
                $days[$date][] = $events;
            }
        }
        return $days;
    }
}
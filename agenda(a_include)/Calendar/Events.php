<?php 
namespace Calendar;

class Events {

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
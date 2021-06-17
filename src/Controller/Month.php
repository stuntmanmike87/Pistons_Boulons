<?php
namespace App\Controller;

class Month {

    public $days =["Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi","Dimanche"];
    public $jours =["Lun","Mar","Mer","Jeu","Ven","Sam","Dim"];
    private $months = ['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre',"Novembre","Décembre"];
    public $month;
    public $year;
   /**
     * Cette fonction permet de créer une occurence d'un mois 
     * @param int $month : correspond au mois
     * @param int $year  : correspond à l'année
     * 
     */
    public function __construct(?int $month = null ,?int $year = null){
        if($month === null || $month<1 || $month >12 ){
            $month = intval(date('m'));
        }
        if($year === null){
            $year = intval(date('Y'));
        }
        $this->month = $month;
        $this->year = $year;
    }


     /**
     * Cette fonction permet de visualiser notre occurence
     * 
     */
    public function toString(): string{
        return $this->months[$this->month -1]. ' '. $this->year;
    }
    /**
     * Cette fonction permet de connaitre le premier jour du mois en question
     */
    public function getStartingDay(): \DateTime{
        return new \DateTime("{$this->year}-{$this->month}-01");
    }
   /**
     * Cette fonction permet de connaitre le nombre de semaines dans le mois
     */
    public function getWeeks (): int {
        $start = $this->getStartingDay();
        $end = (clone $start)->modify('+1 month -1 day');
        $weeks =  intval($end->format('W'))- intval($start->format('W'))+ 1;
        if ($weeks < 0 ){
            $weeks  = intval($end->format('W'));
        }
        return $weeks;
    }
  
     /**
     * Cette fonction permet de savoir si le jour placé en paramètre est dans le mois actuel
     * @param DateTime $date : date 
     */
    public function withinMonth (\DateTime $date):bool {
        return $this->getStartingDay()->format('Y-m') === $date->format('Y-m');
    }

     /**
     * Cette fonction créer le mois suivant 
     * @return Month
     */
    public function nextMonth() :Month{
        $month = $this->month +1;
        $year =$this ->year ;
        if ($month>12 ){
            $month = 1;
            $year += 1;
        }
        return new Month($month,$year);
    }
    /**
     * Cette fonction créer le mois précedent 
     * @return Month
     */
    public function previousMonth() :Month{
        $month = $this->month -1;
        $year =$this ->year ;
        if ($month<1 ){
            $month = 12;
            $year -= 1;
        }
        return new Month($month,$year);
    }
} 

?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<link  rel="stylesheet" href="../public/css/calendar.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-dark bg-primary mb-3">
    <a href="/index.php" class="navbar-brand">Mon calendrier</a>
</nav>
<?php
require '../src/Calendar/Month.php';
require '../src/Calendar/Events.php';
$events = new Calendar\Events();
$month = new Calendar\Month($_GET['month'] ?? null ,$_GET['year'] ?? null);
$start = $month->getStartingDay();
$weeks =$month->getWeeks();
$start = $start->format('N')=== '1' ? $start : $month->getStartingDay()->modify("last monday");
$end = (clone $start)->modify('+'.(6 + 7* $weeks - 1) .'days');
$events = $events->getEventsBetweenByDay($start,$end);
?>

<div class="d-flex flex-row align-items-center justify-content-between mx-sm-3">

<h1><?= $month->toString();?></h1>
<div>
    <a href="index.php?month=<?= $month->previousMonth()->month ?>&year=<?= $month->previousMonth()->year; ?>" class="btn btn-primary">&lt;</a>
    <a href="index.php?month=<?= $month->nextMonth()->month ?>&year=<?= $month->nextMonth()->year; ?>" class="btn btn-primary">&gt;</a>
</div>

</div>
<table class="calendar__table calendar__table--<?= $weeks; ?>weeks">
<?php for ($i = 0; $i < $weeks; $i++):?>
    <tr>
        <?php foreach($month-> days as $k => $day): 
            $date = (clone $start)->modify("+" . ( $k + $i * 7 ) . "days");
            $eventsForDay = $events[$date->format('Y-m-d')] ?? [];
        ?>
        <td class="<?= $month->withinMonth($date) ? '' : 'calendar__othermonth';?> ">
            <?php if ($i===0):?>
            <div class="calendar__weekday"><?= $day ; ?></div>
            <?php endif;?>
            <div class="calendar__day"><?= $date ->format('d');?></div>
            <?php foreach($eventsForDay as $event): ?>
            <div class="<?= $month->withinMonth($date) ? '' : 'calendar__event__othermonth';?> calendar__event">
                <?= (new DateTime($event['start']))->format('H:i');?> -  <?= $event['name'];?> 
            </div>
            <?php endforeach;?>
        </td>
        <?php endforeach;?>
   </tr>
<?php endfor; ?>
</table>
</body>
</html>
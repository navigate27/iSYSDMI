<?php
// ADD DAYS TO A CERTAIN DATE
// $bdays = 6;
// echo date('Y-m-d', strtotime("+$bdays days"));

// GET THE HOW MANY DAYS BETWEEN THE DATE

$date1 = new DateTime("2010-07-09");
$date2 = new DateTime("2010-07-06");

echo $diff = $date2->diff($date1)->format("%a");

?>

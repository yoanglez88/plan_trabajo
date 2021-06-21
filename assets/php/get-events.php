<?php
require dirname(__FILE__) . '/utils.php';
require dirname(__FILE__) . '/../../include/config.php';
require dirname(__FILE__) . '/../../vendor/autoload.php';

if (!isset($_GET['start']) || !isset($_GET['end'])) {
  die("Por favor, se necesita un rango de fecha inicio y fin.");
}

// ISO8601 cadenas sin zona de tiempo, como "2013-12-29".
$range_start = parseDateTime($_GET['start']);
$range_end = parseDateTime($_GET['end']);

$time_zone = null;
if (isset($_GET['timeZone'])) {
  $time_zone = new DateTimeZone($_GET['timeZone']);
}

$db = new Db(DBHost, DBPort, DBName, DBUser, DBPassword);
$input_arrays = $db->query("SELECT * FROM scheduled_tasks WHERE start BETWEEN ? AND ?", array($range_start->format('Y-m-d'), $range_end->format('Y-m-d')));

$output_arrays = array();
foreach ($input_arrays as $array) {
  $event = new Event($array, $time_zone);
  if ($event->isWithinDayRange($range_start, $range_end)) {
    $output_arrays[] = $event->toArray();
  }
}

echo json_encode($output_arrays);

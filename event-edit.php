<?php
include("db.inc.php");
if (isset($_POST['event_id'])) {
	$event_id = trim($_POST['event_id']);
	$location = trim($_POST['location']);
	$status = trim($_POST['status']);
	$max_sum = trim($_POST['total_sum']);
	$deadline = trim($_POST['deadline']);
	$editSql = "UPDATE event SET event_location = '" . $location . "', max_sum = "
		. $max_sum . ", deadline = '" . $deadline . "', status = '" . $status . "' WHERE event_id = " . $event_id;
	mysql_query("SET NAMES 'utf8'"); 
	$result = mysql_query($editSql);
}
echo "<script> location.href='event.php?event_id=" . $event_id . "';</script>";
?>
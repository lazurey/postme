<?php
include("db.inc.php");
if (isset($_POST['event_id'])) {
	$event_id = trim($_POST['event_id']);
	$sql = "DELETE from user_event WHERE event_id = " . $event_id . " AND uid = " . $_COOKIE['uid'];
	mysql_query("SET NAMES 'utf8'"); 
	$result = mysql_query($sql);
}
?>
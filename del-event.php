<?php
	include("db.inc.php");
	if (isset($_POST['event_id'])) {
		$event_id = trim($_POST['event_id']);
		$sql = "DELETE from event WHERE event_id = " . $event_id;
		mysql_query("SET NAMES 'utf8'"); 
		$result = mysql_query($sql);
	}
?>
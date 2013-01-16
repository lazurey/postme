<?php
include("db.inc.php");
if (isset($_POST['event_id'])) {
	$post_users = trim($_POST['post_users']);
	$event_id = trim($_POST['event_id']);
	$sql = "UPDATE user_event SET status = 2 WHERE event_id = " . $event_id . " AND uid in (" . $post_users . ")";
	print $sql;
	mysql_query("SET NAMES 'utf8'"); 
	$result = mysql_query($sql);
}
?>
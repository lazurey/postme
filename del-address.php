<?php
	include("db.inc.php");
	if (isset($_POST['addr_id'])) {
		$addr_id = trim($_POST['addr_id']);
		$sql = "DELETE from address WHERE addr_id = " . $addr_id;
		mysql_query("SET NAMES 'utf8'"); 
		$result = mysql_query($sql);
	}
?>
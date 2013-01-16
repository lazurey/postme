<?php
include("db.inc.php");
if (isset($_POST['addr_id'])) {
	$addr_tag = trim($_POST['addr_tag']);
	$address = trim($_POST['address']);
	$addr_id = trim($_POST['addr_id']);
	if ($addr_tag == "" || $addr_tag == null) {
		$addr_tag = "默认地址";
	}
	$sql = "UPDATE address SET addr_tag = '" . $addr_tag . "', address = '" . $address . "' WHERE addr_id = " . $addr_id;
	mysql_query("SET NAMES 'utf8'"); 
	$result = mysql_query($sql);
}
?>
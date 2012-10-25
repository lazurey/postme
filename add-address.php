<?php
include("db.inc.php");
if (isset($_POST['addr_tag'])) {
	$addr_tag = trim($_POST['addr_tag']);
	$address = trim($_POST['address']);
	$status = trim($_POST['addr_status']);
	$uid = $_COOKIE['uid'];
	$remark = "";
	if ($status == "" || $status == null) {
		$status = "1"; // 1-public; 2-promoter only; 3-private
	}
	if ($addr_tag == "" || $addr_tag == null) {
		$addr_tag = "默认地址";
	}
	$sql = "INSERT INTO address (addr_id, uid, addr_tag, address, status, remark) VALUES ('', " . $uid . ", '" .
		$addr_tag . "', '" . $address . "', '" . $status . "', '" . $remark . "')";
	mysql_query("SET NAMES 'utf8'"); 
	$result = mysql_query($sql);
} else {
}
?>
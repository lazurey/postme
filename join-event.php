<?php
include("db.inc.php");
if (isset($_POST['addr_id']) && isset($_COOKIE['uid'])) {
	$addr_id = trim($_POST['addr_id']);
	$event_id = trim($_POST['event_id']);
	$status = trim($_POST['addr_status']);
	$uid = $_COOKIE['uid'];
	$checkSql = "SELECT * FROM user_event WHERE uid = " . $uid . " and event_id = " . $event_id;
	mysql_query("SET NAMES 'utf8'"); 
	$checkResult = mysql_query($checkSql);
	if (mysql_num_rows($checkResult) > 0) {
		echo "<script>alert('你要过了, 真的!'); location.href='event.php?event_id=" . $event_id . "';</script>";
	} else {
		$sql = "INSERT INTO user_event (uid, event_id, status, remark, addr_id) VALUES (" . $uid .
		 ", " . $event_id . ", '1', '', " . $addr_id . ")";
		mysql_query($sql);
	}
} else {
	echo "<script>alert('出错啦, 重新来过吧!'); location.href='index.php';</script>";
}
?>
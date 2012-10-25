<?php
	setcookie('uid', '', time() - 3600);
	setcookie('uname', '', time() - 3600);
	echo "<script>location.href='index.php';</script>";
?>
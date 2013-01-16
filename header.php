<?php
	include("db.inc.php");
	$loginFlag = false;
	$reqUrl = trim($_SERVER["REQUEST_URI"]);
	$frontFlag = false;
	if (preg_match("/index.php/i", $reqUrl) || preg_match("/register.php/i", $reqUrl)) {
		$frontFlag = true;
	}
	if (isset($_COOKIE['uid'])) {
		$loginFlag = true;
	} else {
		if (!$frontFlag) {
			echo "<script> location.href='login.php';</script>";
		}
	}
?>
<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
  <head>
  	<meta http-equiv="content-Type" content="text/html; charset=utf-8">
    <title>Monoers' Postcard</title>
    <!-- Bootstrap -->
    <script src="../demo/jquery-ui/js/jquery-1.8.2.min.js"></script>
	<script src="../demo/jquery-ui/js/jquery-ui-1.8.24.custom.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="bootstrap/js/custom.js"></script>
	<link href="bootstrap/css/bootstrap.css" rel="stylesheet">
	<link href="bootstrap/css/custom.css" rel="stylesheet">
	<link type="text/css" href="../demo/jquery-ui/css/ui-darkness/jquery-ui-1.8.24.custom.css" rel="stylesheet" />
	
	<script type="text/javascript">
		$(document).ready(function(){
			var is_chrome = navigator.userAgent.toLowerCase().indexOf('chrome') > -1;
			if (!is_chrome) {
				$('#browser-alert').append("<p>请使用<a href='www.google.com/chrome'>Chrome浏览器</a>获得最佳效果</p>");
			}
		});
		
	</script>
  </head>
  <body>
<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			<a class="brand" href="index.php">Mono
			</a>
			<div class="nav-collapse collapse">
				<ul class="nav">
					<li>
						<a href="index.php">首页</a>
					</li>
					<li>
						<a href="events.php">活动</a>
					</li>
					<li>
						<a href="my-address.php">地址薄</a>
					</li>
					<li>
						<a href="about.php">关于</a>
					</li>
				</ul>
				<ul class="nav pull-right">
					<li id="browser-alert">
					</li>
					<?php
						if ($loginFlag) {
					?>
					<li>
						<a href="my-setting.php"><i class="icon-wrench icon-white"></i> <?php echo $_COOKIE['uname'];?></a>
					</li>
					<li>
						<a href="logout.php">退出</a>
					</li>
					<?php
						} else {
					?>
						<li><a href="login.php">登录</a></li>
					<?php
						}
					?>
				</ul>
			</div>
		</div>
	</div>
</div>
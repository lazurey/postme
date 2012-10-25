<?php
  include("db.inc.php");
  $loginFlag = false;
  if (isset($_COOKIE['uid'])) {
    $loginFlag = true;
  }
  if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $sql = "SELECT * FROM users WHERE email = '" . $email . "' AND pwd = '" . $password . "'";
    mysql_query("SET NAMES utf8");
    $result = mysql_query($sql);
    if (mysql_num_rows($result) == 1) {
      $row = mysql_fetch_array($result);
      setcookie("uid", $row['uid'], time() + 31536000);
      setcookie("uname", $row['id'], time() + 31536000);
      echo "<script>location.href='index.php';</script>";
    } else {
      echo "<script>$('#error-msg').append('账号或密码错误, 忘记密码请联系鹳狸猿.');</script>";
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
          <?php
            if ($loginFlag) {
          ?>
          <li>
            <?php echo $_COOKIE['uname'];?>
            <a href="logout.php">退出</a></li>
          <?php
            } else {
          ?>
            <li><a href="login.php">登陆</a></li>
          <?php
            }
          ?>
        </ul>
      </div>
    </div>
  </div>
</div>    
    <div class="no-head-container container">
      <div class="hero-unit">
        <h1>Monoers' Postcard</h1>
      </div>
      <div class="control-group error">
        <span id="error-msg"></span>
      </div>
      <form class="form-horizontal" action="" method="post" name="loginForm">
        <div class="control-group">
          <label class="control-label" for="inputEmail">Email</label>
          <div class="controls">
            <input type="text" id="inputEmail" placeholder="Email" name="email">
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="inputPassword">Password</label>
          <div class="controls">
            <input type="password" id="inputPassword" placeholder="Password" name="password">
          </div>
        </div>
        <div class="control-group">
          <div class="controls">
            <label class="checkbox">
              <input type="checkbox"> Remember me
            </label>
            <button type="submit" class="btn">Sign in</button>
            <div class="warning" style="padding:5px;">
              <p>还没有账号? <a href="register.php">注册一个</a>吧~</p>
            </div>
          </div>
        </div>
      </form>
    </div>
    <?php
      include("footer.html");
    ?>
  </body>
</html>
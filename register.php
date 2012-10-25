    <?php
      include("header.php");
      if (isset($_POST['email'])) {
        $email = trim($_POST['email']);
        $password = md5(trim($_POST['password']));
        $checkSql = "SELECT * FROM users WHERE email = '" . $email . "'";
        $img = rand(1, 10000);
        $img = $img%7 + 1;
        $img = $img . ".jpg";
        mysql_query("SET NAMES utf8");
        $checkResult = mysql_query($checkSql);
        if (mysql_num_rows($checkResult) > 0) {
          echo "<script>$('#error-msg').append('这个邮件已经注册过了, 忘记密码请联系鹳狸猿.');</script>";
        } else {
          $sql = "INSERT INTO users (uid, id, pwd, img, email) VALUES ('', '" .
              $email . "', '" . $password . "', '" . $img . "', '" . $email . "')";
          mysql_query($sql);
          echo "<script>location.href='login.php';</script>";
        }

      }
    ?>
    <div class="no-head-container container">
      <div class="hero-unit">
        <h1>Monoers' Postcard</h1>
      </div>
      
      <div class="control-group error">
        <span id="error-msg"></span>
      </div>
      <form class="form-horizontal" name="regForm" action="" method="post">
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
          <label class="control-label" for="inputPassword">Repeat Password</label>
          <div class="controls">
            <input type="password" id="repeatPassword" placeholder="Password">
          </div>
        </div>
        <div class="control-group">
          <div class="controls">
            <button type="submit" class="btn">注册</button>
          </div>
        </div>
      </form>
      <div class="control-group error">
        <span id="error-msg">备注: 密码加密不强大, 请不要使用常用密码和银行密码. 地址信息没有加密, 所以不想地址泄露的, 请小心填写地址信息. 谢谢.</span>
      </div>
    </div>
    <?php
      include("footer.html");
    ?>
  </body>
</html>
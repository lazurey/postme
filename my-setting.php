<?php
  include("header.php");
  if (isset($_POST['user_id'])) {
    $flag = false;
    $user_id = trim($_POST['user_id']);
    if ($user_id == "" || $user_id == null) {

    } else {
      $sql = "UPDATE users SET id = '" . $user_id . "' WHERE uid = " . $_COOKIE['uid'];
      mysql_query("SET NAMES utf8");
      mysql_query($sql);
      $flag = true;
    }
  }
?>
  	<div class="no-head-container container">
      <h2>修改我的设置</h2>
      <?php 
        if ($flag) {
          echo "<div class='alert alert-block'>昵称修改成功, 现在为" . $user_id . "</div>";
        }
      ?>
      <form name="new_event" method="post" action="">
        <label for="user_id">昵称</label>
        <input type="text" name="user_id" id="user_id">
        <div class="form-actions">
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
  	</div>
    <?php
      include("footer.html");
    ?>
  </body>
</html>
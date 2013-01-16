<?php
  include("header.php");
  if (isset($_POST['user_id']) || isset($_POST['user_img'])) {
    $flag = false;
    $user_id = trim($_POST['user_id']);
    $user_img = trim($_POST['user_img']);
    $update_flag = 0;
    $sql = "";
    if ($user_id != "" && $user_img != "unchanged") {
      $update_flag = 1; //两项都变
      $sql = "UPDATE users SET id = '" . $user_id . "', img = '" . $user_img . ".png' WHERE uid = " . $_COOKIE['uid'];
      $flag = true;
    } else if ($user_id != "" && $user_img == "unchanged") {
      $update_flag = 2; //只更改昵称
      $sql = "UPDATE users SET id = '" . $user_id . "' WHERE uid = " . $_COOKIE['uid'];
      $flag = true;
    } else if ($user_id == "" && $user_img != "unchanged") {
      $update_flag = 3; //只更改头像
      $sql = "UPDATE users SET img = '" . $user_img . ".png' WHERE uid = " . $_COOKIE['uid'];
    }
    if ($update_flag != 0) {
      mysql_query("SET NAMES utf8");
      mysql_query($sql);
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
        <label for="user_img">头像</label>
        <select id="user_img" name="user_img">
          <option value="unchanged" selected>------选择------</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
          <option value="6">6</option>
          <option value="7">7</option>
          <option value="8">8</option>
        </select>
        <label><small>可选头像</small></label>
        <img id="avatar1" class="user-img" src="images/1.png" />
        <img id="avatar2" class="user-img" src="images/2.png" />
        <img id="avatar3" class="user-img" src="images/3.png" />
        <img id="avatar4" class="user-img" src="images/4.png" />
        <img id="avatar5" class="user-img" src="images/5.png" />
        <img id="avatar6" class="user-img" src="images/6.png" />
        <img id="avatar7" class="user-img" src="images/7.png" />
        <img id="avatar8" class="user-img" src="images/8.png" />
        <div class="form-actions">
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
  	</div>
    <?php
      include("footer.html");
    ?>
  </body>
  <script type="text/javascript">
    $('select').change(function(){
      var img_id = "#avatar" + $(this).val();
      $('.selected-img').removeClass('selected-img');
      $(img_id).addClass("selected-img");
    });
  </script>
</html>
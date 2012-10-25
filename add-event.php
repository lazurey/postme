<?php
  include("header.php");
  if (isset($_POST['location'])) {
    $location = trim($_POST['location']);
    $total_sum = trim($_POST['total_sum']);
    $deadline = trim($_POST['deadline']);
    $remark = trim($_POST['remark']);
    $status = $_POST['status'];
    $uid = $_COOKIE['uid'];
    $event_name = $_COOKIE['uname'] . "要从" . $location . "寄片啦";
    $event_detail = "你猜";

    $sql = "INSERT INTO event (event_id, uid, event_name, event_location, max_sum, remark, event_detail, deadline, status) VALUES (" .
      "'', " . $uid . ", '" . $event_name . "', '" . $location . "', '" . $total_sum . "', '" . $remark . "', '" .
      $event_detail . "', '" . $deadline . "', '" . $status . "') ";
    mysql_query("SET NAMES 'utf8'");
    mysql_query($sql);
    $url = "event.php?event_id=" . mysql_insert_id();
    echo "<script> location.href='" . $url . "';</script>";
  }
?>
  	<div class="no-head-container container">
      <h2>我要寄明信片...</h2>
      <form name="new_event" method="post" action="">
        <label for="location">我在</label>
        <input type="text" name="location" id="location">
        <label for="total_sum">我最多可以给多少人寄...</label>
        <input type="text" name="total_sum" id="total_sum">
        <span class="help-inline">留空为无上限</span>
        <label for="deadline">收集地址到...</label>
        <input id="deadline" type="text" name="deadline">
        <span class="help-inline">留空为长期</span>
        <label for="status">状态</label>
        <select class="span2" name="status" id="status">
          <option value="1">进行中</option>
          <option value="2">已过期</option>
          <option value="3">将来时</option>
        </select>
        <label for="remark">说明</label>
        <textarea name="remark" id="remark"></textarea>
        <div class="form-actions">
          <button type="submit" class="btn btn-primary">Save changes</button>
          <button type="button" class="btn">Cancel</button>
        </div>
      </form>
  	</div>
    <?php
      include("footer.html");
    ?>
    <script type='text/javascript'>
      $(function() {
        $("#deadline").datepicker({
          changeMonth: true,
          changeYear: true
        });
      });
    </script>
  </body>
</html>
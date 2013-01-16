<?php
include("header.php");
if (isset($_GET['event_id'])) {
  $sql = "SELECT * FROM event WHERE event_id = " . $_GET['event_id'];
  mysql_query("SET NAMES utf8");
  $result = mysql_query($sql);
  $flag = false;
  if (mysql_num_rows($result) == 1) {
    $flag = true;
  }
}

if ($flag) {
  $row = mysql_fetch_array($result);
  if ($row['uid'] != $_COOKIE['uid']) {
    echo "<script> location.href='event.php?event_id=" . $_GET['event_id'] . "';</script>";
  }
?>
<script>
$('#event-admin a').click(function (e) {
  e.preventDefault();
  $(this).tab('show');
})
$(function() {
  $("#deadline").datepicker({
    changeMonth: true,
    changeYear: true
  });
});

function delEvent(event_id) {
  if (!confirm("为了防止是你手误点的这个按钮, 所以我还是来话唠一下, 你确认吗?")) {
    return false;
  }
  $.ajax({
      url: "del-event.php",
      data: "event_id=" + event_id,
      type: "POST" 
    }).done(function(data) {
      location.href = "events.php";
    });
}
</script>
    <div class="container no-head-container">
      <h2 style="text-transform:uppercase;">
        <?php 
          echo "<a class='admin-title' href='event.php?event_id=" . $row['event_id'] . "' title='回到活动'>" . $row['event_location'] . "</a>";
          if ($row['status'] == "1") {
            echo '<span class="label label-success">进行中</span>';
          } else {
            echo '<span class="label">已过期</span>';
          }
        ?>
      </h2>
      <div id="event-admin">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#edit-event" data-toggle="tab">编辑</a></li>
          <li><a href="#manage-event" data-toggle="tab">寄片记录</a></li>
          <li><a href="#delete-event" data-toggle="tab">删除活动</a></li>
        </ul>
        <div id="tab-content" class="tab-content">
          <div id="edit-event" class="tab-pane fade active in">
                  <form name="new_event" method="post" action="event-edit.php">
                    <label for="location">我在</label>
                    <?php echo "<input type='text' name='location' id='location' value='" . $row['event_location'] . "'>"; ?>
                    <label for="total_sum">我最多可以给多少人寄...</label>
                    <?php echo "<input type='text' name='total_sum' id='total_sum' value='" . $row['max_sum'] . "'>"; ?>
                    <span class="help-inline">留空为无上限</span>
                    <label for="deadline">收集地址到...</label>
                    <?php echo "<input id='deadline' type='text' name='deadline' value='" . $row['deadline'] . "'>"; ?>
                    <span class="help-inline">留空为长期</span>
                    <label for="status">状态</label>
                    <select class="span2" name="status" id="status">
                      <option value="1">进行中</option>
                      <option value="2">已过期</option>
                      <option value="3">将来时</option>
                    </select>
                    <?php echo "<input type='hidden' name='event_id' value='" . $_GET['event_id'] . "'>"; ?>
                    <br>
                    <?php echo "<button type='submit' class='btn btn-primary' onclick='editEvent(" . $_GET['event_id'] . ");'>"; ?>
                      Save changes</button>
                  </form>
          </div>
          <div id="manage-event" class="tab-pane fade">
            <?php 
              $eventSql = "SELECT a.*, u.id, u.img, ad.address, ad.addr_tag FROM user_event a, users u, address ad WHERE a.addr_id = ad.addr_id and a.uid = u.uid and a.event_id = " . $_GET['event_id'];
              mysql_query("SET NAMES utf8");
              $event_users = mysql_query($eventSql);
              if (mysql_num_rows($event_users) > 0) {
                while ($user = mysql_fetch_array($event_users)) {
                  echo "<div class='span8 well'><img src='images/" . $user['img'] . "'>";
                  echo "<div class='manage-addr'><p>" . $user['id'] . "</p>";
                  echo "<p><i class='icon-envelope'></i><span>" . $user['addr_tag'] . "</span><p></div>";
                  echo "<address>" . $user['address'] . "</address></div>";
                  if ($user['status'] == 1) {
                    echo "<div class='span1 post-block'><label class='checkbox'><input type='checkbox' value='" . $user['uid'] . "' >已寄出</label></div>";
                  } else {
                    echo "<div class='span1 post-block'><span class='label'>已寄出</span></div>";
                  }
                }
              } else {
                echo "<div class='alert alert-block'>还没人参加</div>";
              }
            ?>
            <div class="span8">
              <?php echo "<button type='submit' class='btn btn-primary' onclick='savePostOnes(" . $_GET['event_id'] . ");'>"; ?>
                保存寄出状态</button>
            </div>
          </div>
          <div id="delete-event" class="tab-pane fade">
            <p>做官人太难了, 我放弃, 我忏悔</p>
            <p>
              <?php echo "<button type='submit' class='btn btn-primary' onclick='delEvent(" . $_GET['event_id'] . ");'>"; ?>
                删除该活动</button>
            </p>
          </div>
        </div>
      </div>
  	</div>
<?php
} else {
?>
<div class="no-head-container container">
  <div class="alert alert-block">
    <h4>出错啦!</h4>
    你要访问的活动不存在呢~ 返回<a href="events.php">活动页面</a>吧~
  </div>
</div>
<?php
}
?>

    <?php
      include("footer.html");
    ?>
  </body>
  <script type="text/javascript">
    function savePostOnes(eventId) {
      var postOnes = "";
      $('.checkbox :checked').each(function(){
        postOnes += this.value + ",";
      });
      if (postOnes == "") {
        alert("请选择已寄出的地址");
        return false;
      }
      postOnes = postOnes.substr(0, postOnes.length - 1);
      $.ajax({
        url: "update-post.php",
        data: "event_id=" + eventId + "&post_users=" + postOnes + "",
        type: "POST" 
      }).done(function(data) {
        location.href = "event.php?event_id=" + eventId;
      });
    }
  </script>
</html>
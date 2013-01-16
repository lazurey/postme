<?php
include("header.php");
if (isset($_GET['event_id'])) {
  $sql = "SELECT e.*, u.id FROM event e, users u WHERE e.uid = u.uid and  e.event_id = " . $_GET['event_id'];
  mysql_query("SET NAMES utf8");
  $result = mysql_query($sql);
  $flag = false;
  if (mysql_num_rows($result) == 1) {
    $flag = true;
  }
}
$event_founder_id = "";
if ($flag) {
  $row = mysql_fetch_array($result);
  $event_founder_id = $row['uid'];
  $expireFlag = false;
?>
    <div class="container no-head-container" style="padding-top: 60px;">
      <h2 style="text-transform:uppercase;" class="event-h2">
        <?php echo $row['event_location'];
            $location_len = mb_strlen($row['event_location'], 'UTF8');
            if ($location_len > 8) {
              
            }
            if ($row['status'] == "1") {
              if (time() > strtotime($row['deadline'])) {
                $expireFlag = true;
                echo '<span class="label">已过期</span>';
              } else {
                echo '<span class="label label-success">进行中</span>';
              }
            } else {
              $expireFlag = true;
              echo '<span class="label">已过期</span>';
            }
        ?>
      </h2>
      <div class="span6">
        <dl class="dl-horizontal">
          <dt>发起人 : </dt>
          <dd id="event-founder">
            <?php echo $row['id']; ?>
          </dd>
        </dl>
        <dl class="dl-horizontal">
          <dt>人数上限 : </dt>
          <dd id="total-amount">
            <?php echo $row['max_sum']; ?>
          </dd>
        </dl>
        <dl class="dl-horizontal">
          <dt>截止日期 : </dt>
          <dd id="deadline"><?php echo $row['deadline']; ?></dd>
        </dl>
        <dl class="dl-horizontal">
          <dt>说明 : </dt>
          <dd id="remark"><?php echo $row['remark']; ?></dd>
        </dl>
      </div>
      <div class="span4">
        <?php 
          $isJoined = false;
          $memberSql = "SELECT a.*, b.id, b.img FROM user_event a, users b WHERE a.uid = b.uid and  event_id = " . $_GET['event_id'];
          mysql_query("SET NAMES utf8");
          $memberResult = mysql_query($memberSql);
        ?>
        <span>已参加成员(<span id="user-involved">
          <?php echo mysql_num_rows($memberResult);?>
        </span>)</span>
        <?php 
          if (mysql_num_rows($memberResult) > 0) {?>
            <ul class="unstyled event-member">
            <?php
            while ($row = mysql_fetch_array($memberResult)) {
              if ($row['uid'] == $_COOKIE['uid']) {
                $isJoined = true;
              }
              echo "<li><img src='images/" . $row['img'] . "' />";
              //echo "<p class='user-name'><a href='user.php?uid=" . $row['uid'] . "'>" . $row['id'] . "</a></p></li>";
              echo "<p class='user-name'>" . $row['id'] . "";
              if ($row['status'] == 2) {
                echo "<small><code>已寄出</code></small>";
              }
              echo "</p></li>";

            } ?>
            </ul>
          <?php } else {
            echo "<div class='alert alert-block'>还没人参加</div>";
          } ?>

      </div>
      <div class="clearfix"></div>
      <div class="button-group">
        <?php
          if ($isJoined && $_COOKIE['uid'] != $row['uid'] && !$expireFlag) { 
            echo "<button class='btn' onclick='quitEvent(" . $_COOKIE['uid'] . ", " . $_GET['event_id'] . ");'>" ?>
              <i class='icon-minus'></i> 官人, 我不要了</button>
        <?php } else if ($_COOKIE['uid'] != $event_founder_id && !$expireFlag) {
        ?>
          <a href="#addrSel" role="button" data-toggle="modal">
          <button class="btn btn-success"><i class='icon-plus'></i> 官人, 我要</button></a>
        <?php } ?>
        <?php 
          if ($event_founder_id == $_COOKIE['uid']) {
            echo "<button class='btn btn-info' onclick='location.href=\"event-admin.php?event_id=" . $_GET['event_id'] . "\";'><i class='icon-wrench'></i> 管理活动</button>";
          } else {

          }
        ?>
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
    <!-- Modal -->
    <div class="add-address-layout modal" id="addrSel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display:none;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">选择地址</h3>
      </div>
        <div class="modal-body">
          <?php
            $myAddrSql = "SELECT * FROM address WHERE uid = " . $_COOKIE['uid'];
            mysql_query("SET NAMES utf8");
            $myAddress = mysql_query($myAddrSql);
            $addrHtml = "";
            $checkFlag = true;
            if (mysql_num_rows($myAddress) > 0) {
              $addrHtml .= "<form name='joinEvent' id='joinEvent' method='post' action=''><table class='event-table table table-hover'>";
              while ($row = mysql_fetch_array($myAddress)) {
                $addrHtml .= "<tr><td><input type='radio' name='addr_id' value='" . $row['addr_id'] . "'></td>";
                $addrHtml .= "<td>" . $row['addr_tag'] . "</td>";
                $addrHtml .= "<td>" . $row['address'] . "</td></tr>";
              }
              $addrHtml .= "</table>";
              $addrHtml .= "<input type='hidden' name='event_id' value='" . $_GET['event_id'] . "'>";
            } else {
              $addrHtml .= "<div class='alert alert-block'>你还没有录入过地址, 现在<a href='my-address.php#myModal'>添加一个</a>吧~</div>";
              $checkFlag = false;
            }
            echo $addrHtml;
          ?>
        <div>
          <button class="btn" data-dismiss="modal" aria-hidden="true" id="cancel-btn">取消</button>
          <?php if ($checkFlag) { ?>
          <input type="submit" class="btn btn-primary" value="添加">
          </form>
          <?php } ?>
        </div>
    </div>
<script type="text/javascript">
$("#joinEvent").submit(function(event) {
    event.preventDefault(); 
    var $form = $( this ),
        addr_id = $form.find("input[name='addr_id']:checked").val(),
        event_id = $form.find('input[name="event_id"]').val(),
        url = $form.attr( 'action' );
    if (addr_id == "" || addr_id == null || addr_id.length <= 0 || addr_id == undefined) {
      alert('请选择一个地址!');
    } else {
      $.ajax({
        url: "join-event.php",
        data: "addr_id=" + addr_id + "&event_id=" + event_id + "",
        type: "POST" 
      }).done(function(data) {
        alert("要了官人就会给么?");
        location.href = "event.php?event_id=" + event_id;
      });
    }
  });

function quitEvent(userId, eventId) {
  if (confirm("确认不要了? 官人很想给呢...")) {
    $.ajax({
        url: "quit-event.php",
        data: "event_id=" + eventId + "",
        type: "POST" 
      }).done(function(data) {
        alert("哼, 不要就不要!");
        location.href = "event.php?event_id=" + eventId;
      });
  } else {
    return false;
  }
}
</script>
  </body>
</html>
    <?php
      include("header.php");
      $sql = "SELECT e.*, u.id FROM event e, users u WHERE e.uid = u.uid ORDER BY event_id DESC";
      mysql_query("SET NAMES utf8");
      $result = mysql_query($sql);
      $append_html = "";
      if (mysql_num_rows($result) > 0) {
        while ($row = mysql_fetch_array($result)) {
          $append_html .= "<tr onclick=\"document.location='event.php?event_id=" . $row['event_id'] . "'\">";
          $append_html .= "<td><label class='event-location'>" . $row['event_location'] . "</label></td>";
          $append_html .= "<td><span>" . $row['id'] . "<span><td>";
          $append_html .= "<td><span>" . $row['deadline'] . "</span></td></tr>";
        }
      } else {
        $append_html = "现在还没有人要寄片, <a href='add-event.php'>我来发起一个吧</a>~";
      }
    ?>
  	<div class="no-head-container container">
      <h2>所有的寄片记录
        <a href="add-event.php"><button class="btn"><i class="icon-plus"></i> 我要寄片</button></a>
      </h2>
  		<table class="event-table table table-hover">
        <?php echo $append_html; ?>
      </table>
  	</div>
    <?php
      include("footer.html");
    ?>
  </body>
</html>
  	<?php
      include("header.php");
    ?>
  	<div class="no-head-container container">
  		<div class="hero-unit">
  			<h1>MONOers' Postcard</h1>
        <small>我只能为你寄一张小小的卡片</small>
        <img class="post-img" src="images/poststamp.png" />
  		</div>
  		<div class="row">
        <?php
          $sql = "SELECT * FROM event ORDER BY event_id DESC LIMIT 3";
          mysql_query("SET NAMES utf8");
          $result = mysql_query($sql);
          $i = 1;
          if (mysql_num_rows($result) > 0) {
            while ($row = mysql_fetch_array($result)) {
              echo "<div class='span4'><a class='thumbnail' href='event.php?event_id=" . $row['event_id'] . "'>";
              echo "<img src='images/postcard" . $i . ".jpg' style='height:195px;'></a>";
              echo "<h4>" . $row['event_name'] . "</h4></div>";
              $i++;
            }
          }
        ?>
  		</div>
  	</div>
    <?php
      include("footer.html");
    ?>
  </body>
</html>
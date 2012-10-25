    <?php
      include("header.php");
    ?>
  	<div class="no-head-container container clearfix">
      <h2>管理我的地址簿</h2>
  		<div class="row">
        <div class="span8 clearfix">
        <?php
          $sql = "SELECT * FROM address WHERE uid = " . $_COOKIE['uid'];
          mysql_query("SET NAMES 'utf8'"); 
          $result = mysql_query($sql);
          if (mysql_num_rows($result) > 0) {
            while ($row = mysql_fetch_array($result)) {
              echo "<div class='span7 well'><i class='icon-envelope'></i><span> " . $row['addr_tag'] . "</span>";
              echo "<address>" . $row['address'] . "</address>";
              echo "<a href=''><i class='icon-edit'></i>编辑</a>&nbsp;&nbsp;&nbsp;";
              echo "<a href=''><i class='icon-trash'></i>删除</a>";
              echo "</div>";
            }
          } else {
            echo "<div class='alert alert-block'>你还没有录入过地址, 现在添加一个吧~</div>";
          }
        ?>
        <p id="bottom">&nbsp;</p>
      </div>
      <div class="span4 clearfix">
        <a href="#myModal" role="button" data-toggle="modal">
          <button class="btn"><i class="icon-plus"></i> 添加一个地址</button>
        </a>
      </div>
      <!-- Modal -->
      <div class="add-address-layout modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display:none;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h3 id="myModalLabel">新地址</h3>
        </div>
        <form name="new-addr-form" id="newAddrForm" action="add-address.php">
          <div class="modal-body">
            <div class="control-group">
              <label class="control-label" for="addr_tag">标签</label>
              <div class="controls">
                <input type="text" id="addr_tag" name="addr_tag" placeholder="家里/学校/公司...">
              </div>
            </div>
            <label class="control-label" for="address">地址</label>
            <textarea rows="3" id="address" name="address"></textarea>
            <br>
            <label class="radio inline">
              <input type="radio" name="addr_status" id="inlineCheckbox1" value="1"> 公开
            </label>
            <label class="radio inline">
              <input type="radio" name="addr_status" id="inlineCheckbox2" value="2"> 活动发起人可查看
            </label>
            <label class="radio inline">
              <input type="radio" name="addr_status" id="inlineCheckbox3" value="3"> 私人
            </label>
          </div>
          <div>
            <button class="btn" data-dismiss="modal" aria-hidden="true" id="cancel-btn">取消</button>
            <input type="submit" class="btn btn-primary" value="添加">
          </div>
        </form>
      </div>
  		</div>
  	</div>
    <?php
      include("footer.html");
    ?>
  </body>
  <script type="text/javascript">
  $("#newAddrForm").submit(function(event) {
    event.preventDefault(); 
    var $form = $( this ),
        addr_tag = $form.find( 'input[name="addr_tag"]' ).val(),
        address = $form.find( '#address' ).val(),
        addr_status = $("input[name='addr_status']:checked").val(),
        url = $form.attr( 'action' );
    var addHtml = '<div class="span7 well">' +
          '<i class="icon-envelope"></i><span>' + addr_tag + '</span>' +
          '<address>' + address + '</address>' + 
          '<a href=""><i class="icon-edit"></i>编辑</a>&nbsp;&nbsp;&nbsp;' + 
          '<a href=""><i class="icon-trash"></i>删除</a></div>';
    $.ajax({
      url: "add-address.php",
      data: "addr_tag=" + addr_tag + "&address=" + address + "&addr_status=" +
        addr_status + "",
      type: "POST" 
    }).done(function(data) {
      alert("新增成功!");
      $('#cancel-btn').click();
      $('.container .row div.span8').append(addHtml);
    });
  });
  </script>
</html>
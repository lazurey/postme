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
              echo "<a href='javascript:void(0);' onclick='editAddr(" . $row['addr_id'] . ", \"" . $row['addr_tag'] . "\", \"" . $row['address'] . "\");'><i class='icon-edit'></i>编辑</a>&nbsp;&nbsp;&nbsp;";
              echo "<a href='javascript:void(0);' onclick='delAddr(" . $row['addr_id'] . ");'><i class='icon-trash'></i>删除</a>";
              echo "</div>";
            }
          } else {
            echo "<div class='alert alert-block'>你还没有录入过地址, 现在添加一个吧~</div>";
          }
        ?>
        <p id="bottom">&nbsp;</p>
      </div>
      <div class="span4 clearfix">
        <a href="#myModal" role="button" data-toggle="modal" id="addBtn">
          <button class="btn"><i class="icon-plus"></i> 添加一个地址</button>
        </a>
      </div>
      <!-- Modal -->
      <div class="add-address-layout modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display:none;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h3 id="myModalLabel">编辑地址</h3>
        </div>
        <form name="new-addr-form" id="newAddrForm" action="add-address.php">
          <input type="hidden" id="addr_id" name="addr_id" value="">
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
            <!--
            <label class="radio inline">
              <input type="radio" name="addr_status" id="inlineCheckbox1" value="1"> 公开
            </label>
            <label class="radio inline">
              <input type="radio" name="addr_status" id="inlineCheckbox2" value="2"> 活动发起人可查看
            </label>
            <label class="radio inline">
              <input type="radio" name="addr_status" id="inlineCheckbox3" value="3"> 私人
            </label>
            -->
          </div>
          <div style="margin-left:20px;">
            <button class="btn" data-dismiss="modal" aria-hidden="true" id="cancel-btn">取消</button>
            <input type="submit" class="btn btn-primary" id="saveBtn" value="保存">
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
  function editAddr(addr_id, addr_tag, address) {
    $('#addr_tag').val(addr_tag);
    $('#address').val(address);
    $('#addr_id').val(addr_id);
    $('#addBtn').click();
    //alert("还没写这个功能, 直接删除重新添加吧.");
  }

  function delAddr(addr_id) {
    if (confirm("真删, 没逗你!")) {
      $.ajax({
      url: "del-address.php",
      data: "addr_id=" + addr_id,
      type: "POST" 
    }).done(function(data) {
      location.href = "my-address.php";
    });
    } else {
      return false;
    }
  }

  $("#newAddrForm").submit(function(event) {
    event.preventDefault(); 
    var $form = $(this),
        addr_tag = $form.find( 'input[name="addr_tag"]' ).val(),
        address = $form.find( '#address' ).val(),
        addr_status = $("input[name='addr_status']:checked").val(),
        addr_id = $("input[name='addr_id']").val();
    if (addr_id == undefined || addr_id == null || addr_id.length < 1) {
      addr_id = '';
    }
    if (addr_id != '') {
      $.ajax({
        url: "update-address.php",
        data: "addr_tag=" + addr_tag + "&address=" + address + "&addr_id=" + addr_id,
        type: "POST" 
      }).done(function(data) {
        location.href = "my-address.php";
      });
    } else {
      $.ajax({
        url: "add-address.php",
        data: "addr_tag=" + addr_tag + "&address=" + address + "&addr_status=" +
          addr_status + "",
        type: "POST" 
      }).done(function(data) {
        location.href = "my-address.php";
      });
    }
  });
  </script>
</html>
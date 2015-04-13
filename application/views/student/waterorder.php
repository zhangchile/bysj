<?php $this->load->view("template/header.php");?>

<!-- 添加组内管理员层Modal -->
<form action="<?php echo site_url('student/waterorder/add');?>" method="post" class="form-horizontal" role="form">
 <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">我要够水</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
       <label for="type" class="col-sm-3 control-label">选择购买类型</label>
       <div class="col-sm-8">
         <select id="select" name="type" class="form-control">
              <?php foreach ($this->_water as $key => $value) :?>
                <option  data-prize="<?php echo $value['prize'];?>" value="<?php echo $value['id']?>"><?php echo $value['name'].' '.$value['prize'].'元/桶'?></option>
              <?php endforeach;?>
          </select>
          </div>
       </div>
        <div class="form-group">
       <label for="number" class="col-sm-3 control-label">数量</label>
       <div class="col-sm-8">
        <input id="number" class="form-control" type="text" name="number" onKeyUp="this.value=this.value.replace(/[^\.\d]/g,'');this.value=this.value.replace('.','');">
          </div>
       </div>

        <div class="form-group">
       <label for="prize" class="col-sm-3 control-label">总价</label>
       <div class="col-sm-8">
        <input id="totalprize" class="form-control" type="text" name="prize" value="" readonly>
          </div>
       </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        <button type="submit" class="btn btn-primary">提交</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</form>

      <div class="row row-offcanvas row-offcanvas-right">
        <!-- 左侧栏-->
        <?php $this->load->view('template/student_sidebar');?>
        <!--end 左侧栏-->
      <div class="col-md-8">
        <div>
            <p>
              <a data-toggle="modal" data-target="#addModal"  class="btn btn-primary">我要购水</a>
            </p>
        </div>
        <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading" style="text-align: center;">订购记录</div>

		<table class="table table-striped">
		      <thead>
		        <tr>
		          <th>#</th>
		          <th>类别</th>
		          <th>数量</th>
		          <th>总价</th>
		          <th>状态</th>
              <th>时间</th>
              <th>交易号</th>
		        </tr>
		      </thead>
		      <tbody>
            <?php foreach ($data as $key => $value) :?>
              <tr>
                <th scope="row"><?php echo $key + 1 ?></th>
                <td><?php echo $value['typename']?></td>
                <td><?php echo $value['number'];?></td>
                <td><?php echo $value['prize'];?></td>
                <td><?php if ($value['status'] == '1') :?> 
                    请付款
                    <?php elseif($value['status'] == '2') :?>
                    已付款
                    <?php elseif($value['status'] == '3') :?>
                    已确认
                    <?php endif;?>
                </td>
                <td><?php echo date('Y-m-d H:i:s', $value['time'])?></td>
                <td><?php if($value['status'] == '1') :?>
                    <a data-toggle="modal" href=""  class="btn btn-primary btn-sm">付款</a>
                  <?php else:?> 
                  <?php echo $value['billid']?>
                  <?php endif;?> 
                </td>
              </tr>
            <?php endforeach;?>
		      </tbody>
		</table>

      </div>
    <?php echo $this->pagination->create_links();?><!-- 输出分页模块 -->

      </div>
      </div><!--/row-->
<script type="text/javascript">
$("#number").keyup(function() {
  var prize = $('#select').find("option:selected").attr('data-prize');
  $("#totalprize").val((prize * $(this).val()).toFixed(2) + "元");
});
</script>

<?php $this->load->view("template/footer.php");?>
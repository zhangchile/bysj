<?php $this->load->view("template/header.php");?>

<!-- 添加组内管理员层Modal -->
  <form action="<?php echo site_url('student/repareapply/apply');?>" method="post" class="form-horizontal" role="form">
 <div class="modal fade" id="applyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">申请维修</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
       <label for="type" class="col-sm-3 control-label">选择维修类型</label>
       <div class="col-sm-8">
         <select name="type" class="form-control">
              <option  value="1" selected>水电维修</option>
              <option value="2">土木维修</option>
          </select>
          </div>
       </div>

        <div class="form-group">
       <label for="description" class="col-sm-3 control-label">问题描述</label>
       <div class="col-sm-8">
       	<textarea name="description" style="width:100%;"></textarea>
          </div>
       </div>

        <div class="form-group">
       <label for="booktime" class="col-sm-3 control-label">预约时间</label>
       <div class="col-sm-8">
       	<input type="text" name="booktime" class="form-control" value="<?php echo date('Y-m-d');?>">
          </div>
       </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        <button type="submit" class="btn btn-primary">保存</button>
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
              <a data-toggle="modal" data-target="#applyModal"  class="btn btn-primary">申请维修</a>
            </p>
        </div>
        <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading" style="text-align: center;">申请记录</div>

		<table class="table table-striped">
		      <thead>
		        <tr>
		          <th>#</th>
		          <th>类型</th>
		          <th>描述</th>
		          <th>申请时间</th>
		          <th>状态</th>
		        </tr>
		      </thead>
		      <tbody>
		      	<?php foreach ($data as $key => $value) :?>
			        <tr>
			          <th scope="row"><?php echo $key + 1 ?></th>
			          <td><?php if ($value['type'] == '1') echo '水电维修'; else echo '土木维修';?></td>
			          <td><?php echo $value['description'];?></td>
			          <td><?php echo date('Y-m-d H:i:s', $value['applytime'])?></td>
                <td><?php if ($value['status'] == '1') :?> 
                    申请中 
                    <?php elseif($value['status'] == '2') :?>
                    已接受
                    <?php elseif($value['status'] == '3') :?>
                    已完成                    
                    <?php else:?> 
                    <span class="label label-info">已拒绝</span>
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


<?php $this->load->view("template/footer.php");?>
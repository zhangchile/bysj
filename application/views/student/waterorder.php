<?php $this->load->view("template/header.php");?>

      <div class="row row-offcanvas row-offcanvas-right">
        <!-- 左侧栏-->
        <?php $this->load->view('template/student_sidebar');?>
        <!--end 左侧栏-->
      <div class="col-md-8">
        <div>
            <p>
              <a data-toggle="modal" data-target="#applyModal"  class="btn btn-primary">我要购水</a>
            </p>
        </div>
        <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading" style="text-align: center;">订购记录</div>

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


		      </tbody>
		</table>

      </div>
    <?php echo $this->pagination->create_links();?><!-- 输出分页模块 -->

      </div>
      </div><!--/row-->


<?php $this->load->view("template/footer.php");?>
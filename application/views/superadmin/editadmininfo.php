<?php $this->load->view('template/header.php');?>

      <div class="row row-offcanvas row-offcanvas-right">
        <!-- 左侧栏-->
        <?php echo $sidebar;?>
        <!--end 左侧栏-->
      <div class="col-md-8 col-sm-9">
        <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">修改管理员信息
          <!-- <a href="#" style="float:right;">查看所有>></a> -->
        </div>
        <form class="form-horizontal" method="post" action="<?php echo site_url('superadmin/manage/update')?>">
          <input type="hidden" value="<?php echo $data[0]['id']?>" name="id">
          <div class="form-group">
            <label class="col-sm-2 control-label">账号：</label>
            <div class="col-sm-10">
              <p class="form-control-static"><?php echo $data[0]['username']?></p>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">群组：</label>
            <div class="col-sm-10">
              <p class="form-control-static"><?php echo $data[0]['groupname']?></p>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">真实姓名：</label>
            <div class="col-sm-10">
              <input class="form-control" name="truename" value="<?php echo $data[0]['truename']?>"/>
            </div>
          </div>
          <div class="form-group">
            <label for="email" class="col-sm-2 control-label">邮箱：</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="email" name="email" value="<?php echo $data[0]['email']?>" required>
            </div>
          </div>
          <div class="form-group">
            <label for="mobile" class="col-sm-2 control-label">电话：</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="mobile" name="mobile" value="<?php echo $data[0]['mobile']?>" required>
            </div>
          </div>          
          <div class="form-group" align="right">
            <div class="col-sm-12">
            <button type="submit" class="btn btn-primary">更新</button>
            <a type="button" class="btn btn-default" href="<?php echo site_url('superadmin/manage')?>">取消</a>
            </div>
          </div>
        </form>

      </div>
      </div>
      </div><!--/row-->

<?php $this->load->view("template/footer.php");?>
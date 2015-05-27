<?php $this->load->view("template/header.php");?>

      <div class="row row-offcanvas row-offcanvas-right">
        <!-- 左侧栏-->
        <?php $this->load->view('template/sidebar');?>
        <!--end 左侧栏-->
      <div class="col-md-8 col-sm-9 col-xs-9">
        <h4 align="center">添加记录</h4>
        <form class="form-horizontal" method="post" action="<?php echo site_url('visitrecord/index/add')?>">
          <div class="form-group">
            <label class="col-sm-2 control-label">时间：</label>
            <div class="col-sm-10">
              <input class="form-control" type="text" name="time" value="<?php echo date('Y-m-d H:i:s')?>" required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">学号：</label>
            <div class="col-sm-10">
              <input class="form-control" type="text" name="studentid" value="" placeholder="没有可以不填">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">姓名：</label>
            <div class="col-sm-10">
              <input class="form-control" type="text" name="truename" value="" required>
            </div>
          </div>
          <div class="form-group">
            <label for="billid" class="col-sm-2 control-label">性别：</label>
            <div class="col-sm-10">
              <select name="sex">
                <option value="男">男</option>
                <option value='女'>女</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="billid" class="col-sm-2 control-label">到访原因：</label>
            <div class="col-sm-10">
              <textarea name="reason" required style="width:100%;"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="billid" class="col-sm-2 control-label">访问地方：</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" name="visitto" value="" required>
            </div>
          </div>          
          <div class="form-group" align="right">
            <div class="col-sm-12">
            <button type="submit" class="btn btn-primary">提交</button>
            <a type="button" class="btn btn-default" href="<?php echo site_url('visitrecord/index')?>">取消</a>
            </div>
          </div>
        </form>
      </div>
      </div><!--/row-->

<?php $this->load->view("template/footer.php");?>
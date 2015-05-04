<?php $this->load->view("template/header.php");?>

      <div class="row row-offcanvas row-offcanvas-right">
        <!-- 左侧栏-->
        <?php $this->load->view('template/student_sidebar');?>
        <!--end 左侧栏-->
      <div class="col-md-8">
        <h4 align="center">支付订单</h4>
        <form class="form-horizontal" method="post" action="<?php echo site_url('student/recharge/pay')?>">
          <input type="hidden" value="<?php echo $data[0]['id']?>" name="id">
          <div class="form-group">
            <label class="col-sm-2 control-label">类别：</label>
            <div class="col-sm-10">
              <p class="form-control-static"><?php if(intval($data[0]['type']) == 1) echo '水费'; else echo '电费';?></p>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">价值：</label>
            <div class="col-sm-10">
              <p class="form-control-static"><?php echo $data[0]['changes']?>元</p>
            </div>
          </div>
          <div class="form-group">
            <label for="billid" class="col-sm-2 control-label">交易号：</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="billid" name="billid" required>
            </div>
          </div>
          <div class="form-group" align="right">
            <div class="col-sm-12">
            <button type="submit" class="btn btn-primary">提交</button>
            <a type="button" class="btn btn-default" href="<?php echo site_url('student/recharge')?>">暂不付款</a>
            </div>
          </div>
        </form>
      </div>
      </div><!--/row-->

<?php $this->load->view("template/footer.php");?>
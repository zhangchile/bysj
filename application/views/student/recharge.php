<?php $this->load->view("template/header.php");?>
<script type="text/javascript" src='<?php echo base_url();?>public/js/highcharts-4.0.3/highcharts.js'></script>
      <div class="row row-offcanvas row-offcanvas-right">
        <!-- 左侧栏-->
        <?php $this->load->view('template/student_sidebar');?>
        <!--end 左侧栏-->
      <div class="col-md-8">
        <form method="get" action="<?php echo site_url('student/recharge/index');?>">
          <label >类别：</label>
          <select name="type">
            <option value="all">全部</option>
            <option <?php if($this->input->get('type') == '1') echo 'selected'?> value="1">水费</option>
            <option <?php if($this->input->get('type') == '2') echo 'selected'?> value="2">电费</option>
          </select>
          <label >类别：</label>
          <select name="operate">
            <option value="all">全部</option>
            <option <?php if($this->input->get('operate') == '1') echo 'selected'?> value="1">充值</option>
            <option <?php if($this->input->get('operate') == '2') echo 'selected'?> value="2">扣费</option>
          </select>          <label >状态：</label>
          <select name="status">
            <option value="all">全部</option>
            <option <?php if($this->input->get('status') == '1') echo 'selected'?> value="1">已提交</option>
            <option <?php if($this->input->get('status') == '2') echo 'selected'?> value="2">已接受</option>
            <option <?php if($this->input->get('status') == '3') echo 'selected'?> value="3">已完成</option>
            <option <?php if($this->input->get('status') == '-1') echo 'selected'?> value="-1">已拒绝</option>
          </select>          
        <button type="submit" class="btn btn-default btn-sm">筛选</button>
      </form>
        <div id="wpannel" class="panel panel-default">
        <!-- Default panel contents -->
        <div  class="panel-heading">水电记录
            <span style="font-weight:bold;float:right;font-size:14px;" class="label label-default">余额：88元</span>
        </div>
        <div class="panel-body" id="wcontainer">
                <table class="table table-striped">
              <thead>
                <tr>
                  <th>类别</th>
                  <th>操作</th>
                  <th>总价（元）</th>
                  <th>状态</th>
                  <th>时间</th>
                  <th>交易号</th>
                </tr>
              </thead>
              <tbody>

              </tbody>
        </table>
        </div>
      </div>
    <?php echo $this->pagination->create_links();?><!-- 输出分页模块 -->
      </div>
      </div><!--/row-->

<?php $this->load->view("template/footer.php");?>
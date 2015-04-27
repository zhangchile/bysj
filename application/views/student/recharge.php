<?php $this->load->view("template/header.php");?>
<script type="text/javascript" src='<?php echo base_url();?>public/js/highcharts-4.0.3/highcharts.js'></script>
      <div class="row row-offcanvas row-offcanvas-right">
        <!-- 左侧栏-->
        <?php $this->load->view('template/student_sidebar');?>
        <!--end 左侧栏-->
      <div class="col-md-8">
        <div id="wpannel" class="panel panel-default">
        <!-- Default panel contents -->
        <div  class="panel-heading">用水充值
            <span style="font-weight:bold;float:right;font-size:14px;" class="label label-default">余额：88元</span>
        </div>
        <div class="panel-body" id="wcontainer">
                <table class="table table-striped">
              <thead>
                <tr>
                  <th>类别</th>
                  <th>数量（桶）</th>
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
      <div id="epart"></div>
        <div id="epannel" class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">用电充值
            <span style="font-weight:bold;float:right;font-size:14px;" class="label label-default">余额：88元</span>
        </div>
        <div class="panel-body" id="econtainer">
                <table class="table table-striped">
              <thead>
                <tr>
                  <th>类别</th>
                  <th>数量（桶）</th>
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

      </div>
      </div><!--/row-->

<?php $this->load->view("template/footer.php");?>
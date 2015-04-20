<?php $this->load->view("template/header.php");?>
<script type="text/javascript" src='<?php echo base_url();?>public/js/highcharts-4.0.3/highcharts.js'></script>
      <div class="row row-offcanvas row-offcanvas-right">
        <!-- 左侧栏-->
        <?php $this->load->view('template/student_sidebar');?>
        <!--end 左侧栏-->
      <div class="col-md-8">
        <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">通知
          <!-- <a href="#" style="float:right;">查看所有>></a> -->
        </div>
<!--         <div class="panel-body">
          <p>公告啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊</p>
        </div> -->
      </div>

      </div>
      </div><!--/row-->

<?php $this->load->view("template/footer.php");?>
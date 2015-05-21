<?php $this->load->view("template/header.php");?>


      <div class="row row-offcanvas row-offcanvas-right">
        <!-- 左侧栏-->
        <?php $this->load->view('template/sidebar');?>
        <!--end 左侧栏-->
      <div class="col-md-8 col-sm-9 ">
        <div style="margin:0px 0px 10px 0px;">

        <a href="<?php echo site_url('visitrecord/index/add');?>" class="btn btn-primary">添加记录</a>
        </div>
        <form method="get" action="<?php echo site_url('visitrecord/index');?>">
          <label>开始时间：</label>
          <input type="text" name="time_start" value="<?php if($this->input->get('time_start')) echo $this->input->get('time_start')?>">
          <label>结束时间：</label>
          <input type="text" name="time_end" value="<?php if($this->input->get('time_end')) echo $this->input->get('time_end')?>">
        <button type="submit" class="btn btn-default btn-sm">筛选</button>
      </form>

        <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading" style="text-align: center;">来访纪录</div>

    <table class="table table-striped">
          <thead>
            <tr>
              <th>时间</th>
              <th>学号</th>
              <th>姓名</th>
              <th>性别</th>
              <th>来访原因</th>
              <th>访问地址</th>
              </tr>
          </thead>
          <tbody>
            <?php foreach ($data as $key => $value) :?>
              <tr>
                <td><?php echo date('Y-m-d H:i:s',$value['time']);?></td>
                <td><?php echo $value['studentid'];?></td>
                <td><?php echo $value['truename'];?></td>
                <td><?php echo $value['sex'];?></td>
                <td><?php echo $value['reason'];?></td>
                <td><?php echo $value['visitto']?> 
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
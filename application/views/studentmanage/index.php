<?php $this->load->view("template/header.php");?>

      <div class="row row-offcanvas row-offcanvas-right">
        <!-- 左侧栏-->
        <?php $this->load->view('template/sidebar');?>
        <!--end 左侧栏-->
      <div class="col-md-8 col-sm-9">
        <div style="margin:0px 0px 10px 0px;">

        </div>
        <form method="get" action="<?php echo site_url('studentmanage/index');?>">
          <label>宿舍编号：</label>
          <input type="text" name="dormitory" value="<?php if($this->input->get('dormitory')) echo $this->input->get('dormitory')?>">
          <label>学号：</label>
          <input type="text" name="studentid" value="<?php if($this->input->get('studentid')) echo $this->input->get('studentid')?>">
        <button type="submit" class="btn btn-default btn-sm">搜索</button>
      </form>

        <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading" style="text-align: center;">学生信息查询</div>

    <table class="table table-striped">
          <thead>
            <tr>
              <th>宿舍</th>
              <th>学号</th>
              <th>姓名</th>
              <th>性别</th>
              <th>年级</th>
              <th>学院</th>
              <th>专业</th>
              <th>班级</th>
              </tr>
          </thead>
          <tbody>
            <?php foreach ($data as $key => $value) :?>
              <tr>
                <td><?php echo $this->dormitory->TransformID($value['dormitory'])?></td>
                <td><?php echo $value['studentid'];?></td>
                <td><?php echo $value['truename'];?></td>
                <td><?php echo $value['sex'];?></td>
                <td><?php echo $value['grade'];?></td>
                <td><?php echo $value['department']?></td>
                <td><?php echo $value['major']?></td>
                <td><?php echo $value['class']?></td>
              </tr>
            <?php endforeach;?>
          </tbody>
    </table>

      </div>
    <?php echo $this->pagination->create_links();?><!-- 输出分页模块 -->

      </div>
      </div><!--/row-->

<?php $this->load->view("template/footer.php");?>
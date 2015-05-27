<?php $this->load->view("template/header.php");?>

      <div class="row row-offcanvas row-offcanvas-right">
        <!-- 左侧栏-->
        <?php $this->load->view('template/sidebar');?>
        <!--end 左侧栏-->
      <div class="col-md-8 col-sm-9 col-xs-9">
        <form method="get" action="<?php echo site_url('reparedepartment/index');?>">
          <label >类别：</label>
          <select name="type">
            <option value="all">全部</option>
            <option <?php if($this->input->get('type') == '1') echo 'selected'?> value="1">水电维修</option>
            <option <?php if($this->input->get('type') == '2') echo 'selected'?> value="2">土木维修</option>
          </select>
          <label >状态：</label>
          <select name="status">
            <option value="all">全部</option>
            <option <?php if($this->input->get('status') == '1') echo 'selected'?> value="1">申请中</option>
            <option <?php if($this->input->get('status') == '2') echo 'selected'?> value="2">已接受</option>
            <option <?php if($this->input->get('status') == '3') echo 'selected'?> value="3">已完成</option>
            <option <?php if($this->input->get('status') == '-1') echo 'selected'?> value="-1">已拒绝</option>
          </select>          
        <button type="submit" class="btn btn-default btn-sm">筛选</button>
      </form>
    </div>
      <div class="col-md-8 col-sm-9 col-xs-9">
        <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading" style="text-align: center;">申请记录</div>
    <table class="table table-striped">
          <thead>
            <tr>
              <th>宿舍</th>
              <th>类型</th>
              <th>描述</th>
              <th>申请时间</th>
              <th>状态</th>
              <th>操作</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($data as $key => $value) :?>
              <tr>
                <td><?php echo $this->dormitory->TransformID($value['sid']);?></td>
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
                <td>
                  <?php if(in_array('editreparestatus', $this->action)):?>
                  <?php if($value['status'] == '1'):?>
                  <a class="btn btn-primary btn-sm" href="<?php echo site_url('reparedepartment/index/update/?status=2&id=').$value['id'];?>">接受</a>
                  <a class="btn btn-default btn-sm" href="<?php echo site_url('reparedepartment/index/update/?status=-1&id=').$value['id'];?>">拒绝</a>
                <?php elseif($value['status'] == '2'):?>
                  <a class="btn btn-primary btn-sm" href="<?php echo site_url('reparedepartment/index/update/?status=3&id=').$value['id'];?>">完成</a>
              <?php endif;?>
            <?php else :?>
            无权限
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
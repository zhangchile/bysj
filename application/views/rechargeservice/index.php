<?php $this->load->view("template/header.php");?>

<!-- 添加组内管理员层Modal -->
<form action="<?php echo site_url('rechargeservice/index/editprize');?>" method="post" class="form-horizontal" role="form">
 <div class="modal fade" id="editprizeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">修改水电费</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
       <label for="water" class="col-sm-4 control-label">水费单价（元/吨）</label>
       <div class="col-sm-8">
        <input id="water" class="form-control" type="text" name="water" placeholder='单位：元' value="<?php echo $prize_data[0]['water']?>">
          </div>
       </div>
        <div class="form-group">
       <label for="electricity" class="col-sm-4 control-label">电费单价（元/度）</label>
       <div class="col-sm-8">
        <input id="electricity" class="form-control" type="text" name="electricity" placeholder='单位：元' value="<?php echo $prize_data[0]['electricity']?>">
          </div>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        <button type="submit" class="btn btn-primary">提交</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</form>

      <div class="row row-offcanvas row-offcanvas-right">
        <!-- 左侧栏-->
        <?php $this->load->view('template/sidebar');?>
        <!--end 左侧栏-->
      <div class="col-md-8 col-sm-9 col-xs-9">
      <div>
      <p>
        <?php if(in_array("editrechargeprize", $this->action)):?>
        <a data-toggle="modal" data-target="#editprizeModal"  class="btn btn-primary">修改水电价格</a>
        <?php endif;?>
      </p>
      </div>
        <form method="get" action="<?php echo site_url('rechargeservice/index');?>">
          <label >类别：</label>
          <select name="type">
            <option value="all">全部</option>
            <option <?php if($this->input->get('type') == '1') echo 'selected'?> value="1">水费</option>
            <option <?php if($this->input->get('type') == '2') echo 'selected'?> value="2">电费</option>
          </select>
          <label >动作：</label>
          <select name="operate">
            <option value="all">全部</option>
            <option <?php if($this->input->get('operate') == '1') echo 'selected'?> value="1">充值</option>
            <option <?php if($this->input->get('operate') == '2') echo 'selected'?> value="2">扣费</option>
          </select>
          <label >状态：</label>
          <select name="status">
            <option value="all">全部</option>
            <option <?php if($this->input->get('status') == '1') echo 'selected'?> value="1">已提交</option>
            <option <?php if($this->input->get('status') == '2') echo 'selected'?> value="2">已付款</option>
            <option <?php if($this->input->get('status') == '3') echo 'selected'?> value="3">已完成</option>
<!--             <option <?php if($this->input->get('status') == '-1') echo 'selected'?> value="-1">已拒绝</option> -->
          </select>
          <label >宿舍编号：</label>
          <input type="text" name="sid" value="<?php if($this->input->get('sid')) echo $this->input->get('sid')?>"/>   
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
                <th>类别</th>
                <th>操作</th>
                <th>变化（元）</th>
                <th>状态</th>
                <th>时间</th>
                <th>交易号</th>
                <th>操作</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($data as $key => $value) :?>
              <tr>
                <td><?php echo $this->dormitory->TransformID($value['sid']);?></td>
                <td><?php if ($value['type'] == '1') echo '水费'; else echo '电费';?></td>
                <td><?php if ($value['operate'] == '1') echo '充值'; else echo '扣费';?></td>
                <td><?php if(intval($value['operate']) === 1) echo '+'.$value['changes']; else echo '-'.$value['changes']?></td>
                <td><?php if ($value['status'] == '1') :?> 
                    已提交
                    <?php elseif($value['status'] == '2') :?>
                    已付款
                    <?php elseif($value['status'] == '3') :?>
                    已完成                    
                    <?php else:?> 
                    <span class="label label-info">已拒绝</span>
                    <?php endif;?>
                </td>
                <td><?php echo date('Y-m-d', $value['date']);?></td>
                <td><?php echo $value['billid']?></td>
                <td>
                  <?php if(in_array('editrecharge', $this->action)):?>
                  <?php if($value['status'] == '2'):?>
                  <a class="btn btn-primary btn-sm" href="<?php echo site_url('rechargeservice/index/update/?status=3&id=').$value['id']."&type=".$value['type']."&changes=".$value['changes']."&sid=".$value['sid'];?>">确认</a>
                  <!-- <a class="btn btn-default btn-sm" href="<?php echo site_url('rechargeservice/index/update/?status=-1&id=').$value['id']."&type=".$value['type']."&changes=".$value['changes']."&sid=".$value['sid'];?>">拒绝</a> -->
                <?php elseif($value['status'] == '-1'):?>
                  <!-- <a class="btn btn-primary btn-sm" href="<?php echo site_url('rechargeservice/index/update/?status=2&id=').$value['id']."&type=".$value['type']."&changes=".$value['changes']."&sid=".$value['sid'];?>">恢复</a> -->
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
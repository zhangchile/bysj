<?php $this->load->view("template/header.php");?>
<!-- 添加组内管理员层Modal -->
<form action="<?php echo site_url('student/recharge/add');?>" method="post" class="form-horizontal" role="form">
 <div class="modal fade" id="rechargeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">水电充值</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
       <label for="type" class="col-sm-3 control-label">选择充值类型</label>
       <div class="col-sm-8">
         <select id="select" name="type" class="form-control">
                <option  value="1">水费</option>
                <option  value="2">电费</option>
          </select>
          </div>
       </div>
        <div class="form-group">
       <label for="changes" class="col-sm-3 control-label">价值</label>
       <div class="col-sm-8">
        <input id="changes" class="form-control" type="text" name="changes" placeholder='单位：元' onKeyUp="this.value=this.value.replace(/[^\.\d]/g,'');this.value=this.value.replace('.','');">
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

<script type="text/javascript" src='<?php echo base_url();?>public/js/highcharts-4.0.3/highcharts.js'></script>
      <div class="row row-offcanvas row-offcanvas-right">
        <!-- 左侧栏-->
        <?php $this->load->view('template/student_sidebar');?>
        <!--end 左侧栏-->
      <div class="col-md-8 col-sm-9 col-xs-9">
        <div class="row">
          <div class="col-md-10">
        <form method="get" action="<?php echo site_url('student/recharge/index');?>">
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
            <option <?php if($this->input->get('status') == '-1') echo 'selected'?> value="-1">已拒绝</option>
          </select>          
        <button type="submit" class="btn btn-default btn-sm">筛选</button>
      </form>
    </div>
    <div class="col-md-2" style="text-align:right;"> <a data-toggle="modal" data-target="#rechargeModal"  class="btn btn-primary btn-sm" >我要充值</a></div>
    </div>
     
        <div id="wpannel" class="panel panel-default">
        <!-- Default panel contents -->
        <div  class="panel-heading">水电记录
            <span style="font-weight:bold;float:right;font-size:14px;" class="label label-success">水费余额：<?php echo $chargeLeft[0]['watercharge']?>元</span>
            <span style="font-weight:bold;float:right;font-size:14px;" class="label label-warning">电费余额：<?php echo $chargeLeft[0]['electricitycharge']?>元</span>
        </div>
        <div class="panel-body" id="wcontainer">
                <table class="table table-striped">
              <thead>
                <tr>
                  <th>类别</th>
                  <th>操作</th>
                  <th>变化（元）</th>
                  <th>状态</th>
                  <th>时间</th>
                  <th>交易号</th>
                </tr>
                <?php foreach ($data as $key => $value) :?>
                <tr>
                <td><?php if(intval($value['type']) === 1) echo '水费'; else echo '电费'?></td>
                <td><?php if(intval($value['operate']) === 1) echo '充值'; else echo '扣费'?></td>
                <td><?php if(intval($value['operate']) === 1) echo '+'.$value['changes']; else echo '-'.$value['changes']?></td>
                <td><?php if(intval($value['status']) === 1) echo '已提交'; else if($value['status'] == 2) echo '已付款'; else if($value['status'] == 3) echo '已完成'; else echo '已拒绝'?></td>
                <td><?php echo date('Y-m-d',$value['date'])?></td>
                <td><?php if(intval($value['status']) == 1) :?>
                  <a class="btn btn-sm btn-primary" href="<?php echo site_url('student/recharge/pay/').'/'.$value['id']?>">付款</a>
                  <?php elseif(intval($value['status']) == 2):?> 
                  <?php echo $value['billid'];?>
                  <a class="btn btn-sm btn-primary" href="<?php echo site_url('student/recharge/pay/').'/'.$value['id']?>">修改</a>
                  <?php elseif(intval($value['status']) == -1):?> 
                  <?php echo $value['billid'];?>
                  <a class="btn btn-sm btn-primary" href="<?php echo site_url('student/recharge/pay/').'/'.$value['id']?>">修改</a>
                <?php else:?>
                  <?php echo $value['billid']?>
                <?php endif;?>
                </td>
                </tr>
              <?php endforeach;?>
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
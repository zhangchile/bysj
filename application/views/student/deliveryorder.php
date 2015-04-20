<?php $this->load->view("template/header.php");?>

<!-- 添加组内管理员层Modal -->
<form action="<?php echo site_url('student/deliveryorder/add');?>" method="post" class="form-horizontal" role="form">
 <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">申请送水</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
       <label for="number" class="col-sm-3 control-label">选择数量</label>
       <div class="col-sm-8">
         <select id="select" name="number" class="form-control">
                <option value="1">1桶</option>
                <option value="1">2桶</option>
          </select>
          </div>
       </div>

        <div class="form-group">
       <label for="booktime" class="col-sm-3 control-label">选择时间</label>
       <div class="col-sm-8">
           <select id="select" name="booktime" class="form-control">
                  <option value="1">中午（12点~14点）</option>
                  <option value="2">下午（16点~18点）</option>
                  <option value="3">晚上（19点~21点）</option>
            </select>
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
        <?php $this->load->view('template/student_sidebar');?>
        <!--end 左侧栏-->
      <div class="col-md-8">
        <div class="row">
          <div class="col-md-10">
            <h4>剩余：<?php echo $waterleft[0]['waterleft'];?>桶</h4>
          </div>
          <div class="col-md-2">
              <p>
                <?php if($waterleft[0]['waterleft'] != 0) :?>
                <a data-toggle="modal" data-target="#addModal"  class="btn btn-primary">申请送水</a>
              <?php endif;?>
              </p>
          </div>
        </div>
        <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading" style="text-align: center;">送水记录</div>

    <table class="table table-striped">
          <thead>
            <tr>

              <th>数量（桶）</th>
              <th>状态</th>
              <th>时间</th>
              <th>预约时间</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($data as $key => $value) :?>
              <tr>
                <td><?php echo $value['number'];?></td>
                <td><?php if ($value['status'] == '1') :?> 
                    请等待确认
                    <?php elseif($value['status'] == '2') :?>
                    <span class="label label-info">已确认</span>
                    <?php elseif($value['status'] == '3') :?>
                    已配送
                    <?php endif;?>
                </td>
                <td><?php echo date('Y-m-d H:i:s', $value['time'])?></td>
                <td><?php if($value['booktime'] == '1'):?>
                    中午（12点~14点）
                  <?php elseif($value['booktime'] == '2'):?> 
                    下午（16点~18点）
                  <?php else:?> 
                    晚上（19点~21点）
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
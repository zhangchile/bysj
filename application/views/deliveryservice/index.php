<?php $this->load->view("template/header.php");?>


      <div class="row row-offcanvas row-offcanvas-right">
        <!-- 左侧栏-->
        <?php $this->load->view('template/sidebar');?>
        <!--end 左侧栏-->
      <div class="col-md-8 col-sm-9 col-xs-9">
        <form method="get" action="<?php echo site_url('deliveryservice/index');?>">
          <label >状态：</label>
          <select name="status">
            <option value="all">全部</option>
            <option <?php if($this->input->get('status') == '1') echo 'selected'?> value="1">未确认</option>
            <option <?php if($this->input->get('status') == '2') echo 'selected'?> value="2">已确认</option>
            <option <?php if($this->input->get('status') == '-1') echo 'selected'?> value="-1">已拒绝</option>
          </select>
        <button type="submit" class="btn btn-default btn-sm">筛选</button>
      </form>

        <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading" style="text-align: center;">送水订单</div>

    <table class="table table-striped">
          <thead>
            <tr>
              <th>宿舍</th>
              <th>数量（桶）</th>
              <th>状态</th>
              <th>时间</th>
              <th>预约时间</th>
              <th>操作</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($data as $key => $value) :?>
              <tr>
                <td><?php echo $this->dormitory->TransformID($value['sid']);?></td>
                <td><?php echo $value['number'];?></td>
                <td><?php if ($value['status'] == '1') :?> 
                    请确认
                    <?php elseif($value['status'] == '2') :?>
                    <span class="label label-info">已确认</span>
                    <?php elseif($value['status'] == '3') :?>
                    已配送
                  <?php else:?>
                    拒绝
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
                <td><?php if($value['status'] == '1' && in_array('editdeliverystatus', $this->action)) :?>
                    <a data-toggle="modal" href="<?php echo site_url('deliveryservice/index/update/').'?status=2&id='.$value['id'].'&sid='.$value['sid'].'&number='.$value['number']?>"  class="btn btn-primary btn-sm">确认</a>
                  <?php else:?> 
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
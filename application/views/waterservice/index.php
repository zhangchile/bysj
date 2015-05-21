<?php $this->load->view("template/header.php");?>

<!-- 修改桶装水价格Modal -->
  <form action="<?php echo site_url('waterservice/index/updateprize');?>" method="post" class="form-horizontal" role="form"> 
  <input type='hidden' name="id" value="<?php echo $this->_water[0]['id']?>"> 
<div class="modal fade" id="editprizeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">修改桶装水价格</h4>
      </div>
      <div class="modal-body">
         <div class="form-group">
       <label for="name" class="col-sm-3 control-label">名称</label>
       <div class="col-sm-8">
          <input class="form-control" type="text" name="name" value='<?php echo $this->_water[0]['name']?>'>
          </div>
       </div>

         <div class="form-group">
       <label for="sname" class="col-sm-3 control-label">价格</label>
       <div class="col-sm-8">
          <input class="form-control" type="text" name="prize" value='<?php echo $this->_water[0]['prize']?>'>
          </div>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        <button type="submit" class="btn btn-primary">保存</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</form>

      <div class="row row-offcanvas row-offcanvas-right">
        <!-- 左侧栏-->
        <?php $this->load->view('template/sidebar');?>
        <!--end 左侧栏-->
      <div class="col-md-8 col-sm-9">
        <div class="row">
          <div class="col-md-12">
        <form style="float:left;" method="get" action="<?php echo site_url('waterservice/index');?>">
          <label >状态：</label>
          <select name="status">
            <option value="all">全部</option>
            <option <?php if($this->input->get('status') == '2') echo 'selected'?> value="2">已付款</option>
            <option <?php if($this->input->get('status') == '3') echo 'selected'?> value="3">已确认</option>
            <option <?php if($this->input->get('status') == '1') echo 'selected'?> value="1">未付款</option>
            <option <?php if($this->input->get('status') == '-1') echo 'selected'?> value="-1">已拒绝</option>
          </select>
        <button type="submit" class="btn btn-default btn-sm">筛选</button>
      </form>
      <?php if(in_array('editprize', $this->action)):?>
      <a type='button' class="btn btn-primary btn-sm" style="float:right;cursor:pointer" data-toggle="modal" data-target="#editprizeModal">修改桶装水价格</a>
      <?php endif;?>   
      </div>   
    </div>
      <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading" style="text-align: center;">订单记录</div>

		<table class="table table-striped">
		      <thead>
		        <tr>
              <th>宿舍</th>
		          <th>类别</th>
		          <th>数量</th>
		          <th>总价</th>
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
                <td><?php echo $value['typename'];?></td>
                <td><?php echo $value['number'];?>桶</td>
                <td><?php echo $value['prize'];?>元</td>
                <td><?php if ($value['status'] == '1') :?> 
                    未付款
                    <?php elseif($value['status'] == '2') :?>
                    <span class="label label-info">已付款，请确认</span>
                    <?php elseif($value['status'] == '3') :?>
                    已确认
                    <?php endif;?>
                </td>
                <td><?php echo date('Y-m-d H:i:s', $value['time'])?></td>
                <td><?php echo $value['billid']?></td>
                <td><?php if(in_array('editorderstatus', $this->action)):?>
                <?php if($value['status'] == '2') :?>
                    <a data-toggle="modal" href="<?php echo site_url('waterservice/index/update/').'?status=3&id='.$value['id'].'&sid='.$value['sid'].'&number='.$value['number']?>"  class="btn btn-primary btn-sm">确认</a>
                  <?php else:?> 
                  <?php endif;?>
                <?php else:?>
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
<?php $this->load->view('template/header.php');?>


<!-- 消息提醒Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">提示</h4>
      </div>
      <div class="modal-body">
        你确定要删除吗？
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        <a id="del_ok" href="#" type="button" class="btn btn-danger">删除</a>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
      <div class="row row-offcanvas row-offcanvas-right">
        <!-- 左侧栏-->
        <?php echo $sidebar;?>
        <!--end 左侧栏-->
      <div class="col-md-8 col-sm-9 col-xs-9">
        <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">管理员列表
          <!-- <a href="#" style="float:right;">查看所有>></a> -->
        </div>
        <table class="table table-striped">
                <thead>
                  <tr>
                      <th>用户名</th>
                      <th>群组</th>
                      <th>真实姓名</th>
                      <th>性别</th>
                      <th>邮箱</th>
                      <th>电话</th>
                      <th>操作</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($data as $key => $value) :?>
                    <tr>
                      <td><?php echo $value['username']?></td>
                      <td><?php echo $value['groupname']?></td>
                      <td><?php echo $value['truename']?></td>
                      <td><?php echo $value['sex']?></td>
                      <td><?php echo $value['email']?></td>
                      <td><?php echo $value['mobile']?></td>
                      <td>
                        <?php if(in_array("editadmininfo", $this->action)):?>
                        <a class="btn btn-primary btn-sm" href="<?php echo site_url('superadmin/manage/edit').'?id='.$value['id'];?>">修改</a>
                      <?php endif;?>
                        <?php if(in_array("deladmin", $this->action)):?>
                          <a id="delete" data="<?php echo site_url("superadmin/manage/del").'?id='.$value['id'];?>" class="btn btn-sm btn-default" data-toggle="modal" data-target="#deleteModal">删除</a>
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
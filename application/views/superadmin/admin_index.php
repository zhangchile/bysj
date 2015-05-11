<?php $this->load->view("template/header.php");?>
<?php //var_dump($this->action)?>
<!-- 添加组内管理员层Modal -->
  <form action="<?php echo site_url('superadmin/admin/add');?>" method="post" class="form-horizontal" role="form">
  <input id="add_groupid" type="hidden" name="groupid" value="">    
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">添加</h4>
      </div>
      <div class="modal-body">
         <div class="form-group">
       <label for="sname" class="col-sm-3 control-label">选择管理员</label>
       <div class="col-sm-8">
         <select name="masterid" class="form-control">
           <?php foreach($AllMaster as $key => $value):?>
             <?php if($key == 0):?>
              <option  value="<?php echo $value['id'];?>" selected><?php echo $value['truename'];?></option>
              <?php else:?>
              <option value="<?php echo $value['id'];?>"><?php echo $value['truename'];?></option>
              <?php endif;?>
            <?php endforeach;?>
          </select>
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

<!-- 添加一个新管理员层Modal -->
  <form action="<?php echo site_url('superadmin/admin/addmaster');?>" method="post" class="form-horizontal" role="form"> 
<div class="modal fade" id="addmasterModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">注册</h4>
      </div>
      <div class="modal-body">

         <div class="form-group">
       <label for="username" class="col-sm-3 control-label">用户名</label>
       <div class="col-sm-8">
         <input type="text" name="username" value=""  class="form-control input">
          </div>
       </div>

         <div class="form-group">
       <label for="password" class="col-sm-3 control-label">密码</label>
       <div class="col-sm-8">
            <input type="password" name="password" value=""  class="form-control input">
          </div>
       </div>

         <div class="form-group">
       <label for="truename" class="col-sm-3 control-label">真实姓名</label>
       <div class="col-sm-8">
            <input type="text" name="truename" value=""  class="form-control input">
          </div>
       </div>
         <div class="form-group">
       <label for="sname" class="col-sm-3 control-label">性别</label>
       <div class="col-sm-8">
         <select name="sex" class="form-control">
            <option  value="男" selected>男</option>
            <option value="女">女</option>
          </select>
          </div>
       </div>

         <div class="form-group">
       <label for="email" class="col-sm-3 control-label">电子邮件</label>
       <div class="col-sm-8">
            <input type="text" name="email" value=""  class="form-control input">
          </div>
       </div>

         <div class="form-group">
       <label for="mobile" class="col-sm-3 control-label">电话</label>
       <div class="col-sm-8">
            <input type="text" name="mobile" value=""  class="form-control input">
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

<!-- 添加分组层Modal -->
<form action="<?php echo site_url('superadmin/admin/addgroup');?>" method="post" class="form-horizontal" role="form">
<div class="modal fade" id="addgroupModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">添加</h4>
      </div>
      <div class="modal-body">

         <div class="form-group">
       <label for="groupname" class="col-sm-3 control-label">组名</label>
       <div class="col-sm-8">
          <input type="sname" class="form-control" name="groupname" placeholder="" >
        </div>
       </div>

         <div class="form-group">
       <label for="groupinfo" class="col-sm-3 control-label">描述</label>
       <div class="col-sm-8">
          <input type="sname" class="form-control" name="groupinfo" placeholder="" >
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
        <div class="col-xs-12 col-sm-9">
        <div>
            <p>
              <?php if(in_array("addgroupmanager", $this->action)):?>
              <a data-toggle="modal" data-target="#addgroupModal"  class="btn btn-primary">添加一个组</a>
              <?php endif;?>

              <?php if(in_array("addmaster", $this->action)):?>
              <a data-toggle="modal" data-target="#addmasterModal"  class="btn btn-primary">注册新管理员</a>
              <?php endif;?>
            </p>
        </div>
        <?php foreach($group as $g) :?>
<?php //var_dump($g['master'])?>
        <div class="panel panel-default">
          <div class="panel-heading" style="cursor:pointer;">
            <?php echo $g['groupname']?>
            <?php if(in_array("delgroupmanager", $this->action) && $this->session->userdata("groupid") != $g['groupid']):?>
            <a type='button' style="float:right;cursor:pointer" data-toggle="modal" data="<?php echo site_url("superadmin/admin/delgroup").'/'.$g['groupid'];?>" data-target="#deleteModal">删除该组</a>
          <?php endif;?>
          </div>
          <div class="panel-body">
            <ul class="list-group">
              <?php foreach ($g['master'] as $key => $value) {?>
                <li class="list-group-item"><?php echo $value['name']?>
                  <?php if(in_array("delgroupmaster", $this->action) && $value['masterid']!=$this->session->userdata("masterid")):?>
                  <a id="delete" data="<?php echo site_url("superadmin/admin/del").'/'.$value['id'];?>" style="float:right;cursor:pointer" data-toggle="modal" data-target="#deleteModal">删除</a></li>
                <?php endif;?>
              <?php }?>
            </ul>
            <?php if(in_array("addgroupmaster", $this->action)) :?>
            <a type='button' id="add" data-groupid="<?php echo $g["groupid"]?>" style="float:left;" class="btn btn-primary" data-toggle="modal" data-target="#addModal">添加人员</a>
          <?php endif;?>
          </div>
        </div>
      <?php endforeach;?>
        </div><!--/span-->
      </div><!--/row-->
<script type="text/javascript">
$(document).ready(function(){
  $(".panel-body").hide();
  $(".panel-heading").click(function(){
    $(this).next().toggle(200);
  });
});
</script>
<?php $this->load->view("template/footer.php");?>
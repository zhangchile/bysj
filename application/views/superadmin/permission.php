<?php include("/../template/header.php");?>

<!-- 添加管理员层Modal -->
  <form action="<?php echo site_url('admin/add');?>" method="post" class="form-horizontal" role="form">
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


<!-- 添加分组层Modal -->
<form action="<?php echo site_url('admin/addgroup');?>" method="post" class="form-horizontal" role="form">
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

        <?php foreach($group as $g) :?>
<?php //var_dump($g)?>

        <div class="panel panel-default">
          <div class="panel-heading" style="cursor:pointer;">
            <?php echo $g['groupname']?>
          </div>
          <div class="panel-body">
            <ul class="list-group">
              <?php foreach ($g['permission'] as $key => $value) {?>
                <li class="list-group-item"><?php echo $value['actionname']?>
                  <?php if(in_array("delpermission", $this->action)):?>
                  <a id="delete" data="<?php echo site_url("permission/del").'/'.$value['id'];?>" style="float:right;cursor:pointer" data-toggle="modal" data-target="#deleteModal">删除</a>
                <?php endif;?>
                </li>
              <?php }?>
            </ul>
            <?php if(in_array("addpermission", $this->action) && !empty($g["unget_permission"])):?>
            <form method="post" action="<?php echo site_url("permission/add");?>">
              <input type="hidden" name="groupid" value="<?php echo $g['groupid']?>">
            <div class="col-sm-6">
             <select name="action" class="form-control">
               <?php foreach($g["unget_permission"] as $key => $value):?>
                 <?php if($key == 0):?>
                  <option  value="<?php echo $value['action'];?>" selected><?php echo $value['actionname'];?></option>
                  <?php else:?>
                  <option value="<?php echo $value['action'];?>"><?php echo $value['actionname'];?></option>
                  <?php endif;?>
                <?php endforeach;?>
              </select>
            </div>
          <div class="col-sm-4">
           <input type='submit' style="float:left;" class="btn btn-primary"  value="添加">
         
       </div>
        </form>
          <?php endif;?>
          </div>
        </div>

      <?php endforeach;?>
        </div><!--/span-->
      </div><!--/row-->
<script type="text/javascript">
$(document).ready(function(){
  // $(".panel-body").hide();
  $(".panel-heading").click(function(){
    $(this).next().toggle(200);
  });
});
</script>
<?php include("/../template/footer.php");?>
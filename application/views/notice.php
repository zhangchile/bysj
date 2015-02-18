<?php include("template/header.php");?>

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
      <div class="col-md-8">
        <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">通知
          <!-- <a href="#" style="float:right;">查看所有>></a> -->
        </div>

        <!-- Table -->
<!--           <table class="table">
              <thead>
              </thead>
              <tbody>
                <?php foreach ($notice as $key => $value) :?>
                  <tr>
                    <td><a href="#<?php echo $value['id']?>"><?php echo $value['title']?></a></td>
                    <td style="float:right;">
                      <?php if(in_array("editnotice",$this->action)):?>
                      <a href="<?php echo site_url("notice/edit").'/'.$value['id']?>">修改</a>
                      <?php endif;?>
                      <?php if(in_array("delnotice",$this->action)):?>
                      <a style="cursor:pointer;" type="button" data-toggle="modal" data-target="#deleteModal" data="<?php echo site_url("notice/del").'/'.$value['id']?>">删除</a>
                      <?php endif;?>
                    </td>
                    <td style="float:right;"><?php echo date("Y年m月d日",$value['time'])?></td>
                  </tr>
                <?php endforeach;?>
              </tbody>
            </table> -->

          <ul class="list-group">
              <?php foreach ($notice as $key => $value) :?>
                  <li class="list-group-item"><a href="<?php echo site_url("noticedetail/index").'?id='.$value['id'];?>"><?php echo $value['title']?></a>
                      <?php if(in_array("delnotice",$this->action)):?>
                      <a style="float: right;cursor:pointer;" type="button" data-toggle="modal" data-target="#deleteModal" data="<?php echo site_url("notice/del").'/'.$value['id']?>">删除</a>
                      <?php endif;?>
                      <?php if(in_array("editnotice",$this->action)):?>
                      <a style="float: right;" href="<?php echo site_url("notice/edit").'/'.$value['id']?>">修改</a>
                      <?php endif;?>
                  <span style="float: right;">由 <?php echo $value['author']?> 于 <?php echo date("Y年m月d日",$value['time'])?> 发布 </span>
                  </li>
              <?php endforeach;?>              
          </ul>

      </div>
    <!-- 分页-->
    <?php echo $this->pagination->create_links();?><!-- 输出分页模块 -->
    <!--分页end-->
      </div>
      </div><!--/row-->

<?php include("template/footer.php");?>
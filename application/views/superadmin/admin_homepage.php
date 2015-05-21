<?php $this->load->view('template/header.php');?>

      <div class="row row-offcanvas row-offcanvas-right">
        <!-- 左侧栏-->
        <?php echo $sidebar;?>
        <!--end 左侧栏-->
      <div class="col-md-8 col-sm-9">
        <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">通知
          <!-- <a href="#" style="float:right;">查看所有>></a> -->
        </div>
<!--         <div class="panel-body">
          <p>公告啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊</p>
        </div> -->
          <ul class="list-group">
              <?php foreach ($notice as $key => $value) :?>
                  <li class="list-group-item"><a href="<?php echo site_url("noticedetail/index").'?id='.$value['id'];?>"><?php echo $value['title']?></a>
                  <span style="float: right;"><?php echo date("Y年m月d日",$value['time'])?></span>
                  </li>
              <?php endforeach;?>              
          </ul>
      </div>
    <?php echo $this->pagination->create_links();?><!-- 输出分页模块 -->
      </div>
      </div><!--/row-->

<?php $this->load->view("template/footer.php");?>
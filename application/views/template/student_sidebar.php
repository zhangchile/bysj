<div class="col-xs-6 col-sm-3 sidebar-default" id="sidebar" role="navigation">
  <div class="list-group">
    <a href="<?php echo site_url("student/index");?>" class="list-group-item <?php if(strstr($this->uri->segment(2),"index")) echo " active ";?>">
      主页
    </a>
    <a href="<?php echo site_url("student/repareapply");?>" class="list-group-item <?php if($this->uri->segment(2)=='repareapply') echo " active ";?>">
      宿舍维修申请
    </a>
    <a href="#" class="list-group-item <?php if($this->uri->segment(2)=='') echo " active ";?>">
      桶装水订购
    </a>
    <a href="#" class="list-group-item <?php if($this->uri->segment(2)=='') echo " active ";?>">
      宿舍水电查询
    </a>    
    <a href="#" class="list-group-item ">
        更多功能正在开发中
      </a>
  </div>
</div><!--/span-->
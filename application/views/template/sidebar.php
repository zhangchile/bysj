        <div class="col-xs-6 col-sm-3 sidebar-default" id="sidebar" role="navigation">
          <div class="list-group">
            <a href="<?php echo site_url("superadmin/homepage");?>" class="list-group-item <?php if(strstr($this->uri->uri_string(),"homepage")) echo " active ";?>">
              主页
            </a>
            <?php foreach ($sidebar as $key => $value) :?>
            <a href="<?php echo site_url($value['uri']);?>" class="list-group-item <?php if($this->uri->segment(1)==$value['uri']) echo " active ";?>">
              <?php echo $value['actioncolumnname'];?>
            </a>
            <?php endforeach;?>
            <a href="#" class="list-group-item ">
                更多功能正在开发中
              </a>
          </div>
        </div><!--/span-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>宿舍管理与服务系统</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Loading Bootstrap -->
    <link href="<?php echo base_url();?>public/css/bootstrap_metro.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="<?php echo base_url();?>public/css/offcanvas.css" rel="stylesheet">
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
    <![endif]-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?php echo base_url();?>public/js/jquery.min.js"></script>
  </head>
  <body>
    <div class="navbar navbar-fixed-top navbar-default" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="<?php echo site_url('index');?>">学生宿舍管理系统</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="<?php echo site_url('index');?>">主页</a></li>
            <li><a href="<?php echo site_url('about');?>">关于</a></li>
            <li><a href="<?php echo site_url('contact');?>">联系我</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <?php if($this->session->userdata('is_login')) :?>
            <li><a href="#">欢迎您，<?php echo $this->session->userdata('truename');?></a></li>
            <li><a href="<?php echo site_url('login/logout');?>">退出</a></li>
          <?php else :?>
          <li><a href="<?php echo site_url('login');?>">登录</a></li>
        <?php endif;?>
          </ul>
        </div><!-- /.nav-collapse -->
      </div><!-- /.container -->
<!--       <div class="navbar-header" >navbar-header</div> -->
    </div><!-- /.navbar -->
    <div class="container">

      <div class="row row-offcanvas row-offcanvas-right">
      <div class="col-md-8">
        <h2 style="text-align: center;"><?php echo ($notice[0]['title']);?></h2>
        <p style="text-align: right;">发布于 <?php echo date("Y年m月d日", $notice[0]['time']);?></p>
      <?php echo $notice[0]['content'];?>
      </div>


      <div class="col-md-4">
        <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">通知列表
          <!-- <a href="#" style="float:right;">查看所有>></a> -->
        </div>
<!--         <div class="panel-body">
          <p>公告啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊</p>
        </div> -->
          <ul class="list-group">
              <?php foreach ($noticelist as $key => $value) :?>
                  <li class="list-group-item"><a href="<?php echo site_url("noticedetail/index").'?id='.$value['id'].'&page='.$this->input->get('page');?>"><?php echo $value['title']?></a>
                  <span style="float: right;"><?php echo date("Y年m月d日",$value['time'])?></span>
                  </li>
              <?php endforeach;?>              
          </ul>
      </div>
    <?php echo $this->pagination->create_links();?><!-- 输出分页模块 -->
      </div>
      </div><!--/row-->

<?php include("template/footer.php");?>
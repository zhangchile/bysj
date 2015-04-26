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
    <link href="<?php echo base_url();?>public/css/main.css" rel="stylesheet">
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
          <a class="navbar-brand" href="<?php echo site_url('index');?>">学生宿舍管理与服务系统</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="<?php echo site_url('index');?>">主页</a></li>
            <li><a href="<?php echo site_url('about');?>">关于</a></li>
            <li><a href="<?php echo site_url('contact');?>">联系我</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">欢迎您，<?php if($this->session->userdata('is_login')) 
            echo $this->session->userdata('truename'); else redirect('login');?></a></li>
            <li><a href="<?php echo site_url('login/logout');?>">退出</a></li>
          </ul>
        </div><!-- /.nav-collapse -->
      </div><!-- /.container -->
<!--       <div class="navbar-header" >navbar-header</div> -->
    </div><!-- /.navbar -->
    <div class="container body-content">
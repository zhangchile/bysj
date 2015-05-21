<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>学生宿舍管理系统</title>
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
  </head>
  <body>
    <div class="navbar navbar-fixed-top navbar-default" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="<?php echo site_url('index');?>">学生宿舍管理与服务系统</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li ><a href="<?php echo site_url('index');?>">主页</a></li>
            <li class="active"><a href="<?php echo site_url('about');?>">关于</a></li>
            <li><a href="<?php echo site_url('contact');?>">联系我</a></li>
          </ul>
        </div><!-- /.nav-collapse -->
      </div><!-- /.container -->
    </div><!-- /.navbar -->
    
    <div class="container body-content">

     <div class="row">
        <div class="col-md-12">
          <h2 >毕业设计：学生宿舍管理与服务系统</h2>
          <h3>开发者：11级网络2班 3111006360 张智励</h3>
          <h3>开发语言：PHP+MySQL</h3>
          <h3>PHP版本：<?php echo PHP_VERSION; ?></h3>
          <h3>MySQL版本：<?php echo mysql_get_server_info(); ?></h3>
          <h3>开源框架：<a href="http://codeigniter.org.cn/" target="_blank">CodeIgniter ®</a>  
            <a href="http://www.bootcss.com/" target="_blank">Bootstrap3.0</a></h3>
        </div>
      </div>

  <hr>

      <footer>
        <p>&copy; 张智励 2014</p>
      </footer>

    </div><!--/.container-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?php echo base_url();?>public/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url();?>public/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    $("#delete,a[type=button]").click(function(){
        $("#del_ok").attr("href",$(this).attr('data'));
     });
    </script>
    <script type="text/javascript">
      $(document).ready(function() {
        $('[data-toggle=offcanvas]').click(function() {
          $('.row-offcanvas').toggleClass('active');
        });
      });
    </script>
  </body>
</html>




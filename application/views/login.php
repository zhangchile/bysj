<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">


    <title>宿舍管理与服务系统-登录</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url();?>public/css/bootstrap_metro.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url();?>public/css/login.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/css/main.css">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?php echo base_url();?>public/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url();?>public/js/bootstrap.min.js"></script>
  </head>

  <body>
    <div class="navbar navbar-default" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="<?php echo site_url('index');?>">宿舍管理与服务系统</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="<?php echo site_url('index');?>">主页</a></li>
            <li><a href="<?php echo site_url('about');?>">关于</a></li>
            <li><a href="<?php echo site_url('contact');?>">联系我</a></li>
          </ul>
        </div><!-- /.nav-collapse -->
      </div><!-- /.container -->
<!--       <div class="navbar-header" >navbar-header</div> -->
    </div><!-- /.navbar -->
    <div class="container body-content">

        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">提示</h4>
              </div>
              <div class="modal-body">
                用户名或密码错误！请重试！
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->


      <div class="row">

      <div class="col-md-8 col-sm-8">
        <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">通知
          <!-- <a href="#" style="float:right;">查看更多>></a> -->
        </div>
<!--         <div class="panel-body">
          <p>公告啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊</p>
        </div> -->

          <ul class="list-group">
              <?php foreach ($notice as $key => $value) :?>
                  <li class="list-group-item"><a href="<?php echo site_url("noticedetail/index").'?id='.$value['id'];?>" style="text-overflow: ellipsis;white-space: nowrap;width: 40%;overflow: hidden;"><?php echo $value['title']?></a>
                  <span style="float: right;"><?php echo date("Y年m月d日",$value['time'])?></span>
                  </li>
              <?php endforeach;?>              
          </ul>
      </div>
          <?php echo $this->pagination->create_links();?><!-- 输出分页模块 -->
      </div>
      <div class="col-md-4 col-sm-4">
            <?php if($error):?>
            <script type="text/JavaScript">$('#myModal').modal('show');</script>
            <form class="form-signin" role="form" action="<?php echo site_url('login/check');?>" method="post">
              <h2 class="form-signin-heading" style="margin-top:0px;">请登录</h2>
              <input type="text" class="form-control" placeholder="请输入用户名" required autofocus name="uid">
              <p></p>
              <input type="password" class="form-control" placeholder="请输入密码" required name="pwd">
                <input type="radio" value="student" name="type" checked> 学生
              <input type="radio" value="admin" name="type"> 管理员
              <p></p>
              <button class="btn btn-lg btn-primary btn-block" type="submit">登录</button>
            </form>
            <?php else:?>
            <form class="form-signin" role="form" action="<?php echo site_url('login/check');?>" method="post">
              <h2 class="form-signin-heading" style="margin-top:0px;">请登录</h2>
              <input type="text" class="form-control" placeholder="请输入用户名" required autofocus name="uid">
              <p></p>
              <input type="password" class="form-control" placeholder="请输入密码" required name="pwd">
                <input type="radio" value="student" name="type" checked> 学生
              <input type="radio" value="admin" name="type"> 管理员
              <p></p>
              <button class="btn btn-lg btn-primary btn-block" type="submit">登录</button>
            </form>
          <?php endif;?>
      </div>
      </div>
      <hr>
      <footer >
        <p>&copy; 张智励 2015</p>
      </footer>
    </div> <!-- /container -->


  </body>
</html>

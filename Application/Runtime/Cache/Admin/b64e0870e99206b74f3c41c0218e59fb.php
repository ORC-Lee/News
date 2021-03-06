<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>sing后台管理平台</title>
    <!-- Bootstrap Core CSS -->
    <link href="Public/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="Public/css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="Public/css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="Public/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="Public/css/sing/common.css" />
    <link rel="stylesheet" href="Public/css/party/bootstrap-switch.css" />
    <link rel="stylesheet" type="text/css" href="Public/css/party/uploadify.css">

    <!-- jQuery -->
    <script src="Public/js/jquery.js"></script>
    <script src="Public/js/bootstrap.min.js"></script>
    <script src="Public/js/dialog/layer.js"></script>
    <script src="Public/js/dialog.js"></script>
    <script type="text/javascript" src="Public/js/party/jquery.uploadify.js"></script>

</head>

    



<body>

<div id="wrapper">

    <?php
$navs = D("Menu")->getAdminMenus(); $index = "index"; $username = $_SESSION["adminUser"]["username"]; foreach($navs as $key=>$value){ if($value["c"] == "admin" && $username != "admin"){ unset($navs[$key]); } } ?>
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    
    <a class="navbar-brand" >singcms内容管理平台</a>
  </div>
  <!-- Top Menu Items -->
  <ul class="nav navbar-right top-nav">
    
    
    <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $username?> <b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li>
          <a href="admin.php?c=admin&a=edit"><i class="fa fa-fw fa-user"></i> 个人中心</a>
        </li>
       
        <li class="divider"></li>
        <li>
          <a href="admin.php?c=login&a=logout"><i class="fa fa-fw fa-power-off"></i> 退出</a>
        </li>
      </ul>
    </li>
  </ul>
  <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav nav_list">
      <li <?php echo (getAdminMenuActive($index)); ?>>
        <a href="admin.php"><i class="fa fa-fw fa-dashboard"></i> 首页</a>
      </li>
      <?php if(is_array($navs)): $i = 0; $__LIST__ = $navs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav): $mod = ($i % 2 );++$i;?><li <?php echo (getAdminMenuActive($nav["c"])); ?>>
        <a href="<?php echo (getAdminMenuUrl($nav)); ?>"><i class="fa fa-fw fa-bar-chart-o"></i><?php echo ($nav["name"]); ?></a>
      </li><?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
  </div>
  <!-- /.navbar-collapse -->
</nav>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">

                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i>  <a href="admin.php?c=admin">用户管理</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-edit"></i> 编辑
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-lg-6">

                    <form class="form-horizontal" id="singcms-form">
                        <div class="form-group">
                            <label for="inputname" class="col-sm-2 control-label">用户名:</label>
                            <div class="col-sm-5">
                                <input type="text" name="username" class="form-control" id="inputname" placeholder="请填写用户名" value="<?php echo ($user["username"]); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">密码:</label>
                            <div class="col-sm-5">
                                <input type="password" name="password" class="form-control" id="inputname" placeholder="请填写密码" value="<?php echo ($user["password"]); ?>"/>
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">email:</label>
                            <div class="col-sm-5">
                                <input type="text" name="email" class="form-control" id="inputname" placeholder="请填写email" value="<?php echo ($user["email"]); ?>"/>
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">真实姓名:</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="realname" id="inputPassword3" placeholder="请填写真实姓名" value="<?php echo ($user["realname"]); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">状态:</label>
                            <div class="col-sm-5">
                                <input type="radio" name="status" id="optionsRadiosInline1" value="1" <?php if($user["status"] == 1): ?>checked<?php endif; ?>> 开启
                                <input type="radio" name="status" id="optionsRadiosInline2" value="0" <?php if($user["status"] == 0): ?>checked<?php endif; ?>> 关闭
                            </div>

                        </div>
                        <input type="hidden" value="<?php echo ($user["admin_id"]); ?>" name="admin_id">
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="button" class="btn btn-default" id="singcms-button-submit">更新</button>
                            </div>
                        </div>
                    </form>


                </div>

            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
<!-- Morris Charts JavaScript -->
<script>

    var SCOPE = {
        'save_url' : 'admin.php?c=admin&a=add',
        'jump_url' : 'admin.php?c=admin',
    }
</script>
<script src="Public/js/admin/common.js"></script>



</body>

</html>
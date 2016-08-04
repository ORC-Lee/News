<?php if (!defined('THINK_PATH')) exit(); $config = D("Basic")->select(); $menus = D("Menu")->getBarMenus(); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo ($config["title"]); ?></title>
    <meta name="keywords" content="<?php echo ($config["keywords"]); ?>">
    <meta name="description" content="<?php echo ($config["description"]); ?>">
    <link rel="stylesheet" href="Public/css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="Public/css/home/main.css" type="text/css" />
</head>
<body>
<header id="header">
    <div class="navbar-inverse">
        <div class="container">
            <div class="navbar-header">
                <a href="index.php?m=Home&c=Index&a=index">
                    <img src="Public/images/logo.png" alt="">
                </a>
            </div>
            <ul class="nav navbar-nav navbar-left">
                <li><a href="index.php?m=Home&c=Index&a=index" <?php if($result['catId'] == 0): ?>class="curr"<?php endif; ?>>首页</a></li>
                <?php if(is_array($menus)): foreach($menus as $key=>$menu): ?><li><a href="index.php?c=Cat&id=<?php echo ($menu["menu_id"]); ?>" <?php if($menu['menu_id'] == $result['catId']): ?>class="curr"<?php endif; ?>><?php echo ($menu["name"]); ?></a></li><?php endforeach; endif; ?>
            </ul>
        </div>
    </div>
</header>
    <section>
        <div class="container" style="..." align="center">
            <h1 style="color:red"><?php echo ($message); ?></h1>
            <h3 id="location">系统将在<span style="color:red">3</span>秒后自动跳转到首页</h3>
        </div>
    </section>
</body>
<script src="Public/js/jquery.js"></script>
<script>
    var time = 3;
    //首页
    var url = "index.php?m=Home&c=Index&a=index";
    setInterval("refer()", 1000);
    function refer() {
        if (0 == time){
            window.location.href = url;
        }else {
            $("#location span").html(time);
            --time;
        }
    }
</script>
</html>
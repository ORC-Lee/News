<?php if (!defined('THINK_PATH')) exit();?><!--网站头部部分-->
<?php
$config = D("Basic")->select(); $menus = D("Menu")->getBarMenus(); ?>
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
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-9">
                <div class="news-detail">
                        <h1><?php echo ($result['news']["title"]); ?></h1>
                        <img width=860 height=435 src="<?php echo ($result['news']["thumb"]); ?>" alt="">
                        <h4 class="news-intro">
                            <?php echo ($result['news']["content"]); ?>
                        </h4>
                        <div class="news-info" align="right">
                            作者：<?php echo ($result['news']["username"]); ?> <span><?php echo (date("Y-m-d H:i:s", $result['news']["create_time"])); ?></span> 阅读(<?php echo ($result['news']["count"]); ?>)
                        </div>
                </div>
            </div>
            <!--网站右侧部分-->
            <div class="col-sm-3 col-md-3">
    <div class="right-title">
        <h3>文章排行</h3>
        <span>TOP ARTICLES</span>
    </div>
    <div class="right-content">
        <?php if(is_array($result['newsList'])): $i = 0; $__LIST__ = $result['newsList'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$newList): $mod = ($i % 2 );++$i;?><ul>
            <li class="num<?php echo ($key+1); ?> curr">
                <a target="_blank" href="index.php?c=Detail&id=<?php echo ($newList["news_id"]); ?>"><?php echo ($newList["title"]); ?></a>
                <?php if($key == 0): ?><div class="intro">
                        <?php echo ($newList["description"]); ?>
                    </div><?php endif; ?>
            </li>
        </ul><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
    <?php if(is_array($result['rightAdvs'])): $i = 0; $__LIST__ = $result['rightAdvs'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$rightAdv): $mod = ($i % 2 );++$i;?><div class="right-hot">
            <a target="_blank" href="<?php echo ($rightAdv["url"]); ?>"><img src="<?php echo ($rightAdv["thumb"]); ?>" alt="<?php echo ($rightAdv["title"]); ?>"></a>
        </div><?php endforeach; endif; else: echo "" ;endif; ?>
</div>
        </div>
    </div>
</section>
</body>
</html>
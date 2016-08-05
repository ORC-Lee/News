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
        <div class="banner">
          <div class="banner-left">
            <div class="banner-info"><span>阅读数</span><i class="news_count node-<?php echo ($result['topPicNews'][0]['news_id']); ?>" news-id="<?php echo ($result['topPicNews'][0]['news_id']); ?>"></i></div>
            <a target="_blank" href="index.php?c=Detail&id=<?php echo ($result['topPicNews'][0]["news_id"]); ?>"><img src="<?php echo ($result['topPicNews'][0]["thumb"]); ?>" alt=""></a>
          </div>
          <div class="banner-right">
            <ul>
              <?php if(is_array($result['topSmallNews'])): foreach($result['topSmallNews'] as $key=>$topSmallNew): ?><li>
                <a target="_blank" href="index.php?c=Detail&id=<?php echo ($topSmallNew["news_id"]); ?>"><img src="<?php echo ($topSmallNew["thumb"]); ?>" alt=""></a>
              </li><?php endforeach; endif; ?>
            </ul>
          </div>
        </div>
        <div class="news-list">
          <?php if(is_array($result['newsList'])): foreach($result['newsList'] as $key=>$newList): ?><dl>
            <dt><a target="_blank" href="index.php?c=Detail&id=<?php echo ($newList["news_id"]); ?>"><?php echo ($newList["title"]); ?></a></dt>
            <dd class="news-img">
              <a target="_blank" href="index.php?c=Detail&id=<?php echo ($newList["news_id"]); ?>"><img width=200 height=120 src="<?php echo ($newList["thumb"]); ?>" alt=""></a>
            </dd>
            <dd class="news-intro">
              <?php echo ($newList["description"]); ?>
            </dd>
            <dd class="news-info">
              作者：<?php echo ($newList["username"]); ?> <span><?php echo (date("Y-m-d H:i:s",$newList["create_time"])); ?></span> 阅读( <i class="news_count node-<?php echo ($newList["news_id"]); ?>" news-id="<?php echo ($newList["news_id"]); ?>" ></i> )
            </dd>
          </dl><?php endforeach; endif; ?>
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
<script src="Public/js/jquery.js"></script>
<script src="Public/js/count.js"></script>
</body>
</html>
<?php
namespace Home\Controller;

use Think\Controller;

class IndexController extends CommonController
{
    public function index()
    {
        //获取首页大图推荐位数据
        $topPicNews = D("PositionContent")->findByPosId(1, 1);
        //获取小图推荐位数据
        $topSmallNews = D("PositionContent")->findByPosId(3, 3);
        //获取文章数据
        $newsList = D("News")->getRank(30);
        //获取右侧广告位数据
        $rightAdvs = D("PositionContent")->findByPosId(5, 2);

        $this->assign("result", array(
            "topPicNews" => $topPicNews,
            "topSmallNews" =>$topSmallNews,
            "newsList" =>$newsList,
            "rightAdvs" =>$rightAdvs,
            "catId" => 0
        ));

        $this->display();
    }
}
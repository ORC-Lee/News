<?php
namespace Home\Controller;

use Think\Controller;

class IndexController extends Controller
{
    public function index()
    {
        //获取首页大图推荐位数据
        $topPicNews = D("PositionContent")->findByPosId(1, 1);
        //获取小图推荐位数据
        $topSmallNews = D("PositionContent")->findByPosId(3, 3);

        $this->assign("topPicNews", $topPicNews);
        $this->assign("topSmallNews", $topSmallNews);

        $this->display();
    }
}
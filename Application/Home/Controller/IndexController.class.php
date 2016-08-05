<?php
namespace Home\Controller;

use Think\Controller;
use Think\Exception;

class IndexController extends CommonController
{
    public function index($type = "")
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

        if ($type == "buildHtml"){
            $this->buildHtml("index", HTML_PATH, "Index/index");
        }else{
            $this->display();
        }
    }

    public function build_html(){
        $this->index("buildHtml");
        return show(1, "更新首页缓存成功");
    }

    public function getCount(){
        if (!$_POST){
            return show(0, "没有任何数据");
        }
        $newsIds = array_unique($_POST);
        try{
            $res = D("News")->getNewsByNewsIdIn($newsIds);
            foreach ($res as $key=>$value){
                $data[$value["news_id"]] = $value["count"];
            }
            return show(1,"获取计数器数据成功", $data);
        }catch(Exception $e){
            return show(0, $e->getMessage());
        }
    }
}
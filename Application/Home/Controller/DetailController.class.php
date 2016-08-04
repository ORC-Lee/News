<?php
namespace Home\Controller;

use Think\Controller;
use Think\Exception;

class DetailController extends CommonController
{
    public function index()
    {
        $id = $_GET["id"];
        if (!$id || !is_numeric($id)){
            return parent::error("id不合法");
        }
        //取得右侧排行数据
        $rightRank = D("News")->getRank(10);
        //取得右侧广告数据
        $rightAdvs = D("PositionContent")->findByPosId(5,2);

        $news = D("News")->find($id);
        if (!$news || $news['status'] != 1){
            return parent::error("文章不存在或文章不是开启状态");
        }

        $newsContent = D("NewsContent")->find($id);
        if (!$newsContent){
            return parent::error("文章内容不存在");
        }
        $news["content"] = htmlspecialchars_decode($newsContent["content"]);

        //计数器+1,写入数据库count字段
        $news["count"] = intval($news["count"]) + 1;
        try {
            $res = D("News")->updateCountById($id, $news["count"]);
            if (false === $res){
                return false;
            }
        }catch(Exception $e){
            return parent::error($e->getMessage());
        }

        $this->assign("result", array(
            "newsList" => $rightRank,
            "rightAdvs" => $rightAdvs,
            "news" => $news
        ));
        return $this->display();
    }
}
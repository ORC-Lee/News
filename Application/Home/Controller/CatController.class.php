<?php
namespace Home\Controller;

use Think\Controller;

class CatController extends CommonController
{
    public function index()
    {
        //取右侧排行数据
        $rightRank = D("News")->getRank(20);
        //取右侧广告位数据
        $rightAdvs = D("PositionContent")->findByPosId(5, 2);
        $id = $_GET["id"];
        if (!$id || !is_numeric($id)){
            return parent::error("id不合法");
        }
        $res = D("Menu")->find($id);
        if (!$res || 1 != $res["status"]){
            return parent::error("栏目id不存在或栏目不是开启状态");
        }

        //分页操作
        $page = $_REQUEST["p"] ? $_REQUEST["p"] : 1;
        $pageSize = $_REQUEST["pageSize"] ? $_REQUEST["pageSize"] : 2;
        $where = array("catid" => $res['menu_id']);

        $news = D("News")->getNews($page, $pageSize, $where);
        $totalCount = D("News")->getNewsCount($where);

        $pageRes = new \Think\Page($totalCount, $pageSize);
        $pageRes = $pageRes->show();

        $this->assign("result", array(
            "newsList" => $rightRank,
            "rightAdvs" => $rightAdvs,
            "news" => $news,
            "pageRes" => $pageRes,
            "catId" => $id
        ));

        return $this->display();
    }
}
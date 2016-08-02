<?php
namespace Admin\Controller;

use Think\Controller;
use Think\Exception;

class PositionContentController extends CommonController
{
    public function index()
    {
        $where = array();
        if ($_GET["position_id"]) {
            $where["position_id"] = intval($_GET["position_id"]);
            $this->assign("positionId", $_GET["position_id"]);
        }
        if ($_GET["title"]) {
            $where["title"] = trim($_GET["title"]);
            $this->assign("title", $_GET["title"]);
        }
        //获取推荐位列表
        $positions = D("Position")->getNormalPositions();
        $this->assign("positions", $positions);

        //分页显示推荐位内容
        $page = $_REQUEST["p"] ? $_REQUEST["p"] : 1;
        $pageSize = $_REQUEST["pageSize"] ? $_REQUEST["pageSize"] : 2;

        $posContent = D("PositionContent")->getPosContents($page, $pageSize, $where);
        $posCount = D("PositionContent")->getPosContentCount($where);

        $pos = new \Think\Page($posCount, $pageSize);

        $poss = $pos->show();

        $this->assign("poss", $poss);
        $this->assign("posContents", $posContent);

        return $this->display();
    }

    public function setStatus()
    {
        $data = array(
            "id" => $_POST["id"],
            "status" => $_POST["status"]
        );
        return parent::setStatus($data, "PositionContent");
    }

    public function add()
    {
        $poss = D("Position")->getNormalPositions();
        if (false == $poss) {
            return show(0, "获取推荐位失败");
        }
        if ($_POST) {
            if (!isset($_POST["title"]) || !$_POST["title"]) {
                return show(0, "推荐位标题不能为空");
            }
            if (!isset($_POST["position_id"]) || !is_numeric($_POST["position_id"])) {
                return show(0, "请选择推荐位");
            }

            if (!$_POST["url"] && !$_POST["news_id"]){
                return show(0, "url和文章id不能同时为空");
            }

            if (!isset($_POST["thumb"]) || !$_POST["thumb"]){
                if ($_POST["news_id"]){
                    $res = D("News")->find($_POST["news_id"]);
                    if ($res && is_array($res)){
                        $_POST["thumb"] = $res["thumb"];
                    }
                }else{
                    return show(0, "缩图不能为空");
                }
            }

            if ($_POST["id"]) {
                $id = $_POST["id"];
                unset($_POST["id"]);
                $this->save($id, $_POST);
            }

            try {
                $_POST["create_time"] = time();
                $res = D("PositionContent")->insert($_POST);
                if ($res) {
                    return show(1, "新增成功");
                }
                return show(0, "新增失败");
            } catch (Exception $e) {
                return show(0, $e->getMessage());
            }
        }

        $this->assign("poss", $poss);

        return $this->display();
    }

    public function edit()
    {
        $id = $_GET["id"];
        try {
            $posContent = D("PositionContent")->findById($id);
            if (false === $posContent) {
                return show(0, "查询推荐位内容失败");
            }
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
        $poss = D("Position")->getNormalPositions();

        $this->assign("posContent", $posContent);
        $this->assign("poss", $poss);

        return $this->display();
    }

    public function save($id, $data)
    {
        try {
            $res = D("PositionContent")->updatePosContentById($id, $data);
            if (false === $res) {
                return show(0, "更新失败");
            }
            return show(1, "更新成功");
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }

    public function delete(){
        $id = $_POST["id"];
        try {
            $res = D("PositionContent")->delete($id);
            if (false === $res){
                return show(0, "删除失败");
            }
            return show(1, "删除成功");
        }catch (Exception $e){
            return show(0, $e->getMessage());
        }
    }
}
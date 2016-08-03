<?php
namespace Admin\Controller;

use Org\Util\Date;
use Think\Controller;
use Think\Exception;

class PositionController extends CommonController
{
    public function index()
    {
        $where = array();
        if ($_GET["name"]) {
            $where["name"] = $_GET["name"];
            $this->assign("name", $_GET["name"]);
        }
        $page = $_REQUEST["p"] ? $_REQUEST["p"] : 1;
        $pageSize = $_REQUEST["pageSize"] ? $_REQUEST["pageSize"] : 2;

        $positions = D("Position")->getAllPositions($page, $pageSize, $where);
        $posCount = D("Position")->getPositionCount($where);

        $Res = new \Think\Page($posCount, $pageSize);
        $pageRes = $Res->show();


        $this->assign("positions", $positions);
        $this->assign("pageRes", $pageRes);
        $this->assign("positions", $positions);

        $this->display();
    }

    public function setStatus()
    {
        $data = array(
            "id" => $_POST["id"],
            "status" => $_POST["status"]
        );
        parent::setStatus($data, "Position");
    }

    public function add()
    {
        if ($_POST) {
            if (!isset($_POST["name"]) || !$_POST["name"]) {
                return show(0, "推荐位名不能为空");
            }
            if (!isset($_POST["description"]) || !$_POST["description"]) {
                return show(0, "推荐位描述不能为空");
            }
            if ($_POST["id"]){
                $id = $_POST["id"];
                unset($_POST["id"]);
                $this->save($id, $_POST);
            }
            $data = $_POST;
            $data["create_time"] = time();
            try {
                $res = D("Position")->insert($data);
                if (false === $res) {
                    return show(0, "添加失败");
                }
                return show(1, "添加成功");
            } catch (Exception $e) {
                return show(0, $e->getMessage());
            }
        } else {
            return $this->display();
        }
    }

    public function edit(){
        $id = $_GET["id"];
        $position = D("Position")->findPosById($id);
        $this->assign("position",$position);
        return $this->display();
    }

    public function save($id, $data){
        try {
            $res = D("Position")->updatePosById($id, $data);
            if (false === $res){
                return show(0, "更新失败");
            }
            return show(1, "更新成功");
        }catch (Exception $e){
            return show(0, $e->getMessage());
        }
    }

    public function delete(){
        $id = $_POST["id"];
        try {
            $res = D("Position")->deletePosById($id);
            if (false === $res) {
                return show(0, "删除失败");
            }
            return show(1, "删除成功");
        }catch (Exception $e){
            return show(0, $e->getMessage());
        }
    }
}
<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Exception;

class AdminController extends CommonController{
    public function index(){
        $page = $_REQUEST["p"] ? $_REQUEST["p"] : 1;
        $pageSize = $_REQUEST["pageSize"] ? $_REQUEST["pageSize"] : 2;
        $totalCount = D("Admin")->getAdminsCount();
        $users = D("Admin")->getAdmins($page, $pageSize);

        $res = new \Think\Page($totalCount, $pageSize);
        $pageRes = $res->show();

        $this->assign("pageRes", $pageRes);
        $this->assign("users", $users);

        return $this->display();
    }

    public function setStatus(){
        $jumpUrl = $_SERVER["HTTP_REFERER"];
        $id = $_POST["id"];
        $status = $_POST["status"];
        try {
            $res = D("Admin")->updateStatusById($id, $status);
            if (false == $res){
                return show(0, "更新失败");
            }
            return show(1, "更新成功", array("jump_url"=>$jumpUrl));
        }catch(Exception $e){
            return show(0, $e->getMessage());
        }
    }

    public function add(){
        if ($_POST) {
            if (!isset($_POST["username"]) || !$_POST["username"]) {
                return show(0, "用户名不能为空");
            }
            if (!isset($_POST["email"]) || !$_POST["email"]) {
                return show(0, "email不能为空");
            }
            if (!isset($_POST["realname"]) || !$_POST["realname"]) {
                return show(0, "真实姓名不能为空");
            }
            if ($_POST["admin_id"]){
                $id = $_POST["admin_id"];
                unset($_POST["admin_id"]);
                $this->save($id, $_POST);
            }
            $res = D("Admin")->insert($_POST);
            if (false === $res) {
                return show(0, "添加失败");
            }else {
                return show(1, "添加成功");
            }
        }else {
            return $this->display();
        }
    }

    public function edit(){
        if ($_GET["id"]) {
            $id = $_GET["id"];
        }else if($_SESSION["adminUser"]["admin_id"]){
            $id = $_SESSION["adminUser"]["admin_id"];
        }
        try {
            $user = D("Admin")->getAdminById($id);
            if (false === $user){
                return show(0, "获取用户数据失败");
            }
        }catch (Exception $e){
            return show(0, $e->getMessage());
        }

        $this->assign("user", $user);
        return $this->display();
    }

    public function save($id, $data){
        try {
            $res = D("Admin")->updateAdminById($id, $data);
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
            $res = D("Admin")->deleteAdminById($id);
            if (false === $res){
                return show(0, "删除失败");
            }
            return show(1, "删除成功");
        }catch (Exception $e){
            return show(0, $e->getMessage());
        }
    }

}
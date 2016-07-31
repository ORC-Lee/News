<?php
namespace Admin\Controller;

use Think\Controller;
use Think\Exception;

class MenuController extends CommonController
{
    public function index()
    {
        $where = array();
        if (isset($_REQUEST["type"]) && in_array($_REQUEST["type"], array(0, 1))) {
            $where["type"] = intval($_REQUEST["type"]);
            $this->assign("type", $where["type"]);
        } else {
            $this->assign("type", -1);
        }
        /**
         * 分页操作逻辑
         */
        $page = $_REQUEST["p"] ? $_REQUEST["p"] : 1;
        $pageSize = $_REQUEST["pageSize"] ? $_REQUEST["pageSize"] : 5;
        $totalRows = D("Menu")->getMenuCount($where);
        $menus = D("Menu")->getMenus($page, $pageSize, $where);

        $result = new \Think\Page($totalRows, $pageSize);
        $pageResult = $result->show();

        $this->assign("menus", $menus);
        $this->assign("pageResult", $pageResult);

        return $this->display();
    }

    public function add()
    {
        if ($_POST) {
            if (!isset($_POST["name"]) || !$_POST["name"]) {
                show(0, "菜单名不能为空");
            }
            if (!isset($_POST["m"]) || !$_POST["m"]) {
                show(0, "模块不能为空");
            }
            if (!isset($_POST["c"]) || !$_POST["c"]) {
                show(0, "控制器不能为空");
            }
            if (!isset($_POST["f"]) || !$_POST["f"]) {
                show(0, "方法不能为空");
            }
            if ($_POST["menu_id"]){
                $this->save($_POST);
            }
            //向数据库插入数据
            $insert_Id = D("Menu")->insert($_POST);
            if ($insert_Id) {
                show(1, "添加成功");
            } else {
                show(0, "添加失败");
            }
        } else {
            return $this->display();
        }
    }

    public function edit(){
        $menuId = $_GET["id"];
        $menu = D("Menu")->find($menuId);
        $this->assign("menu", $menu);
        return $this->display();
    }

    public function save($data){
        $menuId = $data["menu_id"];
        unset($data["menu_id"]);
        try{
            $ret = D("Menu")->updateMenuById($menuId, $data);
            if (false === $ret){
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
            $ret = D("Menu")->deleteMenuById($id);
            if (false === $ret) {
                show(0, "删除失败");
            }
            show(1, "删除成功");
        }catch (Exception $e){
            show(0, $e->getMessage());
        }
    }
}
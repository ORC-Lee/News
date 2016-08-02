<?php
namespace Admin\Controller;

use Think\Controller;
use Think\Exception;

class BasicController extends CommonController
{
    public function index()
    {
        $message = D("Basic")->select();
        $this->assign("message", $message);
        return $this->display();
    }

    public function add()
    {
        if (!$_POST["title"]) {
            return show(0, "站点标题不能为空");
        }
        if (!$_POST["keywords"]) {
            return show(0, "站点关键词不能为空");
        }
        if (!$_POST["description"]) {
            return show(0, "站点描述不能为空");
        }
        try {
            D("Basic")->save($_POST);
            return show(1, "配置成功");
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }

    }
}
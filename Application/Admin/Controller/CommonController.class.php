<?php
namespace Admin\Controller;

use Think\Controller;

/**
 * use Common\Model 这块可以不需要使用，框架默认会加载里面的内容
 */
class CommonController extends Controller
{

    public function __construct()
    {

        parent::__construct();
        $this->_init();
    }

    /**
     * 初始化
     */
    private function _init()
    {
        // 如果已经登录
        $isLogin = $this->isLogin();
        if (!$isLogin) {
            // 跳转到登录页面
            $this->redirect('/admin.php?c=login');
        }
    }

    /**
     * 获取登录用户信息
     * @return array
     */
    public function getLoginUser()
    {
        return session("adminUser");
    }

    /**
     * 判定是否登录
     * @return boolean
     */
    public function isLogin()
    {
        $user = $this->getLoginUser();
        if ($user && is_array($user)) {
            return true;
        }

        return false;
    }


    /**
     * 设置状态值
     * @param $data
     * @param $model
     */
    public function setStatus($data, $model)
    {
        try {
            if ($data) {
                $jumpUrl = $_SERVER["HTTP_REFERER"];
                $id = $data["id"];
                $status = $data["status"];
                $res = D($model)->setStatusById($id, $status);
                if (false == $res) {
                    return show(0, "修改状态失败");
                }
            }
            return show(1, "修改状态成功", array("jump_url" => $jumpUrl));
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }

}
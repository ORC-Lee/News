<?php
namespace Common\Model;

use Think\Model;

class MenuModel extends Model
{
    private $_db = "";

    public function __construct()
    {
        $this->_db = M("Menu");
    }

    /**
     * 向数据库插入数据
     * @param array $data
     * @return int|mixed
     */
    public function insert($data = array())
    {
        if (!$data || !is_array($data)) {
            return 0;
        }
        return $this->_db->add($data);
    }

    /**
     * 从数据库中取得记录的条数
     * @param array $where
     * @return string
     */
    public function getMenuCount($where = array())
    {
        return $this->_db->where($where)->count();
    }

    /**
     * 从数据库中取得数据
     * @param int $page
     * @param int $pageSize
     * @param array $where
     * @return array
     */
    public function getMenus($page = 1, $pageSize = 10, $where = array()){
        $offset = ($page - 1) * $pageSize;
        $ret = $this->_db->where($where)->order("menu_id desc")->limit("$offset, $pageSize")->select();
        return $ret;
    }

    /**
     * 根据菜单Id从数据库取一条数据
     * @param $id
     * @return mixed
     */
    public function find($id){
        if (!$id || !is_numeric($id)){
            return array();
        }
        return $this->_db->where("menu_id=".$id)->find();
    }

    /**
     * 根据Id更新数据库中的数据
     * @param $id
     * @param $data
     * @return bool or number
     */
    public function updateMenuById($id, $data){
        if (!$id || !is_numeric($id)){
            throw_exception("Id不合法");
        }
        if (!$data || !is_array($data)){
            throw_exception("更新的数据不合法");
        }
        return $this->_db->where("menu_id=".$id)->save($data);
    }

    /**
     * 从数据库中删除数据
     * @param $id
     * @return mixed
     */
    public function deleteMenuById($id){
        if (!$id || !is_numeric($id)){
            throw_exception("Id不合法");
        }
        return $this->_db->where("menu_id=".$id)->delete();
    }

    /**
     * 从数据库取后台菜单
     * @return array
     */
    public function getAdminMenus(){
        return $this->_db->where("type=1")-> order("menu_id asc")->select();
    }

    /**
     * 从数据库取前端项目菜单
     * @return array
     */
    public function getBarMenus(){
        return $this->_db->where("type=0")->order("menu_id asc")->select();
    }

    /**
     * 修改状态值
     * @param $id
     * @param $status
     * @return bool
     */
    public function setStatusById($id, $status){
        if (!$id || !is_numeric($id)){
            throw_exception("id不合法");
        }
        if (!is_numeric($status)){
            throw_exception("状态值不合法");
        }
        $data["status"] = $status;
        return $this->_db->where("menu_id=".$id)->save($data);
    }
}
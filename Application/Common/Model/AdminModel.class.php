<?php
namespace Common\Model;

use Think\Model;

class AdminModel extends Model
{
    private $_db = "";

    public function __construct(){
        $this->_db = M("Admin");
    }

    /**
     * 通过用户名从数据库中取用户数据
     * @param $username
     * @return array
     */
    public function getAdminByUsername($username){
        $ret = $this->_db->where("username='".$username."'")->find();
        return $ret;
    }

    /**
     * 从数据库中取所有用户的数据
     * @param $page
     * @param int $pageSize
     * @param array $where
     * @return mixed
     */
    public function getAdmins($page, $pageSize = 10, $where = array()){
        $offset = ($page - 1) *$pageSize;
        return $this->_db->where($where)->order("admin_id desc")->limit($offset, $pageSize)->select();
    }


    /**
     * 从数据库中取表中所有记录的条数
     * @param array $where
     * @return mixed
     */
    public function getAdminsCount($where = array()){
        return $this->_db->where($where)->count();
    }

    /**
     * 根据id更改用户状态
     * @param $id
     * @param $status
     * @return bool
     */
    public function updateStatusById($id, $status){
        if(!$id || !is_numeric($id)){
            throw_exception("id不合法");
        }
        if (!is_numeric($status)){
            throw_exception("状态值不合法");
        }
        $data["status"] = $status;
        return $this->_db->where("admin_id=".$id)->save($data);
    }

    /**
     * 添加用户操作
     * @param $data
     * @return mixed
     */
    public function insert($data){
        $data["password"] = md5($data["password"].C("MD5_PRE"));
        $data["lastlogintime"] = time();
        return $this->_db->add($data);
    }

    /**
     * 根据id取用户数据
     * @param $id
     * @return mixed
     */
    public function getAdminById($id){
        if (!$id || !is_numeric($id)){
            throw_exception("id不合法");
        }
        return $this->_db->where("admin_id=".$id)->find();
    }

    /**
     * 根据id更新用户数据
     * @param $id
     * @param $data
     * @return bool
     */
    public function updateAdminById($id, $data){
        if (!$id || !is_numeric($id)){
            throw_exception("id不合法");
        }
        if (!$data || !is_array($data)){
            throw_exception("更新数据不合法");
        }
        $data["password"] = md5($data["password"].C("MD5_PRE"));
        return $this->_db->where("admin_id=".$id)->save($data);
    }

    /**
     * 根据id删除用户
     * @param $id
     * @return mixed
     */
    public function deleteAdminById($id){
        if (!$id || !is_numeric($id)){
            throw_exception("id不合法");
        }
        return $this->_db->where("admin_id=".$id)->delete();
    }

    /**
     * 取得用户登录数
     * @return mixed
     */
    public function getLoginUsers(){
        $time = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
        $data = array(
            "status" => 1,
            "lastlogintime" => array("gt", $time),
        );
        return $this->_db->where($data)->count();
    }
}


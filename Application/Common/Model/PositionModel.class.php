<?php
namespace Common\Model;

use Think\Model;

class PositionModel extends Model
{
    private $_db = "";

    public function __construct()
    {
        $this->_db = M("position");
    }

    public function getNormalPositions()
    {
        $condition = array("status" => 1);
        return $this->_db->where($condition)->order("id")->select();
    }
    
    public function getAllPositions($page, $pageSize = 10, $where = array()){
        $offset = ($page - 1) * $pageSize;
        return $this->_db->where($where)->order("id")->limit("$offset, $pageSize")->select();
    }

    public function getPositionCount($where = array()){
        return $this->_db->where($where)->count();
    }

    public function setStatusById($id, $status){
        if (!$id || !is_numeric($id)){
            throw_exception("id不合法");
        }
        if (!is_numeric($status)){
            throw_exception("状态值不合法");
        }
        $where["id"] = $id;
        $data["status"] = $status;
        return $this->_db->where($where)->save($data);
    }
}
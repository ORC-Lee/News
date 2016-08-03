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

    public function getAllPositions($page, $pageSize = 10, $where = array())
    {
        if ($where && isset($where)) {
            $where["name"] = array("like", "%" . $where["name"] . "%");
        }
        $offset = ($page - 1) * $pageSize;
        return $this->_db->where($where)->order("id desc")->limit("$offset, $pageSize")->select();
    }

    public function getPositionCount($where = array())
    {
        if ($where && isset($where)) {
            $where["name"] = array("like", "%" . $where["name"] . "%");
        }
        return $this->_db->where($where)->count();
    }

    public function setStatusById($id, $status)
    {
        if (!$id || !is_numeric($id)) {
            throw_exception("id不合法");
        }
        if (!is_numeric($status)) {
            throw_exception("状态值不合法");
        }
        $where["id"] = $id;
        $data["status"] = $status;
        return $this->_db->where($where)->save($data);
    }

    public function insert($data)
    {
        if (!$data || !is_array($data)) {
            throw_exception("添加的数据不合法");
        }
        $this->_db->add($data);
    }

    public function findPosById($id){
        if (!$id || !is_numeric($id)){
            return 0;
        }
        $where["id"] = $id;
        return $this->_db->where($where)->find();
    }

    public function updatePosById($id, $data){
        if (!$id || !is_numeric($id)){
            throw_exception("id不合法");
        }
        if (!$data || !is_array($data)){
            throw_exception("更新数据不合法");
        }
        $where["id"] = $id;
        return $this->_db->where($where)->save($data);
    }

    public function deletePosById($id){
        if (!$id || !is_numeric($id)){
            throw_exception("id不合法");
        }
        $where["id"] = $id;
        return $this->_db->where($where)->delete();
    }
}
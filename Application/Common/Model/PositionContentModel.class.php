<?php
namespace Common\Model;

use Think\Model;

class PositionContentModel extends Model
{
    private $_db = "";

    public function __construct()
    {
        $this->_db = M("position_content");
    }

    public function insert($data)
    {
        if (!is_array($data) || !$data) {
            throw_exception("插入数据不合法");
        }
        return $this->_db->add($data);
    }

    public function getPosContents($page, $pageSize = 10, $where = array()){
        $offset = ($page - 1) * $pageSize;
        if (isset($where["title"]) && $where["title"]) {
            $where["title"] = array("like", array("%" . $where["title"] . "%"));
        }
        if (isset($where["position_id"]) && isset($where["position_id"])){
            $where["position_id"] = intval($where["position_id"]);
        }
        return $this->_db->where($where)->order("id desc")->limit("$offset,$pageSize")->select();
    }

    public function getPosContentCount($where = array()){
        return $this->_db->where($where)->count();
    }

    public function setStatusById($id, $status){
        if (!$id || !is_numeric($id)){
            throw_exception("id不合法");
        }
        if (!is_numeric($status)){
            throw_exception("状态值不合法");
        }
        $data["status"] = $status;
        return $this->_db->where("id=".$id)->save($data);
    }

    public function findById($id){
        if (!is_numeric($id) || !$id){
            throw_exception("id不合法");
        }
        $data["id"] = $id;
        return $this->_db->where($data)->find();
    }

    public function updatePosContentById($id, $data){
        if (!$id || !is_numeric($id)){
            throw_exception("id不合法");
        }
        if (!$data || !is_array($data)){
            throw_exception("更新的数据不合法");
        }
        $where["id"] = $id;
        return $this->_db->where($where)->save($data);
    }

    public function delete($id){
        if (!$id || !is_numeric($id)){
            throw_exception("id不合法");
        }
        $data["id"] = $id;
        return $this->_db->where($data)->delete();
    }
}
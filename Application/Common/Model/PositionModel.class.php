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

    /**
     * 取得状态为开启的推荐位
     * @return mixed
     */
    public function getNormalPositions()
    {
        $condition = array("status" => 1);
        return $this->_db->where($condition)->order("id")->select();
    }

    /**
     * 取得所有推荐位信息
     * @param $page
     * @param int $pageSize
     * @param array $where
     * @return mixed
     */
    public function getAllPositions($page, $pageSize = 10, $where = array())
    {
        if ($where && isset($where)) {
            $where["name"] = array("like", "%" . $where["name"] . "%");
        }
        $offset = ($page - 1) * $pageSize;
        return $this->_db->where($where)->order("id desc")->limit("$offset, $pageSize")->select();
    }

    /**
     *取得推荐位的总数
     * @param array $where
     * @return mixed
     */
    public function getPositionCount($where = array())
    {
        if ($where && isset($where)) {
            $where["name"] = array("like", "%" . $where["name"] . "%");
        }
        return $this->_db->where($where)->count();
    }

    /**
     * 根据id更改状态
     * @param $id
     * @param $status
     * @return bool
     */
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

    /**
     * 插入操作
     * @param $data
     */
    public function insert($data)
    {
        if (!$data || !is_array($data)) {
            throw_exception("添加的数据不合法");
        }
        $this->_db->add($data);
    }

    /**
     * 根据id取推荐位
     * @param $id
     * @return int|mixed
     */
    public function findPosById($id){
        if (!$id || !is_numeric($id)){
            return 0;
        }
        $where["id"] = $id;
        return $this->_db->where($where)->find();
    }

    /**
     * 根据id更新推荐位
     * @param $id
     * @param $data
     * @return bool
     */
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

    /**
     * 根据id删除推荐位
     * @param $id
     * @return mixed
     */
    public function deletePosById($id){
        if (!$id || !is_numeric($id)){
            throw_exception("id不合法");
        }
        $where["id"] = $id;
        return $this->_db->where($where)->delete();
    }
}
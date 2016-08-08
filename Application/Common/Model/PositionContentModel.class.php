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

    /**
     * 插入操作
     * @param $data
     * @return mixed
     */
    public function insert($data)
    {
        if (!is_array($data) || !$data) {
            throw_exception("插入数据不合法");
        }
        return $this->_db->add($data);
    }

    /**
     * 取得推荐位内容
     * @param $page
     * @param int $pageSize
     * @param array $where
     * @return mixed
     */
    public function getPosContents($page, $pageSize = 10, $where = array()){
        $offset = ($page - 1) * $pageSize;
        if (isset($where["title"]) && $where["title"]) {
            $where["title"] = array("like", array("%" . $where["title"] . "%"));
        }
        if (isset($where["position_id"]) && isset($where["position_id"])){
            $where["position_id"] = intval($where["position_id"]);
        }
        return $this->_db->where($where)->order("listorder desc, id desc")->limit("$offset,$pageSize")->select();
    }

    /**
     * 取得推荐位内容的记录数
     * @param array $where
     * @return mixed
     */
    public function getPosContentCount($where = array()){
        if (isset($where["title"]) && $where["title"]) {
            $where["title"] = array("like", array("%" . $where["title"] . "%"));
        }
        if (isset($where["position_id"]) && isset($where["position_id"])){
            $where["position_id"] = intval($where["position_id"]);
        }
        return $this->_db->where($where)->count();
    }

    /**
     * 根据id设置状态
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
        return $this->_db->where("id=".$id)->save($data);
    }

    /**
     * 根据id取一条记录
     * @param $id
     * @return mixed
     */
    public function findById($id){
        if (!is_numeric($id) || !$id){
            throw_exception("id不合法");
        }
        return $this->_db->where("id=".$id)->find();
    }

    /**
     * 根据id更新推荐位内容
     * @param $id
     * @param $data
     * @return bool
     */
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

    /**
     * 删除操作
     * @param array|mixed $id
     * @return mixed
     */
    public function delete($id){
        if (!$id || !is_numeric($id)){
            throw_exception("id不合法");
        }
        $data["id"] = $id;
        return $this->_db->where($data)->delete();
    }

    /**
     * 根据id更新listorder
     * @param $id
     * @param $listorder
     * @return bool
     */
    public function updateListOrder($id, $listorder){
        $data = array("listorder" => intval($listorder));
        return $this->_db->where("id=".$id)->save($data);
    }

    /**
     * 通过推荐位id进行查找
     * @param $posId
     * @param $limit
     * @return int
     */
    public function findByPosId($posId, $limit){
        if (!$posId || !is_numeric($posId)){
            return 0;
        }
        return $this->_db->where("position_id=".$posId)->order("listorder desc")->limit($limit)->select();
    }
}
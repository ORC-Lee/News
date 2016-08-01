<?php
namespace Common\Model;

use Think\Model;

class NewsModel extends Model
{
    private $_db = "";

    public function __construct()
    {
        $this->_db = M("news");
    }

    public function insert($data){
        if (!$data || !is_array($data)){
            return 0;
        }
        $data["create_time"] = time();
        $data["username"] = getLoginUsername();
        return $this->_db->add($data);
    }

    public function getNews($page, $pageSize = 10, $where = array()){
        $condition = $where;
        $offset = ($page - 1) * $pageSize;
        if (isset($where["title"]) && $where["title"]){
            $condition["title"] = array("like", "%" . $where["title"] . "%");
        }
        if (isset($where["catid"]) && $where["catid"]){
            $condition["catid"] = intval($where["catid"]);
        }
        return $this->_db->where($condition)->order("news_id asc")->limit($offset, $pageSize)->select();
    }

    public function getNewsCount($where = array()){
        $condition = $where;
        if (isset($where["title"]) && $where["title"]){
            $condition["title"] = array("like", "%" . $where["title"] . "%");
        }
        if (isset($where["catid"]) && $where["catid"]){
            $condition["catid"] = intval($where["catid"]);
        }
        return $this->_db->where($condition)->count();
    }

    public function  find($id){
        if (!$id || !is_numeric($id)){
            return 0;
        }
        return $this->_db->where("news_id=".$id)->find();
    }

    public function updateNewsById($id, $data){
        if (!$id || !is_numeric($id)){
            throw_exception("id不合法");
        }
        if (!$data || !is_array($data)){
            throw_exception("更新数据不合法");
        }
        return $this->_db->where("news_id=".$id)->save($data);
    }

    public function deleteNewsById($id){
        if (!$id || !is_numeric($id)){
            throw_exception("id不合法");
        }
        return $this->_db->where("news_id=".$id)->delete();
    }

//    public function deleteThumbByPath($thumb){
//        if (!file_exists($thumb)){
//            throw_exception("缩图路径不存在");
//        }
//        if (is_readable($thumb)){
//            throw_exception("只有只读权限");
//        }
//        return unlink("'". $thumb . "'");
//    }

    public function setStatusById($id, $status){
        if (!$id || !is_numeric($id)){
            throw_exception("id不合法");
        }
        if (!is_numeric($status)){
            throw_exception("状态值不合法");
        }
        $data["status"] = $status;
        return $this->_db->where("news_id=".$id)->save($data);
    }
}
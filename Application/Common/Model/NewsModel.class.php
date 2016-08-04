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
        return $this->_db->where($condition)->order("news_id desc")->limit($offset, $pageSize)->select();
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

    public function getNewsByNewsIdIn($push){
        if (!isset($push) || !is_array($push)){
            throw_exception("推送内容不合法");
        }
        $where["news_id"] = array("in", implode(",", $push));
        return $this->_db->where($where)->select();
    }

    /**
     * 取得文章排名
     * @param $limit
     * @return array
     */
    public function getRank($limit){
        return $this->_db->where("status=1")->order("count desc, news_id desc")->limit($limit)->select();
    }

    public function updateCountById($id, $count){
        if (!$id || !is_numeric($id)){
            throw_exception("id不合法");
        }
        if (!is_numeric($count)){
            throw_exception("count不是数字");
        }

        $data['count'] = $count;
        $this->_db->where("news_id=".$id)->save($data);
    }
}
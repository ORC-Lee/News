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

}
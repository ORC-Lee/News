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
     * 通过用户名取用户数据
     * @param $username
     * @return array
     */
    public function getAdminByUsername($username){
        $ret = $this->_db->where("username='".$username."'")->find();
        return $ret;
    }

}


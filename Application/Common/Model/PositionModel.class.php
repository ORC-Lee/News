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
}
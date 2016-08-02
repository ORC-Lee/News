<?php
namespace Common\Model;

use Think\Model;

class BasicModel extends Model
{
    public function __construct()
    {
    }

    /**
     * 配置站点数据
     * @param array $data
     * @return mixed
     */
    public function save($data = array())
    {
        if (!$data){
            throw_exception(0, "没有提交的数据");
        }
        return F("basic_web_config", $data);
    }

    /**
     * 读取配置信息
     * @return mixed
     */
    public function select(){
        return F("basic_web_config");
    }
}
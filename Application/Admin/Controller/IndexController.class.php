<?php
/**
 * 后台Index相关
 */
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    
    public function index(){
        $userCount = D("Admin")->getLoginUsers();
        $data = array("status"=>1);
        $newsCount = D("News")->getNewsCount($data);
        $newsMaxRead = D("News")->newsMaxRead();
        $posCount = D("Position")->getPositionCount($data);
        $this->assign("result", array(
            "userCount" => $userCount,
            "newsCount" => $newsCount,
            "posCount" => $posCount,
            "newsMaxRead" => $newsMaxRead,
        ));
    	$this->display();
    }

    public function main() {
    	$this->display();
    }
}
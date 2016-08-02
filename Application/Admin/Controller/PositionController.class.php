<?php
namespace Admin\Controller;

use Org\Util\Date;
use Think\Controller;

class PositionController extends CommonController
{
    public function index()
    {
        $page = $_REQUEST["p"] ? $_REQUEST["p"] : 1;
        $pageSize = $_REQUEST["pageSize"] ? $_REQUEST["pageSize"] : 2;

        $positions = D("Position")->getAllPositions($page, $pageSize);
        $posCount = D("Position")->getPositionCount();

        $Res = new \Think\Page($posCount, $pageSize);
        $pageRes = $Res->show();


        $this->assign("positions", $positions);
        $this->assign("pageRes", $pageRes);
        $this->assign("positions", $positions);

        $this->display();
    }

    public function setStatus(){
        $data = array(
            "id" => $_POST["id"],
            "status" => $_POST["status"]
        );
        parent::setStatus($data, "Position");
    }
}
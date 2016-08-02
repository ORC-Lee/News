<?php
namespace Admin\Controller;

use MongoDB\Driver\Server;
use Think\Controller;
use Think\Exception;

class ContentController extends CommonController
{
    public function index()
    {
        $where = array();
        if ($_GET["title"]) {
            $where["title"] = $_GET["title"];
            $this->assign("title", $_GET["title"]);
        }
        if ($_GET["catid"]) {
            $where["catid"] = $_GET["catid"];
            $this->assign("catId", $_GET["catid"]);
        }

        $page = $_REQUEST["p"] ? $_REQUEST["p"] : 1;
        $pageSize = $_REQUEST["pageSize"] ? $_REQUEST["pageSize"] : 2;
        $totalRows = D("News")->getNewsCount($where);
        $news = D("News")->getNews($page, $pageSize, $where);
        $menus = D("Menu")->getBarMenus();

        $res = new \Think\Page($totalRows, $pageSize);
        $pageRes = $res->show();

        $positions = D("Position")->getNormalPositions();

        $this->assign("pageRes", $pageRes);
        $this->assign("news", $news);
        $this->assign("menus", $menus);
        $this->assign("positions", $positions);

        $this->display();
    }

    public function add()
    {
        if ($_POST) {
            if (!isset($_POST["title"]) || !$_POST["title"]) {
                return show(0, "标题不能为空");
            }
            if (!isset($_POST["small_title"]) || !$_POST["small_title"]) {
                return show(0, "短标题不能为空");
            }
            if (!isset($_POST["catid"]) || !$_POST["catid"]) {
                return show(0, "文章栏目不能为空");
            }
            if (!isset($_POST["content"]) || !$_POST["content"]) {
                return show(0, "文章内容不能为空");
            }
            if (!isset($_POST["keywords"]) || !$_POST["keywords"]) {
                return show(0, "关键字不能为空");
            }
            if ($_POST["news_id"]) {
                $id = $_POST["news_id"];
                unset($_POST["news_id"]);
                $this->save($id, $_POST);
            }
            $insertId = D("News")->insert($_POST);
            if ($insertId) {
                $newsContentData["news_id"] = $insertId;
                $newsContentData["content"] = $_POST["content"];
                $cInsertId = D("NewsContent")->insert($newsContentData);
                if ($cInsertId) {
                    return show(1, "新增成功");
                } else {
                    return show(0, "主表插入成功，附表插入失败");
                }
            } else {
                return show(0, "新增失败");
            }

        }
        $webSiteMenu = D("Menu")->getBarMenus();
        $titleFontColor = C("TITLE_FONT_COLOR");
        $copyFrom = C("COPY_FROM");

        $this->assign("webSiteMenu", $webSiteMenu);
        $this->assign("titleFontColor", $titleFontColor);
        $this->assign("copyFrom", $copyFrom);
        $this->display();
    }

    public function edit()
    {
        $id = $_GET["id"];
        $news = D("News")->find($id);
        $newsContent = D("NewsContent")->find($id);

        $news["content"] = $newsContent["content"];
        $titleFontColor = C("TITLE_FONT_COLOR");
        $webSiteMenu = D("Menu")->getBarMenus();
        $copyFrom = C("COPY_FROM");

        $this->assign("news", $news);
        $this->assign("titleFontColor", $titleFontColor);
        $this->assign("webSiteMenu", $webSiteMenu);
        $this->assign("copyFrom", $copyFrom);

        $this->display();
    }

    public function save($id, $data)
    {
        try {
            $res = D("News")->updateNewsById($id, $data);
            if ($res) {
                $contentRes = D("NewsContent")->updateNewsContentById($id, $data);
                if (false === $contentRes) {
                    return show(0, "主表更新成功，附表更新失败");
                }
                return show(1, "更新成功");
            } else {
                return show(0, "更新失败");
            }
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }

    public function delete()
    {
        $id = $_POST["id"];
        try {
//            $news = D("News")->find($id);
//            $thumb = $news["thumb"];
//            $delThumb = D("News")->deleteThumbByPath($thumb);
//            if (false === $delThumb){
//                return show(0, "删除缩图失败");
//            }
            $delId = D("News")->deleteNewsById($id);
            if ($delId) {
                $contentDelId = D("NewsContent")->deleteNewsContentById($id);
                if (false === $contentDelId) {
                    return show(0, "主表删除成功，附表删除失败");
                }
                return show(1, "删除成功");
            } else {
                return show(0, "删除失败");
            }
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }

    public function setStatus()
    {
        $data = array(
            "id" => $_POST["id"],
            "status" => $_POST["status"]
        );
        return parent::setStatus($data, "News");
    }

    public function push()
    {
        $jumpUrl = $_SERVER["HTTP_REFERER"];
        $position_id = $_POST["position_id"];
        $push = $_POST["push"];
        try {
            $res = D("News")->getNewsByNewsIdIn($push);
            if (false === $res) {
                return show(0, "查询推送内容出错");
            }
            foreach ($res as $val) {
                $data = array(
                    "position_id" => $position_id,
                    "title" => $val["title"],
                    "thumb" => $val["thumb"],
                    "news_id" => $val["news_id"],
                    "status" => 1,
                    "create_time" => $val["create_time"]
                );
                $posInsertId = D("PositionContent")->insert($data);
                if (!$posInsertId) {
                    return show(0, "推荐失败");
                }
            }
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }

        return show(1, "推荐成功", array("jump_url" => $jumpUrl));


    }
}
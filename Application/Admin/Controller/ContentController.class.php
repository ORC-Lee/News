<?php
namespace Admin\Controller;

use Think\Controller;

class ContentController extends CommonController
{
    public function index()
    {
        $this->display();
    }

    public function add(){
        if ($_POST){
            if (!isset($_POST["title"]) || !$_POST["title"]){
                return show(0, "标题不能为空");
            }
            if (!isset($_POST["small_title"]) || !$_POST["small_title"]){
                show(0, "短标题不能为空");
            }
            if (!isset($_POST["catid"]) || !$_POST["catid"]){
                return show(0, "文章栏目不能为空");
            }
            if (!isset($_POST["content"]) || !$_POST["content"]){
                return show(0, "文章内容不能为空");
            }
            if (!isset($_POST["keywords"]) || !$_POST["keywords"]){
                return show(0, "关键字不能为空");
            }
            $indertId = D("News")->insert($_POST);
            if ($indertId){
                $newsContentData["news_id"] = $indertId;
                $newsContentData["content"] = $_POST["content"];
                $cInsertId = D("NewsContent")->insert($newsContentData);
                if ($cInsertId){
                    return show(1, "新增成功");
                }else{
                    return show(0, "主表插入成功，附表插入失败");
                }
            }else{
                return show(0, "新增失败");
            }

        }
        $webSiteMenu = D("Menu")->getBarMenus();
        $titleFontColor = C("TITLE_FONT_COLOR");
        $copyFrom = C("COPY_FROM");

        $this->assign("webSiteMenu",$webSiteMenu);
        $this->assign("titleFontColor", $titleFontColor);
        $this->assign("copyFrom", $copyFrom);
        $this->display();
    }
}
<?php
/**
 * 图片相关
 */
namespace Admin\Controller;

use Think\Controller;
use Think\Upload;

class ImageController extends CommonController
{
    private $_uploadObj;

    public function __construct()
    {
    }

    public function ajaxuploadimage()
    {
        $res = D("UploadImage")->imageUpload();
        if (false === $res){
            return show(0, "上传失败");
        }else{
            return show(1, "上传成功", $res);
        }
    }

    public function kindUpload(){
        $res = D("UploadImage")->upload();
        if ($res === false){
            return showKind(1,"上传失败");
        }
        return showKind(0, $res);
    }
}
<?php
//公用函数
/**
 * 返回JSON数据 0表示失败, 1表示成功
 * @param $status
 * @param $message
 * @param array $data
 */
function show($status, $message, $data = array()){
    $result = array(
        "status" => $status,
        "message" => $message,
        "data" => $data
    );
    exit(json_encode($result));
}

/**
 * 取得Md5加密后的密码
 * @param $password
 * @return string
 */
function getMd5Password($password){
    return md5($password.C("MD5_PRE"));
}

/**
 * 取得菜单的类型
 * @param $type
 * @return string
 */
function getMenuType($type){
    return $type ? "后台菜单" : "前端栏目";
}

/**
 * 取得菜单的状态
 * @param $status
 * @return string
 */
function getMenuStatus($status){
    //return $status ? "开启" : "关闭";
    //这种写法为了照顾推荐位的状态值
    if (1 == $status){
        return "开启";
    }else{
        return "关闭";
    }
}

/**
 * 取得菜单的url地址
 * @param $nav
 * @return string
 */
function getAdminMenuUrl($nav){
    $url = "admin.php?c=" . $nav["c"]."&a=". $nav["f"];
    if ("index" == $nav["f"]){
        $url = "admin.php?c=" . $nav["c"];
    }
    return $url;
}

/**
 * 设置菜单高亮
 * @param $navc
 * @return string
 */
function getAdminMenuActive($navc){
    $c = strtolower(CONTROLLER_NAME);
    if (strtolower($navc) == $c){
        return "class='active'";
    }
    return null;
}

/**
 * 返回符合kindEditor格式的JSON数据
 * @param $status
 * @param $data
 */
function showKind($status, $data){
    header("Content-type:application/json;charset=UTF-8");
    if (0 == $status){
        //成功
        exit(json_encode(array("error"=>0, "url"=>$data)));
    }
    exit(json_encode(array("error"=>1, "message"=>"上传失败")));
}

/**
 * 取得登录用户名
 * @return string
 */
function getLoginUsername(){
    return $_SESSION["adminUser"]["username"] ? $_SESSION["adminUser"]["username"] : null;
}

/**
 * 根据菜单Id取菜单名
 * @param $menus
 * @param $catId
 * @return null
 */
function getCatName($menus, $catId){
    foreach ($menus as $value) {
        $arr[$value["menu_id"]] = $value["name"];
    }
    return isset($arr[$catId]) ? $arr[$catId] : null;
}

/**
 * 取得文章来源
 * @param $copyFrom
 * @return string
 */
function getCopyFromById($id){
    $arr = C("COPY_FROM");
    return $arr[$id] ? $arr[$id]: null;
}

/**
 * 判断是否有缩图
 * @param $thumb
 * @return string
 */
function isThumb($thumb){
    return $thumb ? "<span style='color:red'>有</span>" : "无";
}
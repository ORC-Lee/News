/**
 * 添加按钮操作
 */
$("#button-add").click(function () {
    var url = SCOPE.add_url;
    window.location.href = url;
});

/**
 * 提交表单操作
 */
$("#singcms-button-submit").click(function () {
    var data = $("#singcms-form").serializeArray();
    postData = {};
    $(data).each(function () {
        postData[this.name] = this.value;
    });
    //发送Ajax请求
    var url = SCOPE.save_url;
    $.post(url, postData, function (result) {
        if (1 == result.status) {
            //成功
            var jumpUrl = SCOPE.jump_url;
            return dialog.success(result.message, jumpUrl);
        }else if(0 == result.status){
            //失败
            return dialog.error(result.message);
        }
    }, "JSON");
});

/**
 * 更新操作
 */
$(".singcms-table #singcms-edit").click(function () {
    var menuId = $(this).attr("attr-id");
    var url = SCOPE.edit_url + "&id=" + menuId;
    window.location.href = url;
});

/**
 * 删除操作
 */
$(".singcms-table #singcms-delete").click(function (){
    var id = $(this).attr("attr-id");
    var url = SCOPE.delete_url;
    layer.open({
        content : "确认删除？",
        btn : ["确认","取消"],
        icon : 3,
        yes : function () {
            todelete(url, id);
        }
    });
});

function todelete (url, id){
    var data = {"id": id};
    $.post(url, data, function(result){
        if (0 == result.status){
            //失败
            dialog.error(result.message);
        }else if(1 == result.status){
            //成功
            var url = SCOPE.jump_url;
            dialog.success(result.message,url);
        }
    },"JSON");
}

/**
 * 修改状态
 */
$(".singcms-table #singcms-on-off").click(function(){
    var id = $(this).attr("attr-id");
    var url = SCOPE.set_status_url;
    var status = $(this).attr("attr-status");

    data = {};
    data["id"] = id;
    data["status"] = status;

    layer.open({
        content : "确定更改状态？",
        btn : ["确认","取消"],
        icon : 3,
        yes : function () {
            toSetStauts(url, data);
        }
    });
});

function toSetStauts(url, data){
    $.post(url, data, function(result){
        if (0 == result.status){
            //失败
            dialog.error(result.message);
        }else{
            //成功
            //var url = SCOPE.jump_url;
            dialog.success(result.message, result["data"]["jump_url"]);
        }
    },"JSON");
}

/**
 * 推送操作
 */
$("#singcms-push").click(function (){
    var position_id = $("#select_push").val();
    if (0 == position_id){
        dialog.error("请选择推荐位");
    }
    var push = {};
    $("input[name='pushcheck']:checked").each(function (i){
        push[i] = $(this).val();
    });
    var postData = {};
    postData["position_id"] = position_id;
    postData["push"] = push;

    var url = SCOPE.push_url;
    $.post(url, postData, function(result){
        if (0 == result.status){
            //失败
            return dialog.error(result.message);
        }
        if (1 == result.status){
            //成功
            return dialog.success(result.message, result["data"]["jump_url"]);
        }
    },"JSON");
})

/**
 * 排序操作
 */
$("#button-listorder").click(function(){
    var data = $("#singcms-listorder").serializeArray();
    postData = {};
    $(data).each(function (i){
        postData[this.name] = this.value;
    });
    var url = SCOPE.listorder_url;
    //发送Ajax请求
    $.post(url, postData, function(result){
        if (0 == result.status){
            //失败
            return dialog.error(result.message);
        }
        if (1 == result.status){
            //成功
            return dialog.success(result.message, result["data"]["jump_url"]);
        }
    }, "JSON");
});
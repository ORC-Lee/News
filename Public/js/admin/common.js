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
            var url = "admin.php?c=menu";
            dialog.success(result.message,url);
        }
    },"JSON");
}
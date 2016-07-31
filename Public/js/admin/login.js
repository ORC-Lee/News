/**
 * 前台登录页面类
 */
var login = {
    check: function () {
        var username = $("input[name='username']").val();
        var password = $("input[name='password']").val();
        //前台校验用户名和密码
        if (!username){
            return dialog.error("用户名不能为空");
        }
        if (!password){
            return dialog.error("密码不能为空");
        }
        //发送Ajax请求
        var url = "admin.php?c=login&a=check";
        var data = {'username':username, 'password':password};
        var dataType = "JSON";
        $.post(url, data, function(result){
            if (0 == result.status){
                return dialog.error(result.message);
            }else if(1 == result.status){
                var jumpUrl = "admin.php?c=index";
                return dialog.success(result.message, jumpUrl);
            }
        }, dataType);
    }
};
/**
 * 异步加载计数器数据
 */
var postData ={};
$(".news_count").each(function(i){
    postData[i] = $(this).attr("news-id");
});
//调试
//console.log(postData);
var url = "index.php?c=Index&a=getCount";
$.post(url, postData, function(result){
    if (1 == result.status){
        //成功
        var counts = result.data;
        $.each(counts, function(news_id,count){
            $(".node-"+news_id).html(count);
        });
    }else if (0 == result.status){
        //失败
        return dialog.error(result.message);
    }
}, "JSON");
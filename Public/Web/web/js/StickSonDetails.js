layui.use(['laypage', 'layer'], function() {
    var laypage = layui.laypage,
        layer = layui.layer;

    //完整功能
    laypage.render({
        elem: 'NumberOfPages',
        count: 78,
        layout: ['count', 'prev', 'page', 'next', 'limit', 'skip'],
        jump: function(obj) {
            console.log(obj)
        }
    });

});

$(".greatIcon").on("click",function(){
    if($(this).attr('data-Click')!="true"){
        var num = Number($(this).parent().children(".like_num").text());
        num++;
        $(this).parent().children(".like_num").text(num);
        $(this).attr('data-Click','true')
    }else{
        
    }
})




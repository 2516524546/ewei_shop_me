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
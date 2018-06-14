layui.use(['laypage', 'layer'], function() {
    var laypage = layui.laypage,
        layer = layui.layer;

    //完整功能
    laypage.render({
        elem: 'NumberOfPages',
        count: 78, 
        prev: 'Previous',
        next: 'Next',
        layout: [ 'prev', 'page', 'next','count', 'skip'],
        jump: function(obj) {
            console.log(obj)
        }
    });

});

$(function() {
    $("#pic").click(function() {
        $("#upload").click(); //隐藏了input:file样式后，点击头像就可以本地上传
        $("#upload").on("change", function() {
            var objUrl = getObjectURL(this.files[0]); //获取图片的路径，该路径不是图片在本地的路径
            if (objUrl) {
                $("#pic").attr("src", objUrl); //将图片路径存入src中，显示出图片
                upimg();
            }
        });
    });
});
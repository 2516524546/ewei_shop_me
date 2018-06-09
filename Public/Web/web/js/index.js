// Carousel advertising --轮播广告
layui.use(['carousel', 'form'], function() {
    var carousel = layui.carousel,
        form = layui.form;

    //Change the time interval, the type of animation, the height  --改变下时间间隔、动画类型、高度
    carousel.render({
        elem: '#test2',
        interval: 1800,
        anim: 'fade',
        width: '100%',
        height: '500px'
    });
});
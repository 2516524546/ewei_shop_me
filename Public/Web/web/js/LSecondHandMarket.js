

$(function(){
    (function(){
        var num;
        $('.Produce_attribute').on('click','.attribute_content',function(event){
            num = $(this).index();
        })
        $('.Produce_attribute .attribute_content .content_details li').on('click',function(event){
            // console.log($(this).addClass("active").siblings().removeClass('active'))
            $(this).addClass("active").siblings().removeClass('active')
            // $(this).eq(num).addClass("active").siblings().removeClass('active');
        });
        $(".layui-form-item-one .layui-input-block-one .radio_box input[type='radio']").click(function(){
            $(this).parent().addClass("to").siblings().removeClass('to');
        })
    })();
});
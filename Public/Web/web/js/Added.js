/*$('.layui-btn').on("click",function(){
    var $this = $(this);
    if(!$this.attr('clicked') || $this.attr('clicked') === "no") { // 未点击
        $this.html("Added")
        $this.attr('clicked', "yes"); // 重置属性
    } else if($this.attr('clicked') === "yes"){ // 被点击过
        $('.PasswordContainer_shadow').css('display','block')
    }
})*/

$('.PasswordContainer_shadow .PasswordContainer_shadow_box .shadow_box_title .shadow_box_close').on("click",function(){
    $('.PasswordContainer_shadow').css('display','none')
})
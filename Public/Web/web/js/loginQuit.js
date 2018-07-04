// $(".login_success .success_setting").on("click",function(){
//     $(".login_success .success_setting .setting_usage").toggleClass('block')
// })

$(function(){
    $(".login_success .success_setting").on("click", function(e) {	
            e.stopPropagation(); 
            $(".login_success .success_setting .setting_usage").toggleClass('block')			
    })
    // $(document).click(function() {$('.login_success .success_setting .setting_usage').removeClass("block");});
    // $('.login_success .success_setting .setting_usage').removeClass("block");
    
    $(document).on("click",function(e){
        $('.login_success .success_setting .setting_usage').removeClass("block");
    })
})
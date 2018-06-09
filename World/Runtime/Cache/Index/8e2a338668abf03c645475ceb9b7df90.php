<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Registration information</title>
    <meta name="viewport" content="width=device-width, initial-scale=0 user-scalable=no, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="/Public/Web/js/lib/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Public/Web/js/lib/bootstrap/dist/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="/Public/Web/js/lib/bootstrap/dist/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="/Public/Web/js/lib/layui/dist/css/layui.css">
    <link rel="stylesheet" href="/Public/Web/web/css/register.css">
    <link rel="stylesheet" href="/Public/Web/web/css/registerSecond.css">
    <link rel="stylesheet" href="/Public/Web/web/css/registerThird.css">
</head>

<body>
    <!-- logo -->
    <header class="container"></header>
    <hr>
    <!-- Crumbs nav -->
    <div class="container Crumbs">
        <span>
          <a href="<?php echo U('Index/Index/index');?>"></a>
          <cite></cite>
          <span>Sign up</span>
        </span>
    </div>
    <!-- Forget the password form -->
    <form class="layui-form layui-form-pane" action="<?php echo U('Index/Index/index');?>">
                <div class="container">
                <h4 class="text-center"><big class="dot_num">3</big>Select the group you are interested in</h4>
                <div class="Group_list">
                    <?php if(is_array($grouptaglist)): foreach($grouptaglist as $k=>$g): ?><div class="Group_item">
                        <input type="hidden" value="<?php echo ($g['u_user_grouptag_id']); ?>" />
                        <div class="item_circle">
                            <div class="item_pic">
                                <img src="./Uploads/<?php echo ($g['u_user_grouptag_img']); ?>" alt="">
                            </div>

                        </div>
                        <p><?php echo ($g['u_user_grouptag_name']); ?></p>
                    </div><?php endforeach; endif; ?>
                    
                </div>
                <div class="btn_box">
                    <div class="btn_box_item">
                        <a href="<?php echo U('Index/SignUp/registerSecond');?>">Previous</a>
                    </div>
                    <div class="btn_box_item">
                        <button style=" cursor: pointer;" lay-submit="demo1" lay-filter="demo1">
                            Complete 
                        </button>
                    </div>
                </div>
    </form>

    <!-- footer -->
    <footer>
        	<p>&copy; 2018 NewWorld. All rights reserved.</p>
    </footer>
    <script src="/Public/Web/js/lib/jquery/dist/jquery.min.js"></script>
    <script src="/Public/Web/js/lib/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/Public/Web/js/lib/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/Public/Web/js/lib/layui/dist/layui.all.js"></script>
    <script>

        var strarr = []
        $(".Group_list .Group_item").on("click",function(){
            $(this).toggleClass("active");
            if ($(this).is('.active')){
                strarr.push($(this).children('input').val());
            }else {
                strarr.splice(jQuery.inArray($(this).children('input').val(),strarr),1);
            }

        })

        layui.use('form', function(){
            var form = layui.form;

            form.on('submit(demo1)', function(data){
                var groupstr = ''
                for(var i = 0;i<strarr.length;i++){

                    if (groupstr == ''){
                        groupstr += strarr[i];
                    }else {
                        groupstr += ','+strarr[i];
                    }

                }

                $.ajax({
                    type:"post",
                    url:"<?php echo U('Index/Ajax/ajax_register');?>",
                    data:{
                        groupstr:groupstr,

                    },
                    dataType:"json",
                    async:false,
                    success: function(data){
                        if (data!=null&&data!="") {
                            if (data.str == 1) {
                                layer.msg(data.msg,{
                                        time:1500,
                                        icon:2,
                                    },function () {
                                    window.location.href="<?php echo U('Index/Login/login');?>";
                                    }
                                );


                            }else{
                                layer.msg(data.msg,{
                                        time:1500,
                                        icon:2,
                                    }
                                );
                            }

                        }else{
                            layer.msg('请求错误!',{
                                    time:1500,
                                    icon:2,
                                }
                            );
                        }

                    },
                    error:function(XMLHttpRequest, textStatus, errorThrown){

                        layer.msg('请求失败!',{
                                time:1500,
                                icon:2,
                            }
                        );
                    }

                })
                return false; //阻止表单跳转。如果需要表单跳转，去掉这段即可。
            });
        });




  </script>
</body>

</html>
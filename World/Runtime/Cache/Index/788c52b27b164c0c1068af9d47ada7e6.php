<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Registration information</title>
    <meta name="viewport" content="width=device-width, initial-scale=0 user-scalable=no, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="/Public/Web/web/css/register.css">
    <link rel="stylesheet" href="/Public/Web/js/lib/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Public/Web/js/lib/bootstrap/dist/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="/Public/Web/js/lib/bootstrap/dist/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="/Public/Web/js/lib/layui/dist/css/layui.css">
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
    <form class="layui-form layui-form-pane" action="" >
        <div class="PasswordContainer">
            <div class="StepContainer">
                <div class="StepContainerOne">
                    <h4 class="text-center">Mobile authentication registration</h4>
                    <div class="FormContainer" pane>
                        <label class="layui-form-label label-spacing">
                            <span class="mailbox-icon1"></span>
                        </label>
                        <div class="layui-input-block input-spacing">
                            <input type="email" name="email" lay-verify="required" autocomplete="off" <?php if($register_mail): ?>value="<?php echo ($register_mail); ?>"<?php endif; ?> placeholder="Enter the mailbox" class="layui-input input-float" id="mail">
                            <input class="layui-btn layui-btn-normal sendCode" type="button" name="CodeButton" value="Verification Code" onclick="sendemail()">
                        </div>
                    </div>
                    <div class="FormContainer" pane>
                        <label class="layui-form-label label-spacing">
                            <span class="mailbox-icon2"></span>
                        </label>
                        <div class="layui-input-block input-spacing">
                            <input type="text" name="number" lay-verify="required" autocomplete="off" placeholder="Input verification code" class="layui-input" id="code">
                        </div>
                    </div>
                    <div class="FormContainer" pane>
                        <label class="layui-form-label label-spacing">
                            <span class="mailbox-icon3"></span>
                        </label>
                        <div class="layui-input-block input-spacing">
                            <input type="password" name="password" lay-verify="required" autocomplete="off" <?php if($register_password): ?>value="<?php echo ($register_password); ?>"<?php endif; ?> placeholder="Input verification code" class="layui-input" id="passwordone">
                        </div>
                    </div>
                    <div class="FormContainer" pane>
                        <label class="layui-form-label label-spacing">
                            <span class="mailbox-icon4"></span>
                        </label>
                        <div class="layui-input-block input-spacing">
                            <input type="password" name="password" lay-verify="required" autocomplete="off" <?php if($register_password): ?>value="<?php echo ($register_password); ?>"<?php endif; ?> placeholder="Input verification code" class="layui-input" id="passwordtwo">
                        </div>
                    </div>
                    <div class="FormContainer from-but">
                        <button class="layui-btn layui-btn-normal layui-btn-radius Submit-but" lay-submit="demo1" lay-filter="demo1">
                            Next
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script src="/Public/Web/js/lib/jquery/dist/jquery.min.js"></script>
    <script src="/Public/Web/js/lib/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/Public/Web/js/lib/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/Public/Web/js/lib/layui/dist/layui.all.js"></script>
</body>
<script type="text/javascript">


layui.use('form', function(){
  var form = layui.form;
  
  form.on('submit(demo1)', function(data){
      $.ajax({
            type:"post",
            url:"<?php echo U('Index/Ajax/ajax_registerfirst');?>",
            data:{
                mail:$("#mail").val(),
                code:$("#code").val(),
                passwordone:$("#passwordone").val(),
                passwordtwo:$("#passwordtwo").val(),
            },
            dataType:"json",
            async:false,
            success: function(data){
                if (data!=null&&data!="") {
                    if (data.str == 1) {

                        window.location.href="<?php echo U('Index/SignUp/registerSecond');?>";
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



function sendemail() {
    $.ajax({
        type:"post",
        url:"<?php echo U('Index/Ajax/ajax_sendemailcode');?>",
        data:{
            mail:$("#mail").val(),
        },
        dataType:"json",
        async:false,
        success: function(data){
            if (data!=null&&data!="") {
                if (data.str == 1) {
                    cd()
                    layer.msg(data.msg,{
                            time:1500,
                            icon:1,
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

}

</script>

<script>
    var InterValObj; //timer变量，控制时间
    var count = 60; //间隔函数，1秒执行
    var curCount;//当前剩余秒数
    function cd(){
        curCount = count;
        //设置button效果，开始计时
        $(".sendCode").attr("disabled", "true");
        // $(".sendCode").val("请在" + curCount + "秒内输入验证码");
        InterValObj = window.setInterval(SetRemainTime, 100); //启动计时器，1秒执行一次
    }
    function SetRemainTime() {
        if (curCount == 0) {
            window.clearInterval(InterValObj);//停止计时器
            $(".sendCode").removeAttr("disabled");//启用按钮
            $(".sendCode").val("Resend the verification code");
        }
        else {
            curCount--;
            $(".sendCode").val(" " + curCount + " seconds");
        }
    }
</script>


</html>
<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sign in</title>
    <meta name="viewport" content="width=device-width, initial-scale=0 user-scalable=no, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="/Public/Web/web/css/login.css">
    <link rel="stylesheet" href="/Public/Web/js/lib/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Public/Web/js/lib/bootstrap/dist/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="/Public/Web/js/lib/bootstrap/dist/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="/Public/Web/js/lib/layui/dist/css/layui.css">
</head>

<body class="body">
    <!-- Return to the last page start -->
    <header class="container">
        <a href="#" onClick="javascript :history.back(-1);">
            <i class="layui-icon Return-icon">&#xe603;</i>
        </a>
    </header>
    
    <!-- Return to the last page end -->
    <!-- Login and registration start -->
    <div class="LoginContainer">
        <form class="layui-form layui-form-pane" action="" >
            <!-- Mailbox input box -->
            <div class="FormContainer" pane>
                <label class="layui-form-label">
                    <span class="mailbox-icon1"></span>
                </label>
                <div class="layui-input-block input-spacing">
                    <input type="email" name="title" lay-verify="required" autocomplete="off" placeholder="Please enter the mailbox" class="layui-input" id="username">
                </div>
            </div>
            <!-- Cipher input box -->
            <div class="FormContainer" pane>
                <label class="layui-form-label">
                    <span class="mailbox-icon2"></span>
                </label>
                <div class="layui-input-block input-spacing">
                    <input type="password" name="title" lay-verify="required" autocomplete="off" placeholder="Please input a password" class="layui-input" id="password">
                </div>
            </div>
            <!-- Login button -->
            <div class="layui-form-item from-but">
                <button class="layui-btn layui-btn-lg layui-btn-normal layui-btn-radius" lay-submit="demo1" lay-filter="demo1">Sign in</button>
            </div>
        </form>
        <!-- Registered password -->
        <div class="LinkContainer">
            <p class="text-center">
                <a href="<?php echo U('Index/SignUp/forgetThePassword');?>">Forget password?</a>
                <span>/</span>
                <a href="<?php echo U('Index/SignUp/register');?>">Register an account?</a>
            </p>
            <p class="text-center">Other login method:
                <a href="#"><img src="/Public/Web/web/img/facebook.png"></a>
            </p>
        </div>
    </div>
    <!-- Login and registration end -->
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
                url:"<?php echo U('Index/Ajax/ajax_login');?>",
                data:{
                    username:$("#username").val(),
                    password:$("#password").val(),
                },
                dataType:"json",
                async:false,
                success: function(data){
                    if (data!=null&&data!="") {
                        if (data.str == 1) {
                            layer.msg(data.msg,{
                                    time:1500,
                                    icon:1,
                                },function(){
                                    if("<?php echo $url;?>"){
                                        window.location.href="<?php echo $url;?>";
                                    }else{
                                        window.location.href="<?php echo U('Index/Index/index');?>";
                                    }

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

</html>
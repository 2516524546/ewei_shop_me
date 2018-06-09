<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>ForgetThePassword</title>
    <meta name="viewport" content="width=device-width, initial-scale=0 user-scalable=no, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="/Public/Web/web/css/Password.css">
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
          <span>Forget password</span>
        </span>
    </div>
    <!-- Forget the password form -->
    <div class="PasswordContainer">
        <form class="layui-form layui-form-pane" action="">
            <!-- Mailbox verification -->
            <div class="FormContainer" pane>
                <label class="layui-form-label label-spacing">
                    <span class="mailbox-icon1"></span>
                </label>
                <div class="layui-input-block input-spacing">
                    <input type="email" name="email" id="mail" lay-verify="required" autocomplete="off" placeholder="Enter the mailbox" class="layui-input input-float" >

                    <input class="layui-btn layui-btn-normal" type="button" name="CodeButton" value="Verification Code" onclick="sendemail()">
                </div>
            </div>
            <!-- Input verification code -->
            <div class="FormContainer" pane>
                <label class="layui-form-label label-spacing">
                    <span class="mailbox-icon2"></span>
                </label>
                <div class="layui-input-block input-spacing">
                    <input type="text" name="number" id="code" lay-verify="required" autocomplete="off" placeholder="Input verification code" class="layui-input">
                </div>
            </div>
            <!-- Input password -->
            <div class="FormContainer" pane>
                <label class="layui-form-label label-spacing">
                    <span class="mailbox-icon3"></span>
                </label>
                <div class="layui-input-block input-spacing">
                    <input type="password" name="password" id="passwordone" lay-verify="required" autocomplete="off" placeholder="Input verification code" class="layui-input">
                </div>
            </div>
            <!-- Enter the password again -->
            <div class="FormContainer" pane>
                <label class="layui-form-label label-spacing">
                    <span class="mailbox-icon4"></span>
                </label>
                <div class="layui-input-block input-spacing">
                    <input type="password" name="password" id="passwordtwo" lay-verify="required" autocomplete="off" placeholder="Input verification code" class="layui-input">
                </div>
            </div>
            <!-- Submit button -->
            <div class="FormContainer from-but">
                <button class="layui-btn layui-btn-normal layui-btn-radius Submit-but" lay-submit="demo1" lay-filter="demo1">
                    Submit
                </button>
            </div>
        </form>
    </div>
    <!-- copyright -->
    <footer class="text-center">© 2018 NewWorld. All rights reserved.</footer>
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
                url:"<?php echo U('Index/Ajax/ajax_forgetpassword');?>",
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
                            layer.msg(data.msg,{
                                    time:1500,
                                    icon:1,
                                },function(){
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

</html>
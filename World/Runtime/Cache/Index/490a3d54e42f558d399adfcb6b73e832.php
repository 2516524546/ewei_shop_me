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
    <form class="layui-form layui-form-pane" action="registerThird.html" >
            <div class="PasswordContainer">
                <div class="StepContainer">
                    <div class="StepContainerOne">
                        <h4 class="text-center"><big class="dot_num">2</big>Mobile authentication registration</h4>
                        <div class="FormContainer" pane>
                            <label class="layui-form-label label-spacing">
                                <span class="mailbox-icon1"></span>
                            </label>
                            <div class="layui-input-block input-spacing">
                                <input type="text" name="nickname" id="name" lay-verify="required" autocomplete="off" <?php if($register_name): ?>value="<?php echo ($register_name); ?>"<?php endif; ?> placeholder="Enter a nickname" class="layui-input" >
                            </div>
                        </div>
                        <div class="FormContainer" pane>
                            <label class="layui-form-label label-spacing">
                                <span class="mailbox-icon2"></span>
                            </label>
                            <div class="layui-input-block input-spacing">
                                <input type="text" name="number" id="birth" lay-verify="required" autocomplete="off" <?php if($register_birth): ?>value="<?php echo ($register_birth); ?>"<?php endif; ?> placeholder="Date of birth(xx/xx/xxxx)" class="layui-input">
                            </div>
                        </div>
                        <div class="FormContainer" pane>
                            <label class="layui-form-label label-spacing">
                                <span class="mailbox-icon3"></span>
                            </label>
                            <div class="layui-input-block input-spacing">
                                    <div class="layui-input-block">
                                        <input type="radio" name="sex" value="1" title="male" <?php if(!$register_sex || $register_sex == 1): ?>checked<?php endif; ?> >
                                        <input type="radio" name="sex" value="2" title="female" <?php if($register_sex == 2): ?>checked<?php endif; ?>>
                                    </div>
                            </div>
                        </div>
                        <div class="FormContainer" pane>
                            <label class="layui-form-label label-spacing">
                                <span class="mailbox-icon4"></span>
                            </label>
                            <div class="layui-input-block input-spacing">
                                <div class="layui-input-block">
                                <select name="tag" id="tag" lay-verify="required">
                                    <option value="<?php if($register_tag): echo ($register_tag); endif; ?>"><?php if($register_tag): echo ($register_tag); else: ?>User label<?php endif; ?></option>
                                    <?php if(is_array($taglist)): foreach($taglist as $k=>$t): ?><option value="<?php echo ($t['user_tag_name']); ?>"><?php echo ($t['user_tag_name']); ?></option><?php endforeach; endif; ?>
                                </select>
                                </div>
                            </div>
                        </div>

                        <div class="FormContainer" pane>
                            <label class="layui-form-label label-spacing">
                                <span class="mailbox-icon5"></span>
                            </label>
                            <div class="layui-input-block input-spacing">
                                <div class="layui-input-block">
                                <select name="country" id="country" lay-verify="required">
                                    <option value="<?php if($register_country): echo ($register_country); endif; ?>"><?php if($register_country): echo ($register_country); else: ?>Choose a country<?php endif; ?></option>
                                    <?php if(is_array($countrylist)): foreach($countrylist as $k=>$c): ?><option value="<?php echo ($c['user_country_name']); ?>"><?php echo ($c['user_country_name']); ?></option><?php endforeach; endif; ?>
                                </select>
                                </div>
                            </div>
                        </div>

                        <div class="FormContainer" pane>
                            <label class="layui-form-label label-spacing">
                                <span class="mailbox-icon6"></span>
                            </label>
                            <div class="layui-input-block input-spacing">
                                <input type="text" name="number" id="city" lay-verify="required" autocomplete="off" <?php if($register_city): ?>value="<?php echo ($register_city); ?>"<?php endif; ?> placeholder="Enter the city" class="layui-input">
                            </div>
                        </div>

                        <div class="FormContainer" pane>
                            <label class="layui-form-label label-spacing">
                                <span class="mailbox-icon7"></span>
                            </label>
                            <div class="layui-input-block input-spacing">
                                    <!-- <input type="text" name="number" lay-verify="required" autocomplete="off" placeholder="Enter the signature" class="layui-input"> -->
                                    <textarea name="" required lay-verify="required" id="signature" placeholder="Enter the signature" class="layui-textarea"><?php if($register_signature): echo ($register_signature); endif; ?></textarea>
                            </div>
                        </div>

                        <div class="btn_box">
                                <div class="btn_box_item">
                                    <a href="<?php echo U('Index/SignUp/register');?>">Previous</a>
                                </div>
                                <div class="btn_box_item">
                                    <button style=" cursor: pointer;" lay-submit="demo1" lay-filter="demo1">
                                        Complete
                                    </button>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </form>
    

        <!-- footer -->
        <footer>
            <p>&copy; 2018 NewWorld. All rights reserved.</p>
        </footer>

    </body>
    <script src="/Public/Web/js/lib/jquery/dist/jquery.min.js"></script>
    <script src="/Public/Web/js/lib/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/Public/Web/js/lib/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/Public/Web/js/lib/layui/dist/layui.all.js"></script>

<script>

    layui.use('form', function(){
        var form = layui.form;

        form.on('submit(demo1)', function(data){

            console.log($("#name").val())
            console.log($("#birth").val())
            console.log($("input[name='sex']:checked").val())
            console.log($("#tag").val())
            console.log($("#country").val())
            console.log($("#city").val())
            console.log($("#signature").val())

            $.ajax({
                type:"post",
                url:"<?php echo U('Index/Ajax/ajax_registersecond');?>",
                data:{
                    name:$("#name").val(),
                    birth:$("#birth").val(),
                    sex:$("input[name='sex']:checked").val(),
                    tag:$("#tag").val(),
                    country:$("#country").val(),
                    city:$("#city").val(),
                    signature:$("#signature").val(),
                },
                dataType:"json",
                async:false,
                success: function(data){
                    if (data!=null&&data!="") {
                        if (data.str == 1) {

                            window.location.href="<?php echo U('Index/SignUp/registerThird');?>";

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
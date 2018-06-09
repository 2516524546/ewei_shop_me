<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>feedback</title>
        <meta name="viewport" content="width=device-width, initial-scale=0 user-scalable=no, maximum-scale=1.0, minimum-scale=1.0">
        <link rel="stylesheet" href="/Public/Web/web/css/register.css">
        <link rel="stylesheet" href="/Public/Web/web/css/Donation.css">
        <link rel="stylesheet" href="/Public/Web/web/css/Crumbsnav.css">
        <link rel="stylesheet" href="/Public/Web/web/css/CreateAcademic.css">
        <link rel="stylesheet" href="/Public/Web/js/lib/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="/Public/Web/js/lib/bootstrap/dist/css/bootstrap-grid.min.css">
        <link rel="stylesheet" href="/Public/Web/js/lib/bootstrap/dist/css/bootstrap-reboot.min.css">
        <link rel="stylesheet" href="/Public/Web/js/lib/layui/dist/css/layui.css">
        <link rel="stylesheet" href="/Public/Web/web/css/Crumbsnav.css">
        <link rel="stylesheet" href="/Public/Web/web/css/success_index.css">
        <link rel="stylesheet" href="/Public/Web/web/css/feedback.css">
    </head>

    <body>
        <!-- logo -->
        <header class="container">
            <div class="login_success">

                <div class="success_index">
                    <a href="<?php echo U('Index/Index/index');?>">
                        <img src="/Public/Web/web/img/common_dh_icon_home.png" alt="">
                    </a>
                </div>
                <div class="success_setting">
                    <img src="/Public/Web/web/img/setting.png" alt="">
                    <?php if($havemessage): ?><div class="dot"></div><?php endif; ?>
                    <div class="setting_usage">
                        <ul>
                            <li>
                                <a href="<?php echo U('Index/User/acountSetting');?>">
                                    <div class="usage_img">
                                        <img src="/Public/Web/web/img/person.png">
                                    </div>
                                    Account Settings
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo U('Index/User/resumeDetails');?>">
                                    <div class="usage_img">
                                        <img src="/Public/Web/web/img/resume.png">
                                    </div>
                                    My Resume
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo U('Index/User/myPosts');?>">
                                    <div class="usage_img">
                                        <img src="/Public/Web/web/img/release.png">
                                    </div>
                                    My Release
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo U('Index/User/myMessage');?>">
                                    <div class="usage_img">
                                        <img src="/Public/Web/web/img/message.png">
                                    </div>
                                    Message
                                    <?php if($havemessage): ?><div class="dot1"></div><?php endif; ?>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo U('Index/User/myFollowing');?>">
                                    <div class="usage_img">
                                        <img src="/Public/Web/web/img/focus.png">
                                    </div>
                                    My Focus
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo U('Index/User/addressBook');?>">
                                    <div class="usage_img">
                                        <img src="/Public/Web/web/img/contacts.png">
                                    </div>
                                    Contacts
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo U('Index/User/myGroup');?>">
                                    <div class="usage_img">
                                        <img src="/Public/Web/web/img/group.png">
                                    </div>
                                    My Group
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo U('Index/User/feedback');?>">
                                    <div class="usage_img">
                                        <img src="/Public/Web/web/img/feedback.png">
                                    </div>
                                    Feedback
                                </a>
                            </li>
                            <li class="quit">
                                <a href="#" onclick="loginout()">
                                    <div class="usage_img">
                                        <img src="/Public/Web/web/img/sign_out.png">
                                    </div>
                                    Sign Out
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="success_user">
                    <a href="<?php echo U('Index/User/personalCenter');?>&id=<?php echo ($userid); ?>">
                        <img src="<?php if($usercontent["user_icon"]): ?>./Uploads/<?php echo ($usercontent['user_icon']); else: ?>/Public/Web/web/img/01_shouye/UserPic.png<?php endif; ?>" alt="">
                    </a>
                </div>
                <div class="success_name">
                    <a href="<?php echo U('Index/User/personalCenter');?>&id=<?php echo ($userid); ?>"><?php echo ($usercontent['user_name']); ?></a>
                </div>
                <div class="success_line"></div>
                <div class="success_money">
                    <a href="<?php echo U('Index/User/virtualCurrencyRecharge');?>">
                        <div class="money_img">
                            <img src="/Public/Web/web/img/money.png" alt="">
                        </div>
                        <div class="money_num">
                            <?php echo ($usercontent['user_havecoin']); ?>
                        </div>
                    </a>
                </div>
            </div>
            </header>
            <hr>

         <!-- Crumbs nav -->
    <div class="container crumbs">
            <a href="<?php echo U('Index/Index/index');?>" class="crumbsa"><img src="/Public/Web/web/img/common_dh_icon_home.png" alt=""></a>
            <cite class="Icon"></cite>
            <span class="crumbsTitle">Feedback</span>
        </div>


        <!-- feedback content -->
        <div class="container">
            <div class="feedback_box">
                <div class="feedback_title">
                    <p>Please provide some of your valuable suggestions to help us improve our website or solve 
                            your problems in the use of our website.</p>
                </div>
                <form action="#"  autocomplete="off">
                        <textarea name="" id="content" required lay-verify="required" placeholder="Enter the content" class="layui-textarea"></textarea>
                        <button class="feedback_btn" style="cursor: pointer;" lay-submit="demo1" lay-filter="demo1">submit</button>
                </form>
            </div>

        </div>

        <!-- foot start 底部信息 -->
    <footer class="container-fluid FooterBg">
            <div class="row FooterContainer">
                <div class="col-xs-6 col-md-4">
                    <dl>
                        <dt>ABOUT</dt>
                        <dd>
                            NewWorld.net is a comprehensive website that provides an efficient source of resources and convenience for our every -day lives. We can easily discover, share and create a new world.
                        </dd>
                    </dl>
                </div>
                <div class="col-xs-6 col-md-4">
                    <dl>
                        <dt>SUPPORT</dt>
                        <dd>Premium Support</dd>
                        <dd>Get Started</dd>
                        <dd>Partners</dd>
                    </dl>
                </div>
                <div class="col-xs-6 col-md-4">
                    <dl>
                        <dt>Help Center</dt>
                        <dd><a href="HelpCenter.html">Help Center</a></dd>
                        <dd><a href="ContactUs.html">Contact Us</a></dd>
                    </dl>
                </div>
            </div>
            <div class="row copyright">
                <div class="col-md-12">
                    <p class="text-center">&copy; 2018 NewWorld. All rights reserved.</p>
                </div>
            </div>
        </footer>
        <!-- foot end 底部信息 -->


    </body>
    <script src="/Public/Web/js/lib/jquery/dist/jquery.min.js"></script>
    <script src="/Public/Web/js/lib/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/Public/Web/js/lib/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/Public/Web/js/lib/layui/dist/layui.all.js"></script>
    <script src="/Public/Web/web/js/loginQuit.js"></script>


    <script>

        layui.use('form', function(){
            var form = layui.form;

            form.on('submit(demo1)', function(data){

                $.ajax({
                    type:"post",
                    url:"<?php echo U('Index/Ajax/ajax_feedback');?>",
                    data:{
                        content:$("#content").val(),

                    },
                    dataType:"json",
                    async:false,
                    success: function(data){
                        if (data!=null&&data!="") {
                            if (data.str == 1) {

                                layer.msg(data.msg,{
                                        time:1500,
                                        icon:1,
                                    },function () {
                                        location.reload();
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

        function loginout() {

            $.ajax({
                type:"post",
                url:"<?php echo U('Index/Ajax/ajax_loginout');?>",
                data:{

                },
                dataType:"json",
                async:false,
                success: function(data){
                    if (data!=null&&data!="") {
                        if (data.str == 1) {
                            layer.msg(data.msg,{
                                    time:1500,
                                    icon:1,
                                },function () {
                                    location.reload();
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
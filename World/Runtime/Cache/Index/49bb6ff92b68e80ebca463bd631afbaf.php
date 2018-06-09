<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
        <head>
            <meta charset="utf-8">
            <title>Follow List</title>
            <meta name="viewport" content="width=device-width, initial-scale=0 user-scalable=no, maximum-scale=1.0, minimum-scale=1.0">
            <link rel="stylesheet" href="/Public/Web/web/css/register.css">
            <link rel="stylesheet" href="/Public/Web/web/css/Donation.css">
            <link rel="stylesheet" href="/Public/Web/js/lib/bootstrap/dist/css/bootstrap.min.css">
            <link rel="stylesheet" href="/Public/Web/js/lib/bootstrap/dist/css/bootstrap-grid.min.css">
            <link rel="stylesheet" href="/Public/Web/js/lib/bootstrap/dist/css/bootstrap-reboot.min.css">
            <link rel="stylesheet" href="/Public/Web/js/lib/layui/dist/css/layui.css">
            <link rel="stylesheet" href="/Public/Web/web/css/ResumeDetails.css">
            <link rel="stylesheet" href="/Public/Web/web/css/Crumbsnav.css">
            <link rel="stylesheet" href="/Public/Web/web/css/success_index.css">
            <link rel="stylesheet" href="/Public/Web/web/css/AcountSetting.css">
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
            <span class="crumbsTitle">Personal Information</span>
        </div>

        <!-- AcountSetting content -->
            <div class="container">
                    <div class="Resumetails_content">
                            <div class="Resume_details">
                                <form action="" class="layui-form layui-form-pane">
                                    <div class="form_box">
                                        <div class="form_title">
                                            <h3>Basic Information</h3>
                                        </div>
                                        <div class="form_details">
                
                                            <div class="form_details_item">
                                                <div class="form_details_left form_details_item_border">
                                                    <div class="form_details_item_img">
                                                        <img src="/Public/Web/web/img/02_interest/interest_create_icon_04.png" alt="">
                                                    </div>
                                                </div>
                                                <div class="layui-input-block">
                                                    <div class="img" >
                                                        <img src="<?php if($usercontent["user_icon"]): ?>./Uploads/<?php echo ($usercontent['user_icon']); else: ?>/Public/Web/web/img/01_shouye/UserPic.png<?php endif; ?>" id="pic">
                                                    </div>
                                                    <input id="upload" class="but" name="file" accept="image/*" type="file">
                                                </div>
                                            </div>
                
                                            <div class="form_details_item">
                                                    <div class="form_details_left form_details_item_border">
                                                            <div class="form_details_item_img">
                                                                <img src="/Public/Web/web/img/02_interest/interest_create_icon_05.png" alt="">
                                                            </div>
                                                        </div>
                                                    <div class="layui-input-block">
                                                        <input type="text" name="title" id="name" required  lay-verify="required" placeholder="Enter a nickname" autocomplete="off" <?php if($usercontent["user_name"]): ?>value="<?php echo ($usercontent['user_name']); ?>"<?php endif; ?> class="layui-input">
                                                    </div>
                                            </div>
                
                                             <div class="form_details_item">
                                                <div class="form_details_left form_details_item_border">
                                                    <div class="form_details_item_img">
                                                        <img src="/Public/Web/web/img/01_shouye/home_register_icon_06.png" alt="">
                                                    </div>
                                                </div>
                                                <div class="layui-input-block">
                                                    <input type="radio" name="Sex" value="1" title="male" <?php if(!$usercontent['user_sex']||$usercontent['user_sex']==1): ?>checked<?php endif; ?>>
                                                    <input type="radio" name="Sex" value="2" title="female" <?php if($usercontent['user_sex']==2): ?>checked<?php endif; ?>>
                                                </div>
                                            </div>

                                            
                                            <div class="form_details_item">
                                                    <div class="form_details_left form_details_item_border">
                                                            <div class="form_details_item_img">
                                                                <img src="/Public/Web/web/img/01_shouye/home_register_icon_05.png" alt="">
                                                            </div>
                                                        </div>
                                                    <div class="layui-input-block">
                                                        <input type="text" name="title" id="birth" required  lay-verify="required" placeholder="Enter the date of birth  xx/xx/xxxx" autocomplete="off" <?php if($usercontent["user_birth"]): ?>value="<?php echo ($usercontent['user_birth']); ?>"<?php endif; ?> class="layui-input">
                                                    </div>
                                            </div>
                

                                            <div class="form_details_item">
                                                Virtual currency : 
                                                <span><?php echo ($usercontent['user_havecoin']); ?></span>
                                            </div>

                                            <div class="form_details_item">
                                                    Post : 
                                                    <span><?php echo ($usercontent['user_notes']); ?></span>
                                            </div>

                                            <div class="form_details_item">
                                                <div class="form_details_left form_details_item_border">
                                                        <div class="form_details_item_img">
                                                            <img src="/Public/Web/web/img/02_interest/interest_create_icon_05.png" alt="">
                                                        </div>
                                                    </div>
                                                <div class="layui-input-block">
                                                        <span><?php echo ($usercontent['user_mail']); ?></span>
                                                </div>
                                            </div>
                
                                            <div class="form_details_item">
                                                    <div class="form_details_left form_details_item_border">
                                                            <div class="form_details_item_img">
                                                                <img src="/Public/Web/web/img/01_shouye/home_register_icon_09.png" alt="">
                                                            </div>
                                                        </div>
                                                    <div class="layui-input-block">
                                                            <select name="country" id="country" lay-verify="required">
                                                                <?php if($usercontent["user_country"]): ?><option value="<?php echo ($usercontent['user_country']); ?>"><?php echo ($usercontent['user_country']); ?></option><?php else: ?><option value="">Choose a country</option><?php endif; ?>
                                                                <?php if(is_array($countrylist)): foreach($countrylist as $k=>$c): ?><option value="<?php echo ($c['user_country_name']); ?>"><?php echo ($c['user_country_name']); ?></option><?php endforeach; endif; ?>
                                                                  </select>
                                                    </div>
                                            </div>
                
                                            <div class="form_details_item">
                                                    <div class="form_details_left form_details_item_border">
                                                            <div class="form_details_item_img">
                                                                <img src="/Public/Web/web/img/01_shouye/home_register_icon_10.png" alt="">
                                                            </div>
                                                        </div>
                                                    <div class="layui-input-block">
                                                        <input type="text" name="title" id="city" required  lay-verify="required" placeholder="Enter the city" autocomplete="off" <?php if($usercontent["user_city"]): ?>value="<?php echo ($usercontent['user_city']); ?>"<?php endif; ?> class="layui-input">
                                                    </div>
                                            </div>
                
                                            <div class="form_details_item">
                                                    <div class="form_details_left form_details_item_border">
                                                            <div class="form_details_item_img">
                                                                <img src="/Public/Web/web/img/06_gerenzhongxin/degree.png" alt="">
                                                            </div>
                                                        </div>
                                                    <div class="layui-input-block">
                                                            <textarea name="" id="signature" required lay-verify="required" placeholder="Enter the signature" class="layui-textarea"><?php if($usercontent["user_signature"]): echo ($usercontent['user_signature']); endif; ?></textarea>
                                                    </div>
                                            </div>
                
                                            <div class="form_details_item">
                                                    Registration time : 
                                                <span><?php if($usercontent["user_logintime"]): echo ($usercontent['user_logintime']); else: ?>00-00-0000  00:00:00<?php endif; ?></span>
                                            </div>

                                            <!--<div class="form_details_item">
                                                    Invitation code : 
                                                    <span>1888</span>
                                            </div>-->
                                           
                
                                            <div class="form_details_item item_btn" style="cursor: pointer;" lay-submit="demo1" lay-filter="demo1">
                                                    <button>Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
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
        <script src="/Public/Web/web/js/CreateInterest.js"></script>
        <script src="/Public/Web/web/js/loginQuit.js"></script>

<script>

    layui.use('form', function(){
        var form = layui.form;

        form.on('submit(demo1)', function(data){

            $.ajax({
                type:"post",
                url:"<?php echo U('Index/Ajax/ajax_acountSetting');?>",
                data:{
                    name:$("#name").val(),
                    birth:$("#birth").val(),
                    sex:$("input[name='Sex']:checked").val(),
                    country:$("#country").val(),
                    city:$("#city").val(),
                    signature:$("#signature").val(),
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
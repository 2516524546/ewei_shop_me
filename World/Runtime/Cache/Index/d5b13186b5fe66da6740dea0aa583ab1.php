<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Honorary Edition</title>
    <meta name="viewport" content="width=device-width, initial-scale=0 user-scalable=no, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="/Public/Web/web/css/register.css">
    <link rel="stylesheet" href="/Public/Web/web/css/ListOfDonations.css">
    <link rel="stylesheet" href="/Public/Web/js/lib/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Public/Web/js/lib/bootstrap/dist/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="/Public/Web/js/lib/bootstrap/dist/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="/Public/Web/js/lib/layui/dist/css/layui.css">
    <link rel="stylesheet" href="/Public/Web/web/css/NewsDetails.css">
    <link rel="stylesheet" href="/Public/Web/web/css/Crumbsnav.css">
    <link rel="stylesheet" href="/Public/Web/web/css/success_index.css">

</head>

<body>
    <!-- logo -->
    <header class="container">
        <?php if(!$userid): ?><div class="logreg">
                <a href="<?php echo U('Index/Login/login');?>" class="Login">
                    <span class="LoginIcon"></span>
                    <span>Login</span>
                </a>
                <a href="<?php echo U('Index/SignUp/register');?>" class="SignUp">
                    <span class="SignUpIcon"></span>
                    <span>Sign Up</span>
                </a>
            </div>
            <?php else: ?>
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
        </div><?php endif; ?>
    </header>
    <hr>
    <!-- Crumbs nav -->
    <div class="container Crumbs">
        <span>
          <a href="index.html"></a>
          <cite></cite>
          <span>Honor List</span>
        </span>
    </div>
    <div class="container ContributionContainer">
        <div class="layui-tab layui-tab-card">
            <ul class="layui-tab-title">
                <li class="layui-this" onclick="set(1)">Integral</li>
                <li onclick="set(2)">Donate</li>
                <li onclick="set(3)">Expenditure</li>
            </ul>
            <div class="layui-tab-content ListContainer">
                <div class="layui-tab-item layui-show">
                    <table class="layui-table" id="LayuiTableBorder" lay-skin="line">
                        <tbody id="content">


                        </tbody>
                    </table>
                </div>
                <!--<div class="layui-tab-item">
                    <div class="layui-tab-item layui-show">
                        <table class="layui-table" id="LayuiTableBorder" lay-skin="line">
                            <tbody>
                                <tr>
                                    <td>
                                        <span>
                                        <img src="/Public/Web/web/img/01_shouye/home_sy_hl_icon_01.png">
                                        &nbsp;&nbsp;1st
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        &nbsp;&nbsp;Kendall J
                                    </td>
                                    <td class="text-right">800 integral</td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>
                                        <img src="/Public/Web/web/img/01_shouye/home_sy_hl_icon_04.png">
                                        &nbsp;&nbsp;8st
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        &nbsp;&nbsp;Kendall J
                                    </td>
                                    <td class="text-right">800 integral</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>-->
                <!--<div class="layui-tab-item">
                    <table class="layui-table" id="LayuiTableBorder" lay-skin="line">
                        <tbody>
                            <tr>
                                <td>
                                    <span>
                                    <img src="/Public/Web/web/img/01_shouye/home_sy_hl_icon_01.png">
                                    &nbsp;&nbsp;1st
                                    </span>
                                </td>
                                <td class="text-center">
                                    &nbsp;&nbsp;Kendall J
                                </td>
                                <td class="text-right">$ 1000</td>
                            </tr>
                            <tr>
                                <td>
                                    <span>
                                    <img src="/Public/Web/web/img/01_shouye/home_sy_hl_icon_02.png">
                                    &nbsp;&nbsp;2st
                                    </span>
                                </td>
                                <td class="text-center">
                                    &nbsp;&nbsp;Kendall J
                                </td>
                                <td class="text-right">$ 1000</td>
                            </tr>
                            <tr>
                                <td>
                                    <span>
                                    <img src="/Public/Web/web/img/01_shouye/home_sy_hl_icon_03.png">
                                    &nbsp;&nbsp;3st
                                    </span>
                                </td>
                                <td class="text-center">
                                    &nbsp;&nbsp;Kendall J
                                </td>
                                <td class="text-right">$ 1000</td>
                            </tr>
                            <tr>
                                <td>
                                    <span>
                                    <img src="/Public/Web/web/img/01_shouye/home_sy_hl_icon_04.png">
                                    &nbsp;&nbsp;8st
                                    </span>
                                </td>
                                <td class="text-center">
                                    &nbsp;&nbsp;Kendall J
                                </td>
                                <td class="text-right">$ 1000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>-->
            </div>
        </div>
    </div>
    <div class="container NumberOfPagesContainer">
        <div id="NumberOfPages"></div>
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
                    <dd>Help Center</dd>
                    <dd>Contact Us</dd>
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
    <script src="/Public/Web/js/lib/jquery/dist/jquery.min.js"></script>
    <script src="/Public/Web/js/lib/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/Public/Web/js/lib/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/Public/Web/js/lib/layui/dist/layui.all.js"></script>
    <script src="/Public/Web/web/js/ListOfDonations.js"></script>
    <script src="/Public/Web/web/js/loginQuit.js"></script>
    <!--<script src="/Public/Web/web/js/ListOfDonations.js"></script>-->
</body>

<script>

    set(1)
    function set(type) {
        layui.use(['laypage', 'layer'], function() {
            var laypage = layui.laypage,
                layer = layui.layer;

            //完整功能
            laypage.render({
                elem: 'NumberOfPages',
                count: <?php echo ($usercount); ?>,
                layout: ['count', 'prev', 'page', 'next', 'limit', 'skip'],
                jump: function(obj) {
                    //console.log(obj)
                    setintegral(type,obj.curr,obj.limit)

                }
            });

        });
    }

    function  setintegral(type,limit1,limit2) {

        $.ajax({
            type:"post",
            url:"<?php echo U('Index/Ajax/ajax_honorlist');?>",
            data:{
                type:type,
                limit1:limit1,
                limit2:limit2,

            },
            dataType:"json",
            success: function(data){
                if (data!=null&&data!="") {
                    if (data.str == 1) {
                        var message = '';
                        for (var i = 0; i < data.msg.length; i++) {
                            message +='<tr><td><span>';
                            if(limit1==1){
                                if (i == 0){
                                    message += '<img src="/Public/Web/web/img/01_shouye/home_sy_hl_icon_01.png">';
                                }else if(i == 1){
                                    message += '<img src="/Public/Web/web/img/01_shouye/home_sy_hl_icon_02.png">';
                                }else if (i == 2){
                                    message += '<img src="/Public/Web/web/img/01_shouye/home_sy_hl_icon_03.png">';
                                }else{
                                    message += '<img src="/Public/Web/web/img/01_shouye/home_sy_hl_icon_04.png">';
                                }
                            }else{
                                message += '<img src="/Public/Web/web/img/01_shouye/home_sy_hl_icon_04.png">';
                            }

                            message +='&nbsp;&nbsp;'+((limit1-1)*limit2+i+1)+'st';
                            message +='</span></td>';
                            message +='<td class="text-center">&nbsp;&nbsp;'+data.msg[i].user_name+'</td>';
                            message +='<td class="text-right">'
                            if (type == 1){
                                message += data.msg[i].user_havecoin+' integral</td>';
                            }else if (type == 2){
                                message += data.msg[i].user_outcoin+' integral</td>';
                            }else if (type == 3){
                                message += data.msg[i].user_outmoney+' $</td>';
                            }

                            message +='</tr>';

                        }

                        $('#content').html(message);

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
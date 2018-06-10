<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>More members</title>
    <meta name="viewport" content="width=device-width, initial-scale=0 user-scalable=no, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="/Public/Web/web/css/register.css">
    <link rel="stylesheet" href="/Public/Web/web/css/Donation.css">
    <link rel="stylesheet" href="/Public/Web/web/css/CreateInterest.css">
    <link rel="stylesheet" href="/Public/Web/web/css/GroupDetailsRelease.css">

    <link rel="stylesheet" href="/Public/Web/js/lib/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Public/Web/js/lib/bootstrap/dist/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="/Public/Web/js/lib/bootstrap/dist/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="/Public/Web/js/lib/layui/dist/css/layui.css">
    <link rel="stylesheet" href="/Public/Web/web/css/MoreMembers.css">
    <link rel="stylesheet" href="/Public/Web/web/css/Crumbsnav.css">
    <link rel="stylesheet" href="/Public/Web/web/css/success_index.css">
</head>

<if>
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
        <script src="/Public/Web/web/js/loginout.js"></script>
    </header>
    <hr>
    <!-- Crumbs nav -->
    <div class="container crumbs">
        <a href="<?php echo U('Index/Rnterst/interest');?>" class="crumbsa">interest</a>
        <cite class="Icon"></cite>
        <a href="<?php echo U('Index/Rnterst/groupDetails');?>&cid=<?php echo ($cid); ?>" class="crumbsa">Group name</a>
        <cite class="Icon"></cite>
        <span class="crumbsTitle">More members</span>

    </div>
    <div class="PasswordContainer" id="content">

    </div>
<div class="PasswordContainer_shadow">
    <div class="PasswordContainer_shadow_box">
        <div class="shadow_box_title">
            <div class="shadow_box_title_con">personal information</div>
            <div class="shadow_box_close">x</div>
        </div>
        <div class="shadow_box_details">
            <div class="details_item">
                <div class="item_name">user avatar :</div>
                <div class="item_img"><img src="/Public/Web/web/img/02_interest/user.png" alt=""></div>
            </div>

            <div class="details_item">
                <div class="item_name">nickname :</div>
                <div class="item_con">JJJJ</div>
            </div>

            <div class="details_item">
                <div class="item_name">sex :</div>
                <div class="item_con">male</div>
            </div>

            <div class="details_item">
                <div class="item_name">date of birth :</div>
                <div class="item_con">1990-01-01</div>
            </div>

            <div class="details_item">
                <div class="item_name">invitation :</div>
                <div class="item_con">1812</div>
            </div>

            <div class="details_item">
                <div class="item_name">state :</div>
                <div class="item_con">America</div>
            </div>

            <div class="details_item">
                <div class="item_name">city :</div>
                <div class="item_con">Washington</div>
            </div>

            <div class="details_item">
                <div class="item_name">e-mail :</div>
                <div class="item_con">1812@gmail.com</div>
            </div>

            <div class="details_item">
                <div class="item_name">Signature :</div>
                <div class="item_con">The world is so big, I want to see!The world is so big, I want to see!</div>
            </div>

            <div class="details_button">
                <a href="PersonalCenter.html">
                    homepage
                </a>
            </div>
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
    <script src="/Public/Web/web/js/StickSonDetails.js"></script>
    <script src="/Public/Web/web/js/loginQuit.js"></script>
    <script src="/Public/Web/web/js/Added.js"></script>
</body>

<script>

    set()
    function set() {
        layui.use(['laypage', 'layer'], function() {
            var laypage = layui.laypage,
                layer = layui.layer;

            //完整功能
            laypage.render({
                elem: 'NumberOfPages',
                count: <?php echo ($listcount); ?>,
                layout: ['count', 'prev', 'page', 'next', 'limit', 'skip'],
                jump: function(obj) {
                    //console.log(obj)
                    setmembers(obj.curr,obj.limit)

                }
            });

        });
    }

    function setmembers(limit1,limit2){

        $.ajax({
            type:"post",
            url:"<?php echo U('Index/Ajax/ajax_members');?>",
            data:{
                limit1:limit1,
                limit2:limit2,
                cid:'<?php echo ($cid); ?>',
            },
            dataType:"json",
            success: function(data){
                console.log(data)
                if (data!=null&&data!="") {
                    if (data.str == 1) {
                        var message = '';
                        var adminmessage = '';
                        var membermessage = '';

                        if(data.adminlist != ''){
                            adminmessage +='<div class="box1"><div class="Membertitle">Administrator</div>'
                            for (var i = 0; i < data.adminlist.length; i++){
                                adminmessage += '<div class="MemberContainer"><div class="MemberImgName">'
                                var imgurl = '/Public/Web/web/img/02_interest/user.png';
                                if (data.adminlist[i].user_icon&&data.adminlist[i].user_icon!=''&&data.adminlist[i].user_icon!=null){
                                    imgurl = './Uploads/'+data.adminlist[i].user_icon;
                                }
                                adminmessage += '<img src="'+imgurl+'" class="Memberimg">'
                                adminmessage += '<span>'+data.adminlist[i].user_name+'</span>';
                                adminmessage += '</div><div class="MemberBut">'
                                if (data.adminlist[i].isfriend==1){
                                    adminmessage += '<button class="layui-btn layui-btn-normal layui-btn-radius " clicked>Added</button>'
                                }else{
                                    adminmessage += '<button class="layui-btn layui-btn-normal layui-btn-radius ">Add friend</button>'
                                }

                                adminmessage += '</div></div>'
                            }
                            adminmessage += '</div>'
                        }
                        if(data.memberlist != ''){
                            membermessage +='<div class="box2"><div class="Membertitle">Member</div>'
                            for (var i = 0; i < data.memberlist.length; i++){
                                membermessage += '<div class="MemberContainer"><div class="MemberImgName">'
                                var imgurl = '/Public/Web/web/img/02_interest/user.png';
                                if (data.memberlist[i].user_icon&&data.memberlist[i].user_icon!=''&&data.memberlist[i].user_icon!=null){
                                    imgurl = './Uploads/'+data.memberlist[i].user_icon;
                                }
                                membermessage += '<img src="'+imgurl+'" class="Memberimg">'
                                membermessage += '<span>'+data.memberlist[i].user_name+'</span>';
                                membermessage += '</div><div class="MemberBut">'
                                if (data.memberlist[i].isfriend==1){
                                    membermessage += '<button class="layui-btn layui-btn-normal layui-btn-radius " clicked>Added</button>'
                                }else{
                                    membermessage += '<button class="layui-btn layui-btn-normal layui-btn-radius ">Add friend</button>'
                                }

                                membermessage += '</div></div>'
                            }
                            membermessage += '</div>'
                        }
                        message = adminmessage+membermessage;

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
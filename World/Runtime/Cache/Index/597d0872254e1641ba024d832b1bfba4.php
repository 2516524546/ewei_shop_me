<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Details of the post</title>
    <meta name="viewport" content="width=device-width, initial-scale=0 user-scalable=no, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="/Public/Web/web/css/register.css">
    <link rel="stylesheet" href="/Public/Web/web/css/Donation.css">
    <link rel="stylesheet" href="/Public/Web/web/css/CreateInterest.css">
    <link rel="stylesheet" href="/Public/Web/web/css/GroupDetailsRelease.css">
    <link rel="stylesheet" href="/Public/Web/web/css/StickSonDetails.css">
    <link rel="stylesheet" href="/Public/Web/js/lib/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Public/Web/js/lib/bootstrap/dist/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="/Public/Web/js/lib/bootstrap/dist/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="/Public/Web/js/lib/layui/dist/css/layui.css">
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
        <script src="/Public/Web/web/js/loginout.js"></script>
    </header>
    <hr>
    <!-- Crumbs nav -->
    <div class="container crumbs">
        <a href="<?php echo U('Index/Rnterst/interest');?>" class="crumbsa">interest</a>
        <cite class="Icon"></cite>
        <a href="<?php echo U('Index/Rnterst/groupDetails');?>" class="crumbsa">Group name</a>
        <cite class="Icon"></cite>
        <span class="crumbsTitle">Post details</span>

    </div>
    <div class="container StickSonDetailsContainer">
        <div class="row">
            <div class="col-md-9">
                <p class="text-right">
                    <a href="<?php echo U('Index/Rnterst/postSharing');?>">
                        <img src="/Public/Web/web/img/02_interest/fenxiang.png">
                    </a>
                </p>
                <h3 class="text-center">
                    <img src="/Public/Web/web/img/02_interest/interest_qxx_icon_top.png">
                    <img src="/Public/Web/web/img/02_interest/interest_qxx_icon_jing.png">
                    Post Title
                    <p class="text-center StickSonDetailsTitleTime">01-20-2018 20:18:58</p>
                </h3>
                <div class="StickSonDetailsContent">
                    <p>
                        Post content Post content Post content Post content Post content Post content Post content conten Post content Post content Post content Post content Post content Post content Post content conte Post content content Post content Post content conte Post content
                    </p>
                    <p>
                        <img src="/Public/Web/web/img/banner.png" class="imgs">
                    </p>
                    <div class="PostReply">
                        <P>
                            <img src="/Public/Web/web/img/02_interest/interest_qxx_icon_pl.png">&nbsp;&nbsp;
                            <b>Comment</b>
                        </P>
                        <div class="box">
                            <p class="GuestBookUserImg">
                                <img src="/Public/Web/web/img/02_interest/user.png" class="imgs img-circle">
                            </p>
                            <div class="GuestBookContainer">
                                <div class="GuestBookUserTitleContainer">
                                    <p class="GuestBookUserName">David J.</p>
                                    <p class="TimeFabulousContainer">
                                        <span class="GuestBookUserTime">
                                            <img src="/Public/Web/web/img/02_interest/interest_xq_icon_time.png">
                                            01/12/2018
                                        </span>
                                        <span class="GuestBookUserFabulous">
                                            Reply&nbsp;&nbsp;|&nbsp;&nbsp;
                                            <img src="/Public/Web/web/img/02_interest/vinterest_xq_icon_dianzan.png">
                                            333
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="GuestBookUserMessage">
                                coocommentcoocommentcoocommentcocoocommentcoocommentcoocommentcocoocommen
                            </div>
                            <div class="ReplyContainer">
                                @Tom 回复 Jack ： xxxxxxxxxxxx
                            </div>
                        </div>
                        <div class="box">
                            <p class="GuestBookUserImg">
                                <img src="/Public/Web/web/img/02_interest/user.png" class="imgs img-circle">
                            </p>
                            <div class="GuestBookContainer">
                                <div class="GuestBookUserTitleContainer">
                                    <p class="GuestBookUserName">David J.</p>
                                    <p class="TimeFabulousContainer">
                                        <span class="GuestBookUserTime">
                                            <img src="/Public/Web/web/img/02_interest/interest_xq_icon_time.png">
                                            01/12/2018
                                        </span>
                                        <span class="GuestBookUserFabulous">
                                            Reply&nbsp;&nbsp;|&nbsp;&nbsp;
                                            <img src="/Public/Web/web/img/02_interest/vinterest_xq_icon_dianzan.png">
                                            333
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="GuestBookUserMessage">
                                coocommentcoocommentcoocommentcocoocommentcoocommentcoocommentcocoocommen
                            </div>
                            <div class="ReplyContainer">
                                @Tom 回复 Jack ： xxxxxxxxxxxx
                            </div>
                        </div>
                        <div class="box">
                            <p class="GuestBookUserImg">
                                <img src="/Public/Web/web/img/02_interest/user.png" class="imgs img-circle">
                            </p>
                            <div class="GuestBookContainer">
                                <div class="GuestBookUserTitleContainer">
                                    <p class="GuestBookUserName">David J.</p>
                                    <p class="TimeFabulousContainer">
                                        <span class="GuestBookUserTime">
                                            <img src="/Public/Web/web/img/02_interest/interest_xq_icon_time.png">
                                            01/12/2018
                                        </span>
                                        <span class="GuestBookUserFabulous">
                                            Reply&nbsp;&nbsp;|&nbsp;&nbsp;
                                            <img src="/Public/Web/web/img/02_interest/vinterest_xq_icon_dianzan.png">
                                            333
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="GuestBookUserMessage">
                                coocommentcoocommentcoocommentcocoocommentcoocommentcoocommentcocoocommen
                            </div>
                            <div class="ReplyContainer">
                                @Tom 回复 Jack ： xxxxxxxxxxxx
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container NumberOfPagesContainer">
                    <div id="NumberOfPages"></div>
                </div>
                <form class="layui-form" action="">
                    <p style="color: #999; margin-bottom: 10px;">
                        Tips: think this article how? Evaluation helps other readers understand this article.
                    </p>
                    <div class="ReturnBox">
                        <div class="layui-form-item layui-form-text">
                            <span class="ReturnBoxicon">
                                <img src="/Public/Web/web/img/02_interest/interest_xq_icon_pj.png">
                                &nbsp;
                                Comments
                            </span>
                            <textarea placeholder="Please enter the comment content" class="layui-textarea Returntextarea"></textarea>
                            <button type="submit" class="layui-btn layui-btn-normal layui-btn-radius Returnbut">Posted</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-3">
                <div class="GroupDetailsContainer">
                    <p class="text-center h5 p">Post Details</p>
                    <p class="p"><b>Personal Information</b></p>
                    <p class="p">
                        <b>Group icon  : </b>
                        &nbsp;&nbsp;<img src="/Public/Web/web/img/02_interest/Todoist.png">
                    </p>
                    <p class="p"><b>Nickname：</b>Xiao Li</p>
                    <p class="p"><b>Number of posts  :</b>1278</p>
                    <p class="text-center Followtbut">
                        <a href="#" class="layui-btn layui-btn-radius layui-btn-lg layui-btn-normal" id="GroupBtn">
                        Homepage
                        </a>
                    </p>
                </div>
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
</body>

</html>
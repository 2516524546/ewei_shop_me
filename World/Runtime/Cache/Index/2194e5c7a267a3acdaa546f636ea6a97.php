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
    <link rel="stylesheet" href="/Public/Web/web/css/MoreMembers.css">
    <link rel="stylesheet" href="/Public/Web/js/lib/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Public/Web/js/lib/bootstrap/dist/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="/Public/Web/js/lib/bootstrap/dist/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="/Public/Web/js/lib/layui/dist/css/layui.css">
</head>

<body>
    <!-- logo -->
    <header class="container">
        <div class="logreg">
            <a href="<?php echo U('Index/Login/login');?>" class="Login">
                <span class="LoginIcon"></span>
                <span>Login</span>
            </a>
            <a href="<?php echo U('Index/SignUp/register');?>" class="SignUp">
                <span class="SignUpIcon"></span>
                <span>Sign Up</span>
            </a>
        </div>
    </header>
    <hr>
    <!-- Crumbs nav -->
    <div class="container Crumbs">
        <span class="CrumbsSpan">
          <a href="<?php echo U('Index/Academic/academic');?>" class="CrumbsA">Interest</a>
          <cite class="CrumbsIcon"></cite>
          <span class="CrumbsTitle"><a href="<?php echo U('Index/Academic/academicGroups');?>" class="CrumbsA">Group name</a></span>
        <cite class="CrumbsIcons"></cite>
        <span class="CrumbsTitles">More members</span>
        </span>
    </div>
    <div class="PasswordContainer">
        <div class="box1">
            <div class="Membertitle">Administrator</div>
            <div class="MemberContainer">
                <div class="MemberImgName">
                    <img src="/Public/Web/web/img/02_interest/user.png" class="Memberimg">
                    <span>Kendall J.</span>
                </div>
                <div class="MemberBut">
                    <button class="layui-btn layui-btn-normal layui-btn-radius">Add friend</button>
                </div>
            </div>
            <div class="MemberContainer">
                <div class="MemberImgName">
                    <img src="/Public/Web/web/img/02_interest/user.png" class="Memberimg">
                    <span>Kendall J.</span>
                </div>
                <div class="MemberBut">
                    <button class="layui-btn layui-btn-normal layui-btn-radius">Add friend</button>
                </div>
            </div>
        </div>
        <div class="box2">
            <div class="Membertitle">Member</div>
            <div class="MemberContainer">
                <div class="MemberImgName">
                    <img src="/Public/Web/web/img/02_interest/user.png" class="Memberimg">
                    <span>Kendall J.</span>
                </div>
                <div class="MemberBut">
                    <button class="layui-btn layui-btn-normal layui-btn-radius">Add friend</button>
                </div>
            </div>
            <div class="MemberContainer">
                <div class="MemberImgName">
                    <img src="/Public/Web/web/img/02_interest/user.png" class="Memberimg">
                    <span>Kendall J.</span>
                </div>
                <div class="MemberBut">
                    <button class="layui-btn layui-btn-normal layui-btn-radius">Add friend</button>
                </div>
            </div>
            <div class="MemberContainer">
                <div class="MemberImgName">
                    <img src="/Public/Web/web/img/02_interest/user.png" class="Memberimg">
                    <span>Kendall J.</span>
                </div>
                <div class="MemberBut">
                    <button class="layui-btn layui-btn-normal layui-btn-radius">Add friend</button>
                </div>
            </div>
            <div class="MemberContainer">
                <div class="MemberImgName">
                    <img src="/Public/Web/web/img/02_interest/user.png" class="Memberimg">
                    <span>Kendall J.</span>
                </div>
                <div class="MemberBut">
                    <button class="layui-btn layui-btn-normal layui-btn-radius">Add friend</button>
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
</body>

</html>
<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Post Sharing</title>
    <meta name="viewport" content="width=device-width, initial-scale=0 user-scalable=no, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="/Public/Web/web/css/register.css">
    <link rel="stylesheet" href="/Public/Web/web/css/Donation.css">
    <link rel="stylesheet" href="/Public/Web/web/css/PostSharing.css">
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
    <!-- Forget the password form -->
    <form class="layui-form layui-form-pane" action="">
        <div class="PasswordContainer">
            <p class="PostSharingbtext">
                Post content Post content Post content Post content Post content Post content Post content conten Post content
                Post content Post content Post content Post content Post content Post content  conte Post content content Post
                content Post content  conte Post content - Share oneself
                @newworld https:/www.newworld.com/
            </p>
            <hr>
            <p class="PostSharingbvideo">
                <a href="#">https://www.newworld.com/cover/psg9dnq6tz8qa08/f06073orbqe.html</a>
                <img src="/Public/Web/web/img/02_interest/picshipin.png" class="PostSharingbimg">
            </p>
            <hr>
            <p class="text-right PostSharingbut">
                <button class="layui-btn layui-btn-normal layui-btn-radius">Share</button>
            </p>
        </div>
    </form>
    <!-- foot start 底部信息 -->
    <footer class="container-fluid PostSharingfooter">
        <p class="text-center">&copy; 2018 NewWorld. All rights reserved.</p>
    </footer>
    <!-- foot end 底部信息 -->
    <script src="/Public/Web/js/lib/jquery/dist/jquery.min.js"></script>
    <script src="/Public/Web/js/lib/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/Public/Web/js/lib/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/Public/Web/js/lib/layui/dist/layui.all.js"></script>
</body>

</html>
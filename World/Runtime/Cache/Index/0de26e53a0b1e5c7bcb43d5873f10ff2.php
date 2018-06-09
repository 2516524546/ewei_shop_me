<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Group details release</title>
    <meta name="viewport" content="width=device-width, initial-scale=0 user-scalable=no, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="/Public/Web/web/css/register.css">
    <link rel="stylesheet" href="/Public/Web/web/css/Donation.css">
    <link rel="stylesheet" href="/Public/Web/web/css/CreateInterest.css">
    <link rel="stylesheet" href="/Public/Web/web/css/GroupDetailsRelease.css">
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
          <a href="<?php echo U('Index/Jobs/work');?>" class="CrumbsA">Jobs</a>
          <cite class="CrumbsIcon"></cite>
          <span class="CrumbsTitle"><a href="<?php echo U('Index/Jobs/groupDetails');?>" class="CrumbsA">Group name</a></span>
        <cite class="CrumbsIcons"></cite>
        <span class="CrumbsTitles">Release</span>
        </span>
    </div>
    <!-- Forget the password form -->
    <form class="layui-form layui-form-pane" action="">
        <div class="PasswordContainer">
            <div class="StepContainer">
                <div class="StepContainerOne">
                    <div class="InterestTitle">
                        <h3 class="text-center Interesth3">
                            Post basic information
                        </h3>
                    </div>
                    <div class="FormContainer" pane>
                        <label class="layui-form-label label-spacing">
                            <span class="TitlesIcon"></span>
                        </label>
                        <div class="layui-input-block input-spacing">
                            <input type="text" name="number" lay-verify="required" autocomplete="off" placeholder="Enter the title" class="layui-input">
                        </div>
                    </div>
                    <div class="FormContainer" pane>
                        <label class="layui-form-label label-spacing">
                            <span class="TypesIcon"></span>
                        </label>
                        <div class="layui-input-block" id="layui-input-block">
                            <select name="city" lay-verify="required">
                                <option value="">Post</option>
                                <option value="0">1</option>
                            </select>
                        </div>
                    </div>
                    <div class="FormContainer" pane>
                        <label class="layui-form-label label-spacing">
                            <span class="ContentsIcon"></span>
                        </label>
                        <div class="layui-input-block input-spacing">
                            <input type="text" name="number" lay-verify="required" autocomplete="off" placeholder="Enter the content" class="layui-input">
                        </div>
                    </div>
                    <div class="FormContainer" pane>
                        <label class="HeadPortraitbox">
                            <span class="HeadPortraitIcon"></span>
                        </label>
                        <div class="picDiv">
                            <div class="addImages">
                                <!--multiple属性可选择多个图片上传-->
                                <input type="file" class="file" id="fileInput" multiple="" accept="image/png, image/jpeg, image/gif, image/jpg">
                                <div class="text-detail">
                                    <span>+</span>
                                </div>
                            </div>
                        </div>
                        <div class="msg" style="display: none;"></div>
                    </div>
                    <div class="FormContainer from-but">
                        <button class="layui-btn layui-btn-normal layui-btn-radius Submit-but" lay-submit="" lay-filter="">
                            Submit
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
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
    <script src="/Public/Web/web/js/GroupDetailsRelease.js"></script>
</body>

</html>
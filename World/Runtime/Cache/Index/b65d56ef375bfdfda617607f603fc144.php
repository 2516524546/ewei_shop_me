<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Job Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=0 user-scalable=no, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="/Public/Web/web/css/register.css">
    <link rel="stylesheet" href="/Public/Web/web/css/Donation.css">
    <link rel="stylesheet" href="/Public/Web/web/css/CreateInterest.css">
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
          <a href="<?php echo U('Index/Jobs/work');?>" class="CrumbsA" style="position: relative;top: -3px;background: none;left: -6px;color: #1E9FFF;text-decoration: none;">Jobs</a>
          <cite class="CrumbsIcon" style="margin-left: -70px;position: relative;top: -2px;"></cite>
          <a href="<?php echo U('Index/Jobs/jobList');?>" class="CrumbsA" style="position: relative;top: -3px;background: none;left: 20px;color: #1E9FFF;text-decoration: none;">Job Listings</a>
          <cite class="CrumbsIcon" style="margin-left: 78px;position: relative;top: -2px;"></cite>
          <span class="CrumbsTitle" style="margin-left: 0;margin-top: -3px;">Job Details</span>
        </span>
        
    </div>
    <!-- Forget the password form -->
    <form class="layui-form" action="">
        <div class="PasswordContainer">
            <div class="StepContainer">
                <div class="StepContainerOne">
                    <div class="InterestTitle">
                        <h3 class="Interesth3">
                            Basic Information
                        </h3>
                    </div>
                    <div class="boxp" style="margin-left: 80px;">
                        <div class="FormContainer" style="margin-left: 84px;margin-bottom: 10px;">
                            <p class="">Job type : Full Time</p>
                        </div>
                        <div class="FormContainer" style="margin-left: 87px;margin-bottom: 10px;">
                            <p class="">Position : Mobile development engineer</p>
                        </div>
                        <div class="FormContainer" style="margin-left: 97px;margin-bottom: 10px;">
                            <p class="">Salary : $ 1000 ~ $ 2000</p>
                        </div>
                        <div class="FormContainer" style="margin-left: 38px;margin-bottom: 10px;">
                            <p class="">Years of service : 3 years</p>
                        </div>
                        <div class="FormContainer" style="margin-left: 14px;margin-bottom: 10px;">
                            <p class="">Bachelor of Science : Dr.</p>
                        </div>
                        <div class="FormContainer" style="margin-left: 73px;margin-bottom: 10px;">
                            <p class="">Profession : Computer Mobile Development</p>
                        </div>
                    </div>
                    <div class="InterestTitle" style="margin-top: 45px;">
                        <h3 class="Interesth3">
                            Company Information
                        </h3>
                    </div>
                    <div class="boxp" style="margin-left: 80px;">
                        <div class="FormContainer" style="margin-left: 84px;margin-bottom: 10px;">
                            <p class="">Company name : xxxxxx</p>
                        </div>
                        <div class="FormContainer" style="margin-left: 87px;margin-bottom: 10px;">
                            <p class="">Company Type : State-owned company</p>
                        </div>
                        <div class="FormContainer" style="margin-left: 69px;margin-bottom: 10px;">
                            <p class="">Type Of Company : the Internet</p>
                        </div>
                        <div class="FormContainer" style="margin-left: 91px;margin-bottom: 10px;">
                            <p class="">Company Size : 1000 ~ 2000 people</p>
                        </div>
                        <div class="FormContainer" style="margin-left: 37px;margin-bottom: 10px;">
                            <p class="">Receive Resume Email : xxxxx@xxx.com</p>
                        </div>
                        <div class="FormContainer" style="margin-left: 49px;margin-bottom: 10px;">
                            <p class="">Company Information : xxxxxxxxxxxxxxxxxxxxxxxxx</p>
                        </div>
                        <div class="FormContainer" style="margin-left: 73px;margin-bottom: 10px;">
                            <p class="">Salary Negotiable : no</p>
                        </div>
                    </div>
                    <div class="but" style="margin: 30px auto 0;width: 30%;">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-sm">Immediate Delivery</button>
                    </div>
                    <!-- 弹窗 -->
                    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                        <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header" style="padding-bottom: 0;">
                                    <h4 class="modal-title text-left" id="myModalLabel">Modal title</h4>
                                    <button type="button" style="margin-top: -26px;" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <p>Please select the resume to be delivered</p>
                                    <div class="layui-input-block" style="margin: 18px 66px 10px 0;">
                                        <select name="interest" lay-filter="aihao">
                                            <option value="" selected="">Resume 1</option>
                                            <option value="0">1</option>
                                            <option value="1">2</option>
                                        </select>
                                    </div>
                                    <p style="line-height: 20px;">
                                        Note:
                                        <br> If you do not have a resume, you can click on the inverted triangle icon on the right side of the login account, select My Resume -> Create Resume in My Resume
                                    </p>
                                    <p style="margin: 14px 0;">Clickable: <span style="color: #46c4b8;">Create a resume</span></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Delivery</button>
                                </div>
                            </div>
                        </div>
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
    <script src="/Public/Web/web/js/CreateInterest.js"></script>
</body>

</html>
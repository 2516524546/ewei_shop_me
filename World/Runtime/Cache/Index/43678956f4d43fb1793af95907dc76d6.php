<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Release project</title>
    <meta name="viewport" content="width=device-width, initial-scale=0 user-scalable=no, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="/Public/Web/web/css/register.css">
    <link rel="stylesheet" href="/Public/Web/web/css/JobList.css">
    <link rel="stylesheet" href="/Public/Web/web/css/CreateInterest.css">
    <link rel="stylesheet" href="/Public/Web/web/css/Donation.css">
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
            <a href="<?php echo U('Index/Jobs/work');?>" class="crumbsa">Jobs</a>
            <cite class="Icon"></cite>
            <a href="<?php echo U('Index/Jobs/projectsProfessionals');?>" class="crumbsa">Item List</a>
            <cite class="Icon"></cite>
            <span class="crumbsTitle">Publish the project</span>
        </div>
    <!-- Forget the password form -->
    <form class="layui-form layui-form-pane" action="">
        <div class="PasswordContainer">
            <div class="StepContainer">
                <div class="StepContainerOne">
                    <div class="InterestTitle">
                        <h3 class="text-center Interesth3">
                            <span class="InterestTitleIcon"></span>Basic Information
                        </h3>
                    </div>
                    <div class="FormContainer layui-form-item" pane>
                        <label class="layui-form-label label-spacing">
                            <img src="/Public/Web/web/img/04_jobs/jobs_create_icon_city.png">
                        </label>
                        <div class="layui-input-block" id="layui-input-block">
                            <select name="city" lay-verify="required">
                                <option value="">Choose a city</option>
                                <option value="0">1</option>
                            </select>
                        </div>
                    </div>
                    <div class="FormContainer layui-form-item" pane>
                        <label class="layui-form-label label-spacing">
                            <img src="/Public/Web/web/img/04_jobs/jobs_create_icon_industry.png">
                        </label>
                        <div class="layui-input-block" id="layui-input-block">
                            <select name="city" lay-verify="required">
                                <option value="">Choose industry</option>
                                <option value="0">1</option>
                            </select>
                        </div>
                    </div>
                    <div class="FormContainer layui-form-item" pane>
                        <label class="layui-form-label label-spacing">
                            <img src="/Public/Web/web/img/04_jobs/jobs_create_icon_school.png">
                        </label>
                        <div class="layui-input-block" id="layui-input-block">
                            <select name="city" lay-verify="required">
                                <option value="">Choose a school</option>
                                <option value="0">1</option>
                            </select>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 64px;">
                            <img src="/Public/Web/web/img/04_jobs/jobs_create_icon_porjetname.png">
                        </label>
                        <div class="layui-input-block" style="margin-left: 64px;">
                            <input type="text" name="title" lay-verify="title" autocomplete="off" placeholder="Enter the project name" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 64px;">
                            <img src="/Public/Web/web/img/04_jobs/jobs_create_icon_realname.png" width="24px" height="auto">
                        </label>
                        <div class="layui-input-block" style="margin-left: 64px;">
                            <input type="text" name="title" lay-verify="title" autocomplete="off" placeholder="Enter the sponsor's real name" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 64px;">
                            <img src="/Public/Web/web/img/04_jobs/jobs_create_icon_contact.png">
                        </label>
                        <div class="layui-input-block" style="margin-left: 64px;">
                            <input type="text" name="title" lay-verify="title" autocomplete="off" placeholder="Enter the contact information" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 64px;">
                            <img src="/Public/Web/web/img/04_jobs/jobs_create_icon_email.png">
                        </label>
                        <div class="layui-input-block" style="margin-left: 64px;">
                            <input type="text" name="title" lay-verify="title" autocomplete="off" placeholder="Enter the email" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 64px;">
                            <img src="/Public/Web/web/img/04_jobs/jobs_sy_icon_09.png">
                        </label>
                        <div class="layui-input-block" style="margin-left: 64px;">
                            <input type="text" name="title" lay-verify="title" autocomplete="off" placeholder="Enter the company" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item layui-form-text" style="height: 100px;">
                        <label class="layui-form-label" style="width: 12%;z-index: 2;background: none;border: none;">
                            <img src="/Public/Web/web/img/04_jobs/jobs_create_icon_write.png">
                        </label>
                        <div class="layui-input-block" style="position: relative;top: -46px;">
                            <textarea placeholder="Enter the company information" class="layui-textarea" style="padding: 12px 58px 0;"></textarea>
                        </div>
                    </div>
                    <div class="layui-form-item layui-form-text" style="height: 100px;">
                        <label class="layui-form-label" style="width: 12%;z-index: 2;background: none;border: none;">
                            <img src="/Public/Web/web/img/04_jobs/jobs_create_icon_type.png">
                        </label>
                        <div class="layui-input-block" style="position: relative;top: -46px;">
                            <textarea placeholder="Enter the company information" class="layui-textarea" style="padding: 12px 58px 0;"></textarea>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 64px;">
                            <img src="/Public/Web/web/img/04_jobs/jobs_create_icon_money.png">
                        </label>
                        <div class="layui-input-block" style="margin-left: 64px;">
                            <input type="text" name="title" lay-verify="title" autocomplete="off" placeholder="Enter the project budget" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 64px;">
                            <img src="/Public/Web/web/img/04_jobs/jobs_create_icon_time.png">
                        </label>
                        <div class="layui-input-block" style="margin-left: 64px;">
                            <input type="text" name="title" lay-verify="title" autocomplete="off" placeholder="Enter the project time" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 64px;">
                            <img src="/Public/Web/web/img/04_jobs/jobs_create_icon_need.png">
                        </label>
                        <div class="layui-input-block" style="margin-left: 64px;">
                            <input type="text" name="title" lay-verify="title" autocomplete="off" placeholder="Enter professional needs" class="layui-input">
                        </div>
                    </div>
                    <div class="FormContainer from-but" style="margin-top: 0;">
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
    <script src="/Public/Web/js/lib/jquery/dist/jquery.min.js"></script>
    <script src="/Public/Web/js/lib/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/Public/Web/js/lib/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/Public/Web/js/lib/layui/dist/layui.all.js"></script>
    <script src="/Public/Web/web/js/ListOfDonations.js"></script>
    <script src="/Public/Web/web/js/loginQuit.js"></script>
</body>

</html>
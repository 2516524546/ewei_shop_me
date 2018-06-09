<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Job list</title>
    <meta name="viewport" content="width=device-width, initial-scale=0 user-scalable=no, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="/Public/Web/web/css/register.css">
    <link rel="stylesheet" href="/Public/Web/web/css/JobList.css">
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
            <a href="<?php echo U('Index/Jobs/work');?>" class="crumbsa">Jobs</a>
            <cite class="Icon"></cite>
            <a href="<?php echo U('Index/Jobs/work');?>" class="crumbsa">Job Listings</a>
            <cite class="Icon"></cite>
            <span class="crumbsTitle">My Post</span>
        </div>
    <div class="container ContributionContainer">
        <div class="row">
            <div class="col-md-6">
                <div class="UserBox">
                    <a href="JobDetails.html" class="UserLink">
                        <p class="lintpheight">
                            Job Title : Mobile development engineer
                        </p>
                        <p class="lintpheight">
                            Company Name : Apple
                        </p>
                        <p class="lintpheight">
                            Work experience : 3 years
                        </p>
                        <p class="lintpheight">
                            Salary : $ 1000 ~ $ 2000
                            <a href="PostDeliveryRecord.html" style="position: absolute;right: 150px;">
                                <img src="/Public/Web/web/img/04_jobs/jobs_zwlb_jl_icon_deliveryrecord.png">
                            </a>
                            <a href="#" style="position: absolute;right: 110px;" data-toggle="modal" data-target="#box3">
                                <img src="/Public/Web/web/img/04_jobs/jobs_zwlb_m_icon_pj.png">
                            </a>
                            <a href="#" style="position: absolute;right: 70px;" data-toggle="modal" data-target="#box2">
                                <img src="/Public/Web/web/img/04_jobs/jobs_zwlb_m_icon_close.png">
                            </a>
                            <a href="#" style="position: absolute;right: 40px;" data-toggle="modal" data-target="#box1">
                                <img src="/Public/Web/web/img/04_jobs/jobs_zwlb_m_icon_del.png">
                            </a>
                            <!-- 删除 -->
                            <div id="box1" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                                <div class="modal-dialog modal-sm" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <span class="modal-title">
                                                Reminder
                                            </span>
                                            <a class="close" data-dismiss="modal" aria-label="Close" style="position: absolute;right: 10px;top: 16px;">
                                                <span aria-hidden="true">&times;</span>
                                            </a>
                                        </div>
                                        <div class="modal-body">
                        <p class="text-center">Are you closing the job?</p>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">confirm</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- 关闭 -->
                            <div id="box2" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                                <div class="modal-dialog modal-sm" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <span class="modal-title">
                                                Reminder
                                            </span>
                                            <a class="close" data-dismiss="modal" aria-label="Close" style="position: absolute;right: 10px;top: 16px;">
                                                <span aria-hidden="true">&times;</span>
                                            </a>
                                        </div>
                                        <div class="modal-body">
                                            <p class="text-center">Are you closing the job?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">confirm</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- 编辑 -->
                            <div id="box3" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <span class="modal-title">
                                                Editing project
                                            </span>
                                            <a class="close" data-dismiss="modal" aria-label="Close" style="position: absolute;right: 10px;top: 16px;">
                                                <span aria-hidden="true">&times;</span>
                                            </a>
                                        </div>
                                        <div class="modal-body">
                                            <p style="margin:14px 0;">Essential information</p>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label" style="margin-left: -22px;">
                                                    <img src="/Public/Web/web/img/04_jobs/jobs_create_icon_type.png">
                                                </label>
                                                <div class="label" style="padding-top: 13px;padding-left: 120px;">
                                                    <label class="radio-inline">
                                                        <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> Full Time
                                                    </label>
                                                    <label class="radio-inline" style="margin: 0 32px;">
                                                        <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> Part Time
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3"> Practice
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label" style="width: 64px;">
                                                    <img src="/Public/Web/web/img/04_jobs/jobs_sy_icon_08.png">
                                                </label>
                                                <div class="layui-input-block" style="margin-left: 64px;">
                                                    <input type="text" name="title" lay-verify="title" autocomplete="off" placeholder="Enter a job title" class="layui-input">
                                                </div>
                                            </div>
                                            <div class="layui-form-item">
                                                <div class="layui-inline">
                                                    <label class="layui-form-label" style="width: 64px;">
                                                        <img src="/Public/Web/web/img/04_jobs/jobs_create_icon_money.png">
                                                    </label>
                                                    <div class="layui-input-inline" style="width: 100px;">
                                                        <input type="text" name="price_min" placeholder="￥" autocomplete="off" class="layui-input">
                                                    </div>
                                                    <div class="layui-form-mid">-</div>
                                                    <div class="layui-input-inline" style="width: 100px;">
                                                        <input type="text" name="price_max" placeholder="￥" autocomplete="off" class="layui-input">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label" style="width: 64px;">
                                                    <img src="/Public/Web/web/img/04_jobs/jobs_sy_icon_07.png" width="24px" height="auto">
                                                </label>
                                                <div class="layui-input-block" style="margin-left: 64px;">
                                                    <input type="text" name="title" lay-verify="title" autocomplete="off" placeholder="Enter the number of years of service" class="layui-input">
                                                </div>
                                            </div>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label" style="width: 64px;">
                                                    <img src="/Public/Web/web/img/04_jobs/jobs_create_icon_school.png">
                                                </label>
                                                <div class="layui-input-block" style="margin-left: 64px;">
                                                    <input type="text" name="title" lay-verify="title" autocomplete="off" placeholder="Enter a graduate school" class="layui-input">
                                                </div>
                                            </div>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label" style="width: 64px;">
                                                    <img src="/Public/Web/web/img/04_jobs/1.png">
                                                </label>
                                                <div class="layui-input-block" style="margin-left: 64px;">
                                                    <input type="text" name="title" lay-verify="title" autocomplete="off" placeholder="Enter your degree" class="layui-input">
                                                </div>
                                            </div>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label" style="width: 64px;">
                                                    <img src="/Public/Web/web/img/04_jobs/jobs_create_icon_major.png">
                                                </label>
                                                <div class="layui-input-block" style="margin-left: 64px;">
                                                    <input type="text" name="title" lay-verify="title" autocomplete="off" placeholder="Enter professional" class="layui-input">
                                                </div>
                                            </div>

                                            <p class="h6 text-center">Company Information</p>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label" style="width: 64px;">
                                                    <img src="/Public/Web/web/img/04_jobs/jobs_create_icon_company.png">
                                                </label>
                                                <div class="layui-input-block" style="margin-left: 64px;">
                                                    <input type="text" name="title" lay-verify="title" autocomplete="off" placeholder="Enter a job title" class="layui-input">
                                                </div>
                                            </div>
                                            <div class="FormContainer layui-form-item" pane>
                                                <label class="col-sm-2 control-label" style="position: absolute;">
                                                    <img src="/Public/Web/web/img/04_jobs/jobs_create_icon_choose.png" style="position: absolute;left: 26px;top: 10px;">
                                                </label>
                                                <div class="col-sm-10" style="position: absolute;left: 66px;">
                                                    <select class="form-control">
                                                        <option>Please choose the nature of the company</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                        <option>4</option>
                                                        <option>5</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="FormContainer layui-form-item" pane style="margin-top: 70px;margin-bottom: 124px;">
                                                <label class="col-sm-2 control-label" style="position: absolute;">
                                                    <img src="/Public/Web/web/img/04_jobs/jobs_create_icon_type.png" style="position: absolute;left: 26px;top: 10px;">
                                                </label>
                                                <div class="col-sm-10" style="position: absolute;left: 66px;">
                                                    <select class="form-control">
                                                        <option>Please select company type</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                        <option>4</option>
                                                        <option>5</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label" style="width: 64px;">
                                                    <img src="/Public/Web/web/img/04_jobs/jobs_create_icon_groupname.png">
                                                </label>
                                                <div class="layui-input-block" style="margin-left: 64px;">
                                                    <input type="text" name="title" lay-verify="title" autocomplete="off" placeholder="Enter the company size" class="layui-input">
                                                </div>
                                            </div>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label" style="width: 64px;">
                                                    <img src="/Public/Web/web/img/04_jobs/jobs_create_icon_email.png">
                                                </label>
                                                <div class="layui-input-block" style="margin-left: 64px;">
                                                    <input type="text" name="title" lay-verify="title" autocomplete="off" placeholder="Enter the resume mailbox" class="layui-input">
                                                </div>
                                            </div>
                                            <div class="layui-form-item layui-form-text" style="height: 100px;">
                                                <label class="layui-form-label" style="z-index: 2;background: none;border: none;position: absolute;left: 0;">
                                                    <img src="/Public/Web/web/img/04_jobs/jobs_create_icon_write.png">
                                                </label>
                                                <div class="layui-input-block" style="position: relative;left: -46px;">
                                                    <textarea placeholder="Enter the company information" class="layui-textarea"></textarea>
                                                </div>
                                            </div>
                                            <!--  -->
                                            <div class="layui-form-item">
                                                <label class="layui-form-label" style="margin-left: -22px;width: 150px;margin-right: 28px;">
                                                    Salary Negotiable
                                                </label>
                                                <div class="label" style="padding-top: 13px;padding-left: 120px;">
                                                    <label class="radio-inline">
                                                        <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> no
                                                    </label>
                                                    <label class="radio-inline" style="margin: 0 32px;">
                                                        <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> yes
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary">Preservation</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </p>
                    </a>
                </div>
    <?php if(is_array($worklist)): foreach($worklist as $k=>$w): ?><div class="UserBox">
                    <a href="JobDetails.html" class="UserLink">
                        <p class="lintpheight">
                            Job Title : <?php echo ($w['works_position']); ?>
                        </p>
                        <p class="lintpheight">
                            Company Name : <?php echo ($w['works_company_name']); ?>
                        </p>
                        <p class="lintpheight">
                            Work experience : <?php echo ($w['works_years']); ?> years
                        </p>
                        <p class="lintpheight">
                            Salary : $ <?php echo ($w['works_minmoney']); ?> ~ $ <?php echo ($w['works_maxmoney']); ?>
                            <?php if($w["works_isclose"]==1): ?><a href="PostDeliveryRecord.html" style="position: absolute;right: 150px;"><img src="/Public/Web/web/img/04_jobs/jobs_zwlb_jl_icon_deliveryrecord.png"></a>
                                <a href="#" style="position: absolute;right: 110px;"><img src="/Public/Web/web/img/04_jobs/jobs_zwlb_m_icon_pj.png"></a>
                                <a href="#" style="position: absolute;right: 70px;"><img src="/Public/Web/web/img/04_jobs/jobs_zwlb_m_icon_close.png"></a>
                                <a href="#" style="position: absolute;right: 40px;"><img src="/Public/Web/web/img/04_jobs/jobs_zwlb_m_icon_del.png"></a><?php else: endif; ?>

                        </p>
                    </a>
                </div><?php endforeach; endif; ?>
                <div class="UserBox">
                    <a href="JobDetails.html" class="UserLink">
                        <p class="lintpheight">
                            Job Title : Mobile development engineer
                        </p>
                        <p class="lintpheight">
                            Company Name : Apple
                        </p>
                        <p class="lintpheight">
                            Work experience : 3 years
                        </p>
                        <p class="lintpheight">
                            Salary : $ 1000 ~ $ 2000
                            <a href="PostDeliveryRecord.html" style="position: absolute;right: 150px;"><img src="/Public/Web/web/img/04_jobs/jobs_zwlb_jl_icon_deliveryrecord.png"></a>
                            <a href="#" style="position: absolute;right: 110px;"><img src="/Public/Web/web/img/04_jobs/jobs_zwlb_m_icon_pj.png"></a>
                            <a href="#" style="position: absolute;right: 70px;"><img src="/Public/Web/web/img/04_jobs/jobs_zwlb_m_icon_close.png"></a>
                            <a href="#" style="position: absolute;right: 40px;"><img src="/Public/Web/web/img/04_jobs/jobs_zwlb_m_icon_del.png"></a>
                        </p>
                    </a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="UserBox">
                    <a href="JobDetails.html" class="UserLink">
                        <p class="lintpheight">
                            Job Title : Mobile development engineer
                        </p>
                        <p class="lintpheight">
                            Company Name : Apple
                        </p>
                        <p class="lintpheight">
                            Work experience : 3 years
                        </p>
                        <p class="lintpheight">
                            Salary : $ 1000 ~ $ 2000
                            <a href="#" style="position: absolute;right: 40px;"><img src="/Public/Web/web/img/04_jobs/jobs_zwlb_m_icon_closed.png"></a>
                        </p>
                    </a>
                </div>
                <div class="UserBox">
                    <a href="JobDetails.html" class="UserLink">
                        <p class="lintpheight">
                            Job Title : Mobile development engineer
                        </p>
                        <p class="lintpheight">
                            Company Name : Apple
                        </p>
                        <p class="lintpheight">
                            Work experience : 3 years
                        </p>
                        <p class="lintpheight">
                            Salary : $ 1000 ~ $ 2000
                            <a href="#" style="position: absolute;right: 40px;"><img src="/Public/Web/web/img/04_jobs/jobs_zwlb_m_icon_deleted.png"></a>
                        </p>
                    </a>
                </div>
                <div class="UserBox">
                    <a href="JobDetails.html" class="UserLink">
                        <p class="lintpheight">
                            Job Title : Mobile development engineer
                        </p>
                        <p class="lintpheight">
                            Company Name : Apple
                        </p>
                        <p class="lintpheight">
                            Work experience : 3 years
                        </p>
                        <p class="lintpheight">
                            Salary : $ 1000 ~ $ 2000
                            <a href="PostDeliveryRecord.html" style="position: absolute;right: 150px;"><img src="/Public/Web/web/img/04_jobs/jobs_zwlb_jl_icon_deliveryrecord.png"></a>
                            <a href="#" style="position: absolute;right: 110px;"><img src="/Public/Web/web/img/04_jobs/jobs_zwlb_m_icon_pj.png"></a>
                            <a href="#" style="position: absolute;right: 70px;"><img src="/Public/Web/web/img/04_jobs/jobs_zwlb_m_icon_close.png"></a>
                            <a href="#" style="position: absolute;right: 40px;"><img src="/Public/Web/web/img/04_jobs/jobs_zwlb_m_icon_del.png"></a>
                        </p>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="container" id="NumberOfPagesContainer">
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
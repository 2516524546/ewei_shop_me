<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Personal Center</title>
    <meta name="viewport" content="width=device-width, initial-scale=0 user-scalable=no, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="/Public/Web/web/css/register.css">
    <link rel="stylesheet" href="/Public/Web/web/css/Donation.css">
    <link rel="stylesheet" href="/Public/Web/web/css/AcademicGroups.css">
    <link rel="stylesheet" href="/Public/Web/web/css/GroupDetails.css">
    <link rel="stylesheet" href="/Public/Web/js/lib/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Public/Web/js/lib/bootstrap/dist/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="/Public/Web/js/lib/bootstrap/dist/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="/Public/Web/js/lib/layui/dist/css/layui.css">
    <link rel="stylesheet" href="/Public/Web/web/css/PersonalCenter.css">
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
            <cite class="Icons"></cite>
            <a href="<?php echo U('Index/Index/index');?>" class="crumbsa">
                <img src="/Public/Web/web/img/common_dh_icon_home.png" alt="">
            </a>
        </div>
    
    <!-- personal Center content -->
    <div class="container">
    <div class="personal_content">
        <!-- personal Center title -->
        <div class="personal_title">
            <div class="title_back_img">
                <img src="/Public/Web/web/img/06_gerenzhongxin/paint.png" alt="">
            </div>
            <div class="P_title_pic">
                <img src="<?php if($userone["user_icon"]): ?>./Uploads/<?php echo ($userone['user_icon']); else: ?>/Public/Web/web/img/01_shouye/UserPic.png<?php endif; ?>" alt="">
            </div>
            <div class="P_title_name">
                <?php echo ($userone['user_name']); ?>
                    <div class="P_title_icon">
                        <img src="<?php if($userone["user_sex"] == 2): ?>/Public/Web/web/img/female.png<?php else: ?>/Public/Web/web/img/male.png<?php endif; ?>" alt="">
                    </div>
            </div>
            <div class="P_title_lifeMaxim">
                      
                    <span class="liftMaxim_title">Signature :</span>  
                    <span class="liftMaxim_content"><?php echo ($userone['user_signature']); ?></span>
            </div>
            <div class="P_title_FaA">
                <div class="FaA_item">
                    <a href="FollowList.html">
                        <div class="FaA_num"><?php echo ($userone['user_concerns']); ?></div>
                        <div class="FaA_name">following</div>
                    </a>
                </div>
                <div class="FaA_line"></div>
                 <div class="FaA_item">
                    <a href="FansList.html">
                        <div class="FaA_num"><?php echo ($userone['user_fans']); ?></div>
                        <div class="FaA_name">Fans</div>
                    </a>
                </div>
            </div>
            <div class="P_title_friend">

                <?php if($userone["user_id"]!=$userid && !$firendone): ?><div class="friend_item" data-toggle="modal" data-target="#box1">
                    add friend
                </div><?php endif; ?>
                <?php if($userone["user_id"]!=$userid && !$concernsone): ?><div class="friend_item Friend_Follow" data-Ison="true">
                    Follow
                </div><?php endif; ?>
            </div>

            <!-- add friend -->
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
                                <p class="text-center">Do you add friend?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" data-dismiss="modal">confirm</button>
                            </div>
                        </div>
                    </div>
                </div>
        </div>

        <!-- personal Center details -->
        <div class="personal_details">
            <ul class="Personal_details_item">

                <li class="Personal_details_list">
                    <div class="list_img">
                        <img src="/Public/Web/web/img/banner/post.png" alt="">
                    </div>
                    <div class="list_content">
                        <div class="list_content_title">
                            Post : 
                        </div>
                        <div class="list_content_details">
                            <?php echo ($userone['user_notes']); ?>
                        </div>
                    </div>
                </li>

                <li class="Personal_details_list">
                    <div class="list_img">
                        <img src="/Public/Web/web/img/banner/birth.png" alt="">
                    </div>
                    <div class="list_content">
                        <div class="list_content_title">
                            Date Of Birth : 
                        </div>
                        <div class="list_content_details">
                            <?php echo ($userone['user_birth']); ?>
                        </div>
                    </div>
                </li>

                <li class="Personal_details_list">
                    <div class="list_img">
                        <img src="/Public/Web/web/img/banner/country.png" alt="">
                    </div>
                    <div class="list_content">
                        <div class="list_content_title">
                            Country : 
                        </div>
                        <div class="list_content_details">
                            <?php echo ($userone['user_country']); ?>
                        </div>
                    </div>
                </li>

                <li class="Personal_details_list">
                    <div class="list_img">
                        <img src="/Public/Web/web/img/banner/mail.png" alt="">
                    </div>
                    <div class="list_content">
                        <div class="list_content_title">
                            Mailbox : 
                        </div>
                        <div class="list_content_details">
                            <?php echo ($userone['user_mail']); ?>
                        </div>
                    </div>
                </li>

                <li class="Personal_details_list">
                    <div class="list_img">
                        <img src="/Public/Web/web/img/banner/time.png" alt="">
                    </div>
                    <div class="list_content">
                        <div class="list_content_title">
                            Registration Time : 
                        </div>
                        <div class="list_content_details">
                            <?php echo ($userone['user_logintime']); ?>
                        </div>
                    </div>
                </li>

                <li class="Personal_details_list">
                    <div class="list_img">
                        <img src="/Public/Web/web/img/banner/city.png" alt="">
                    </div>
                    <div class="list_content">
                        <div class="list_content_title">
                            City : 
                        </div>
                        <div class="list_content_details">
                            <?php echo ($userone['user_city']); ?>
                        </div>
                    </div>
                </li>

            </ul>
        </div>
    </div>
</div>

    <!-- Group list 群列表 sater -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="LatestContentContainer">
                    <div class="TitleSearch">
                        <h4 class="h4">Post</h4>
                    </div>
                    <div class="LatestContainer">
                        <div class="layui-tab">
                        	<div class="layui-row layui-col-space10">
	                            <div class=" layui-col-md8 layui-col-space10 btnlist">
	                            	<ul class="layui-tab-title layui-col-space10">
	                               		<li class="layui-this">All</li>
										<li>Post</li>
										<li>Q&A</li>
										<li>Resources </li>
	                            	</ul>
	                            </div>
                        	</div>
                            <div class="layui-tab-content">
                                <div class="layui-tab-item layui-show">
                                    <table class="layui-table PostTable" lay-skin="line">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <a href="homepagePost.html" style="text-decoration: none;">
                                                        <span class="WithNumber">
                                                            <span class="WithNumbers">18</span>
                                                            <img class="WithNumberImg" src="/Public/Web/web/img/02_interest/interest_qxx_pic_ups.png">
                                                        </span>
                                                        <span>
                                                            <img src="/Public/Web/web/img/02_interest/Todoist.png">
                                                        </span>
                                                    </a>
                                                </td>
                                                <td class="NameBox">
                                                        QuestionAnswerDetails.html
                                                    <a href="homepagePost.html" style="text-decoration: none;">
                                                        <span class="TopicNames">#Topic Name#</span> Topic Title
                                                    </a>
                                                </td>
                                                <td class="NameIcom">
                                                    <img src="/Public/Web/web/img/02_interest/interest_qxx_icon_top.png">
                                                    <img src="/Public/Web/web/img/02_interest/interest_qxx_icon_jing.png">
                                                </td>
                                                <td class="text-right">
                                                    <p>1 min</p>
                                                    <p>
                                                        <img src="/Public/Web/web/img/02_interest/interest_qxx_icon_pl.png">888
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="homepagePostvideoDetails.html" style="text-decoration: none;">
                                                        <span class="WithNumber">
                                                            <span class="WithNumbers">18</span>
                                                            <img class="WithNumberImg" src="/Public/Web/web/img/02_interest/interest_qxx_pic_ups.png">
                                                        </span>
                                                        <span>
                                                            <img src="/Public/Web/web/img/02_interest/Todoist.png">
                                                        </span>
                                                    </a>
                                                </td>
                                                <td colspan="2">
                                                    <a href="homepagePostVideoDetails.html" style="text-decoration: none;">
                                                        <span class="TopicNames">#Topic Name#</span> Topic Title
                                                    </a>
                                                </td>
                                                <td class="text-right">
                                                    <p>1 min</p>
                                                    <p>
                                                        <img src="/Public/Web/web/img/02_interest/interest_qxx_icon_pl.png">888
                                                    </p>
                                                </td>
                                            </tr>
                                             <tr>
                                                <td>
                                                    <a href="homepageResourceDetails.html" style="text-decoration: none;">
                                                        <span class="WithNumber">
                                                            <span class="WithNumbers">18</span>
                                                            <img class="WithNumberImg" src="/Public/Web/web/img/02_interest/interest_qxx_pic_ups.png">
                                                        </span>
                                                        <span>
                                                            <img src="/Public/Web/web/img/02_interest/Todoist.png">
                                                        </span>
                                                    </a>
                                                </td>
                                                <td colspan="2">
                                                    <a href="homepageResourceDetails.html" style="text-decoration: none;">
                                                        <span class="TopicNames">#Topic Name#</span> Topic Title
                                                    </a>
                                                </td>
                                                <td class="text-right">
                                                    <p>1 min</p>
                                                    <p>
                                                        <img src="/Public/Web/web/img/02_interest/interest_qxx_icon_pl.png">888
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="WithNumber">
                                                        <span class="WithNumbers">18</span>
                                                    <img class="WithNumberImg" src="/Public/Web/web/img/02_interest/interest_qxx_pic_ups.png">
                                                    </span>
                                                    <span><img src="/Public/Web/web/img/02_interest/Todoist.png"></span>
                                                </td>
                                                <td colspan="2">
                                                    <span class="TopicNames">#Topic Name#</span> Topic Title
                                                </td>
                                                <td class="text-right">
                                                    <p>1 min</p>
                                                    <p>
                                                        <img src="/Public/Web/web/img/02_interest/interest_qxx_icon_pl.png">888
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="WithNumber">
                                                        <span class="WithNumbers">18</span>
                                                    <img class="WithNumberImg" src="/Public/Web/web/img/02_interest/interest_qxx_pic_ups.png">
                                                    </span>
                                                    <span><img src="img/02_interest/Todoist.png"></span>
                                                </td>
                                                <td colspan="2">
                                                    <span class="TopicNames">#Topic Name#</span> Topic Title
                                                </td>
                                                <td class="text-right">
                                                    <p>1 min</p>
                                                    <p>
                                                        <img src="img/02_interest/interest_qxx_icon_pl.png">888
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="WithNumber">
                                                        <span class="WithNumbers">18</span>
                                                    <img class="WithNumberImg" src="img/02_interest/interest_qxx_pic_ups.png">
                                                    </span>
                                                    <span><img src="img/02_interest/Todoist.png"></span>
                                                </td>
                                                <td colspan="2">
                                                    <span class="TopicNames">#Topic Name#</span> Topic Title
                                                </td>
                                                <td class="text-right">
                                                    <p>1 min</p>
                                                    <p>
                                                        <img src="img/02_interest/interest_qxx_icon_pl.png">888
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="WithNumber">
                                                        <span class="WithNumbers">18</span>
                                                    <img class="WithNumberImg" src="img/02_interest/interest_qxx_pic_ups.png">
                                                    </span>
                                                    <span><img src="img/02_interest/Todoist.png"></span>
                                                </td>
                                                <td colspan="2">
                                                    <span class="TopicNames">#Topic Name#</span> Topic Title
                                                </td>
                                                <td class="text-right">
                                                    <p>1 min</p>
                                                    <p>
                                                        <img src="img/02_interest/interest_qxx_icon_pl.png">888
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="WithNumber">
                                                        <span class="WithNumbers">18</span>
                                                    <img class="WithNumberImg" src="img/02_interest/interest_qxx_pic_ups.png">
                                                    </span>
                                                    <span><img src="img/02_interest/Todoist.png"></span>
                                                </td>
                                                <td colspan="2">
                                                    <span class="TopicNames">#Topic Name#</span> Topic Title
                                                </td>
                                                <td class="text-right">
                                                    <p>1 min</p>
                                                    <p>
                                                        <img src="img/02_interest/interest_qxx_icon_pl.png">888
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="WithNumber">
                                                        <span class="WithNumbers">18</span>
                                                    <img class="WithNumberImg" src="img/02_interest/interest_qxx_pic_ups.png">
                                                    </span>
                                                    <span><img src="img/02_interest/Todoist.png"></span>
                                                </td>
                                                <td colspan="2">
                                                    <span class="TopicNames">#Topic Name#</span> Topic Title
                                                </td>
                                                <td class="text-right">
                                                    <p>1 min</p>
                                                    <p>
                                                        <img src="img/02_interest/interest_qxx_icon_pl.png">888
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="WithNumber">
                                                        <span class="WithNumbers">18</span>
                                                    <img class="WithNumberImg" src="img/02_interest/interest_qxx_pic_ups.png">
                                                    </span>
                                                    <span><img src="img/02_interest/Todoist.png"></span>
                                                </td>
                                                <td colspan="2">
                                                    <span class="TopicNames">#Topic Name#</span> Topic Title
                                                </td>
                                                <td class="text-right">
                                                    <p>1 min</p>
                                                    <p>
                                                        <img src="img/02_interest/interest_qxx_icon_pl.png">888
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="WithNumber">
                                                        <span class="WithNumbers">18</span>
                                                    <img class="WithNumberImg" src="img/02_interest/interest_qxx_pic_ups.png">
                                                    </span>
                                                    <span><img src="img/02_interest/Todoist.png"></span>
                                                </td>
                                                <td colspan="2">
                                                    <span class="TopicNames">#Topic Name#</span> Topic Title
                                                </td>
                                                <td class="text-right">
                                                    <p>1 min</p>
                                                    <p>
                                                        <img src="img/02_interest/interest_qxx_icon_pl.png">888
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="WithNumber">
                                                        <span class="WithNumbers">18</span>
                                                    <img class="WithNumberImg" src="img/02_interest/interest_qxx_pic_ups.png">
                                                    </span>
                                                    <span><img src="img/02_interest/Todoist.png"></span>
                                                </td>
                                                <td colspan="2">
                                                    <span class="TopicNames">#Topic Name#</span> Topic Title
                                                </td>
                                                <td class="text-right">
                                                    <p>1 min</p>
                                                    <p>
                                                        <img src="img/02_interest/interest_qxx_icon_pl.png">888
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="WithNumber">
                                                        <span class="WithNumbers">18</span>
                                                    <img class="WithNumberImg" src="img/02_interest/interest_qxx_pic_ups.png">
                                                    </span>
                                                    <span><img src="img/02_interest/Todoist.png"></span>
                                                </td>
                                                <td colspan="2">
                                                    <span class="TopicNames">#Topic Name#</span> Topic Title
                                                </td>
                                                <td class="text-right">
                                                    <p>1 min</p>
                                                    <p>
                                                        <img src="img/02_interest/interest_qxx_icon_pl.png">888
                                                    </p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="layui-tab-item">
                                    <table class="layui-table PostTable" lay-skin="line">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <a href="homepagePost.html" style="text-decoration: none;">
                                                        <span class="WithNumber">
                                                            <span class="WithNumbers">18</span>
                                                            <img class="WithNumberImg" src="img/02_interest/interest_qxx_pic_ups.png">
                                                        </span>
                                                        <span>
                                                            <img src="img/02_interest/Todoist.png">
                                                        </span>
                                                    </a>
                                                </td>
                                                <td class="NameBox">
                                                    <a href="homepagePost.html" style="text-decoration: none;">
                                                        Topic Title
                                                    </a>
                                                </td>
                                                <td class="NameIcom">
                                                    <img src="img/02_interest/interest_qxx_icon_top.png">
                                                    <img src="img/02_interest/interest_qxx_icon_jing.png">
                                                </td>
                                                <td class="text-right">
                                                    <p>1 min</p>
                                                    <p>
                                                        <img src="img/02_interest/interest_qxx_icon_xs.png">888
                                                        <img src="img/02_interest/interest_qxx_icon_pl.png">888
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="WithNumber">
                                                        <span class="WithNumbers">18</span>
                                                    <img class="WithNumberImg" src="img/02_interest/interest_qxx_pic_ups.png">
                                                    </span>
                                                    <span><img src="img/02_interest/Todoist.png"></span>
                                                </td>
                                                <td colspan="2">
                                                    Topic Title
                                                </td>
                                                <td class="text-right">
                                                    <p>1 min</p>
                                                    <p>
                                                        <img src="img/02_interest/interest_qxx_icon_xs.png">888
                                                        <img src="img/02_interest/interest_qxx_icon_pl.png">888
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="WithNumber">
                                                        <span class="WithNumbers">18</span>
                                                    <img class="WithNumberImg" src="img/02_interest/interest_qxx_pic_ups.png">
                                                    </span>
                                                    <span><img src="img/02_interest/Todoist.png"></span>
                                                </td>
                                                <td colspan="2">
                                                    Topic Title
                                                </td>
                                                <td class="text-right">
                                                    <p>1 min</p>
                                                    <p>
                                                        <img src="img/02_interest/interest_qxx_icon_xs.png">888
                                                        <img src="img/02_interest/interest_qxx_icon_pl.png">888
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="WithNumber">
                                                        <span class="WithNumbers">18</span>
                                                    <img class="WithNumberImg" src="img/02_interest/interest_qxx_pic_ups.png">
                                                    </span>
                                                    <span><img src="img/02_interest/Todoist.png"></span>
                                                </td>
                                                <td colspan="2">
                                                    Topic Title
                                                </td>
                                                <td class="text-right">
                                                    <p>1 min</p>
                                                    <p>
                                                        <img src="img/02_interest/interest_qxx_icon_xs.png">888
                                                        <img src="img/02_interest/interest_qxx_icon_pl.png">888
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="WithNumber">
                                                        <span class="WithNumbers">18</span>
                                                    <img class="WithNumberImg" src="img/02_interest/interest_qxx_pic_ups.png">
                                                    </span>
                                                    <span><img src="img/02_interest/Todoist.png"></span>
                                                </td>
                                                <td colspan="2">
                                                    Topic Title
                                                </td>
                                                <td class="text-right">
                                                    <p>1 min</p>
                                                    <p>
                                                        <img src="img/02_interest/interest_qxx_icon_xs.png">888
                                                        <img src="img/02_interest/interest_qxx_icon_pl.png">888
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="WithNumber">
                                                        <span class="WithNumbers">18</span>
                                                    <img class="WithNumberImg" src="img/02_interest/interest_qxx_pic_ups.png">
                                                    </span>
                                                    <span><img src="img/02_interest/Todoist.png"></span>
                                                </td>
                                                <td colspan="2">
                                                    Topic Title
                                                </td>
                                                <td class="text-right">
                                                    <p>1 min</p>
                                                    <p>
                                                        <img src="img/02_interest/interest_qxx_icon_xs.png">888
                                                        <img src="img/02_interest/interest_qxx_icon_pl.png">888
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="WithNumber">
                                                        <span class="WithNumbers">18</span>
                                                    <img class="WithNumberImg" src="img/02_interest/interest_qxx_pic_ups.png">
                                                    </span>
                                                    <span><img src="img/02_interest/Todoist.png"></span>
                                                </td>
                                                <td colspan="2">
                                                    Topic Title
                                                </td>
                                                <td class="text-right">
                                                    <p>1 min</p>
                                                    <p>
                                                        <img src="img/02_interest/interest_qxx_icon_xs.png">888
                                                        <img src="img/02_interest/interest_qxx_icon_pl.png">888
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="WithNumber">
                                                        <span class="WithNumbers">18</span>
                                                    <img class="WithNumberImg" src="img/02_interest/interest_qxx_pic_ups.png">
                                                    </span>
                                                    <span><img src="img/02_interest/Todoist.png"></span>
                                                </td>
                                                <td colspan="2">
                                                    Topic Title
                                                </td>
                                                <td class="text-right">
                                                    <p>1 min</p>
                                                    <p>
                                                        <img src="img/02_interest/interest_qxx_icon_xs.png">888
                                                        <img src="img/02_interest/interest_qxx_icon_pl.png">888
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="WithNumber">
                                                        <span class="WithNumbers">18</span>
                                                    <img class="WithNumberImg" src="img/02_interest/interest_qxx_pic_ups.png">
                                                    </span>
                                                    <span><img src="img/02_interest/Todoist.png"></span>
                                                </td>
                                                <td colspan="2">
                                                    Topic Title
                                                </td>
                                                <td class="text-right">
                                                    <p>1 min</p>
                                                    <p>
                                                        <img src="img/02_interest/interest_qxx_icon_xs.png">888
                                                        <img src="img/02_interest/interest_qxx_icon_pl.png">888
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="WithNumber">
                                                        <span class="WithNumbers">18</span>
                                                    <img class="WithNumberImg" src="img/02_interest/interest_qxx_pic_ups.png">
                                                    </span>
                                                    <span><img src="img/02_interest/Todoist.png"></span>
                                                </td>
                                                <td colspan="2">
                                                    Topic Title
                                                </td>
                                                <td class="text-right">
                                                    <p>1 min</p>
                                                    <p>
                                                        <img src="img/02_interest/interest_qxx_icon_xs.png">888
                                                        <img src="img/02_interest/interest_qxx_icon_pl.png">888
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="WithNumber">
                                                        <span class="WithNumbers">18</span>
                                                    <img class="WithNumberImg" src="img/02_interest/interest_qxx_pic_ups.png">
                                                    </span>
                                                    <span><img src="img/02_interest/Todoist.png"></span>
                                                </td>
                                                <td colspan="2">
                                                    Topic Title
                                                </td>
                                                <td class="text-right">
                                                    <p>1 min</p>
                                                    <p>
                                                        <img src="img/02_interest/interest_qxx_icon_xs.png">888
                                                        <img src="img/02_interest/interest_qxx_icon_pl.png">888
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="WithNumber">
                                                        <span class="WithNumbers">18</span>
                                                    <img class="WithNumberImg" src="img/02_interest/interest_qxx_pic_ups.png">
                                                    </span>
                                                    <span><img src="img/02_interest/Todoist.png"></span>
                                                </td>
                                                <td colspan="2">
                                                    Topic Title
                                                </td>
                                                <td class="text-right">
                                                    <p>1 min</p>
                                                    <p>
                                                        <img src="img/02_interest/interest_qxx_icon_xs.png">888
                                                        <img src="img/02_interest/interest_qxx_icon_pl.png">888
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="WithNumber">
                                                        <span class="WithNumbers">18</span>
                                                    <img class="WithNumberImg" src="img/02_interest/interest_qxx_pic_ups.png">
                                                    </span>
                                                    <span><img src="img/02_interest/Todoist.png"></span>
                                                </td>
                                                <td colspan="2">
                                                    Topic Title
                                                </td>
                                                <td class="text-right">
                                                    <p>1 min</p>
                                                    <p>
                                                        <img src="img/02_interest/interest_qxx_icon_xs.png">888
                                                        <img src="img/02_interest/interest_qxx_icon_pl.png">888
                                                    </p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="layui-tab-item">
                                    <table class="layui-table PostTable" lay-skin="line">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <a href="homepageQADetails.html" style="text-decoration: none;">
                                                        <span class="WithNumber">
                                                            <span class="WithNumbers">18</span>
                                                            <img class="WithNumberImg" src="img/02_interest/interest_qxx_pic_ups.png">
                                                        </span>
                                                        <span>
                                                            <img src="img/02_interest/Todoist.png">
                                                        </span>
                                                    </a>
                                                </td>
                                                <td class="NameBox">
                                                    <a href="homepageQADetails.html" style="text-decoration: none;">
                                                        Topic Title
                                                    </a>
                                                </td>
                                                <td class="NameIcom">
                                                    <img src="img/02_interest/interest_qxx_icon_top.png">
                                                    <img src="img/02_interest/interest_qxx_icon_jing.png">
                                                </td>
                                                <td class="text-right">
                                                    <p>1 min</p>
                                                    <p>
                                                        <img src="img/02_interest/interest_qxx_icon_download.png">888
                                                        <img src="img/02_interest/interest_qxx_icon_pl.png">888
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="WithNumber">
                                                        <span class="WithNumbers">18</span>
                                                    <img class="WithNumberImg" src="img/02_interest/interest_qxx_pic_ups.png">
                                                    </span>
                                                    <span><img src="img/02_interest/Todoist.png"></span>
                                                </td>
                                                <td colspan="2">
                                                    Topic Title
                                                </td>
                                                <td class="text-right">
                                                    <p>1 min</p>
                                                    <p>
                                                        <img src="img/02_interest/interest_qxx_icon_download.png">888
                                                        <img src="img/02_interest/interest_qxx_icon_pl.png">888
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="WithNumber">
                                                        <span class="WithNumbers">18</span>
                                                    <img class="WithNumberImg" src="img/02_interest/interest_qxx_pic_ups.png">
                                                    </span>
                                                    <span><img src="img/02_interest/Todoist.png"></span>
                                                </td>
                                                <td colspan="2">
                                                    Topic Title
                                                </td>
                                                <td class="text-right">
                                                    <p>1 min</p>
                                                    <p>
                                                        <img src="img/02_interest/interest_qxx_icon_download.png">888
                                                        <img src="img/02_interest/interest_qxx_icon_pl.png">888
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="WithNumber">
                                                        <span class="WithNumbers">18</span>
                                                    <img class="WithNumberImg" src="img/02_interest/interest_qxx_pic_ups.png">
                                                    </span>
                                                    <span><img src="img/02_interest/Todoist.png"></span>
                                                </td>
                                                <td colspan="2">
                                                    Topic Title
                                                </td>
                                                <td class="text-right">
                                                    <p>1 min</p>
                                                    <p>
                                                        <img src="img/02_interest/interest_qxx_icon_download.png">888
                                                        <img src="img/02_interest/interest_qxx_icon_pl.png">888
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="WithNumber">
                                                        <span class="WithNumbers">18</span>
                                                    <img class="WithNumberImg" src="img/02_interest/interest_qxx_pic_ups.png">
                                                    </span>
                                                    <span><img src="img/02_interest/Todoist.png"></span>
                                                </td>
                                                <td colspan="2">
                                                    Topic Title
                                                </td>
                                                <td class="text-right">
                                                    <p>1 min</p>
                                                    <p>
                                                        <img src="img/02_interest/interest_qxx_icon_download.png">888
                                                        <img src="img/02_interest/interest_qxx_icon_pl.png">888
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="WithNumber">
                                                        <span class="WithNumbers">18</span>
                                                    <img class="WithNumberImg" src="img/02_interest/interest_qxx_pic_ups.png">
                                                    </span>
                                                    <span><img src="img/02_interest/Todoist.png"></span>
                                                </td>
                                                <td colspan="2">
                                                    Topic Title
                                                </td>
                                                <td class="text-right">
                                                    <p>1 min</p>
                                                    <p>
                                                        <img src="img/02_interest/interest_qxx_icon_download.png">888
                                                        <img src="img/02_interest/interest_qxx_icon_pl.png">888
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="WithNumber">
                                                        <span class="WithNumbers">18</span>
                                                    <img class="WithNumberImg" src="img/02_interest/interest_qxx_pic_ups.png">
                                                    </span>
                                                    <span><img src="img/02_interest/Todoist.png"></span>
                                                </td>
                                                <td colspan="2">
                                                    Topic Title
                                                </td>
                                                <td class="text-right">
                                                    <p>1 min</p>
                                                    <p>
                                                        <img src="img/02_interest/interest_qxx_icon_download.png">888
                                                        <img src="img/02_interest/interest_qxx_icon_pl.png">888
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="WithNumber">
                                                        <span class="WithNumbers">18</span>
                                                    <img class="WithNumberImg" src="img/02_interest/interest_qxx_pic_ups.png">
                                                    </span>
                                                    <span><img src="img/02_interest/Todoist.png"></span>
                                                </td>
                                                <td colspan="2">
                                                    Topic Title
                                                </td>
                                                <td class="text-right">
                                                    <p>1 min</p>
                                                    <p>
                                                        <img src="img/02_interest/interest_qxx_icon_download.png">888
                                                        <img src="img/02_interest/interest_qxx_icon_pl.png">888
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="WithNumber">
                                                        <span class="WithNumbers">18</span>
                                                    <img class="WithNumberImg" src="img/02_interest/interest_qxx_pic_ups.png">
                                                    </span>
                                                    <span><img src="img/02_interest/Todoist.png"></span>
                                                </td>
                                                <td colspan="2">
                                                    Topic Title
                                                </td>
                                                <td class="text-right">
                                                    <p>1 min</p>
                                                    <p>
                                                        <img src="img/02_interest/interest_qxx_icon_download.png">888
                                                        <img src="img/02_interest/interest_qxx_icon_pl.png">888
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="WithNumber">
                                                        <span class="WithNumbers">18</span>
                                                    <img class="WithNumberImg" src="img/02_interest/interest_qxx_pic_ups.png">
                                                    </span>
                                                    <span><img src="img/02_interest/Todoist.png"></span>
                                                </td>
                                                <td colspan="2">
                                                    Topic Title
                                                </td>
                                                <td class="text-right">
                                                    <p>1 min</p>
                                                    <p>
                                                        <img src="img/02_interest/interest_qxx_icon_download.png">888
                                                        <img src="img/02_interest/interest_qxx_icon_pl.png">888
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="WithNumber">
                                                        <span class="WithNumbers">18</span>
                                                    <img class="WithNumberImg" src="img/02_interest/interest_qxx_pic_ups.png">
                                                    </span>
                                                    <span><img src="img/02_interest/Todoist.png"></span>
                                                </td>
                                                <td colspan="2">
                                                    Topic Title
                                                </td>
                                                <td class="text-right">
                                                    <p>1 min</p>
                                                    <p>
                                                        <img src="img/02_interest/interest_qxx_icon_download.png">888
                                                        <img src="img/02_interest/interest_qxx_icon_pl.png">888
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="WithNumber">
                                                        <span class="WithNumbers">18</span>
                                                    <img class="WithNumberImg" src="img/02_interest/interest_qxx_pic_ups.png">
                                                    </span>
                                                    <span><img src="img/02_interest/Todoist.png"></span>
                                                </td>
                                                <td colspan="2">
                                                    Topic Title
                                                </td>
                                                <td class="text-right">
                                                    <p>1 min</p>
                                                    <p>
                                                        <img src="img/02_interest/interest_qxx_icon_download.png">888
                                                        <img src="img/02_interest/interest_qxx_icon_pl.png">888
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="WithNumber">
                                                        <span class="WithNumbers">18</span>
                                                    <img class="WithNumberImg" src="img/02_interest/interest_qxx_pic_ups.png">
                                                    </span>
                                                    <span><img src="img/02_interest/Todoist.png"></span>
                                                </td>
                                                <td colspan="2">
                                                    Topic Title
                                                </td>
                                                <td class="text-right">
                                                    <p>1 min</p>
                                                    <p>
                                                        <img src="img/02_interest/interest_qxx_icon_download.png">888
                                                        <img src="img/02_interest/interest_qxx_icon_pl.png">888
                                                    </p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="layui-tab-item">
                                        <table class="layui-table PostTable" lay-skin="line">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <a href="homepageResourceDetails.html" style="text-decoration: none;">
                                                            <span class="WithNumber">
                                                                <span class="WithNumbers">18</span>
                                                                <img class="WithNumberImg" src="img/02_interest/interest_qxx_pic_ups.png">
                                                            </span>
                                                            <span>
                                                                <img src="img/02_interest/Todoist.png">
                                                            </span>
                                                        </a>
                                                    </td>
                                                    <td class="NameBox">
                                                        <a href="homepageResourceDetails.html" style="text-decoration: none;">
                                                            Topic Title
                                                        </a>
                                                    </td>
                                                    <td class="NameIcom">
                                                        <img src="img/02_interest/interest_qxx_icon_top.png">
                                                        <img src="img/02_interest/interest_qxx_icon_jing.png">
                                                    </td>
                                                    <td class="text-right">
                                                        <p>1 min</p>
                                                        <p>
                                                            <img src="img/02_interest/interest_qxx_icon_download.png">888
                                                            <img src="img/02_interest/interest_qxx_icon_pl.png">888
                                                        </p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <span class="WithNumber">
                                                            <span class="WithNumbers">18</span>
                                                        <img class="WithNumberImg" src="img/02_interest/interest_qxx_pic_ups.png">
                                                        </span>
                                                        <span><img src="img/02_interest/Todoist.png"></span>
                                                    </td>
                                                    <td colspan="2">
                                                        Topic Title
                                                    </td>
                                                    <td class="text-right">
                                                        <p>1 min</p>
                                                        <p>
                                                            <img src="img/02_interest/interest_qxx_icon_download.png">888
                                                            <img src="img/02_interest/interest_qxx_icon_pl.png">888
                                                        </p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <span class="WithNumber">
                                                            <span class="WithNumbers">18</span>
                                                        <img class="WithNumberImg" src="img/02_interest/interest_qxx_pic_ups.png">
                                                        </span>
                                                        <span><img src="img/02_interest/Todoist.png"></span>
                                                    </td>
                                                    <td colspan="2">
                                                        Topic Title
                                                    </td>
                                                    <td class="text-right">
                                                        <p>1 min</p>
                                                        <p>
                                                            <img src="img/02_interest/interest_qxx_icon_download.png">888
                                                            <img src="img/02_interest/interest_qxx_icon_pl.png">888
                                                        </p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <span class="WithNumber">
                                                            <span class="WithNumbers">18</span>
                                                        <img class="WithNumberImg" src="img/02_interest/interest_qxx_pic_ups.png">
                                                        </span>
                                                        <span><img src="img/02_interest/Todoist.png"></span>
                                                    </td>
                                                    <td colspan="2">
                                                        Topic Title
                                                    </td>
                                                    <td class="text-right">
                                                        <p>1 min</p>
                                                        <p>
                                                            <img src="img/02_interest/interest_qxx_icon_download.png">888
                                                            <img src="img/02_interest/interest_qxx_icon_pl.png">888
                                                        </p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <span class="WithNumber">
                                                            <span class="WithNumbers">18</span>
                                                        <img class="WithNumberImg" src="img/02_interest/interest_qxx_pic_ups.png">
                                                        </span>
                                                        <span><img src="img/02_interest/Todoist.png"></span>
                                                    </td>
                                                    <td colspan="2">
                                                        Topic Title
                                                    </td>
                                                    <td class="text-right">
                                                        <p>1 min</p>
                                                        <p>
                                                            <img src="img/02_interest/interest_qxx_icon_download.png">888
                                                            <img src="img/02_interest/interest_qxx_icon_pl.png">888
                                                        </p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <span class="WithNumber">
                                                            <span class="WithNumbers">18</span>
                                                        <img class="WithNumberImg" src="img/02_interest/interest_qxx_pic_ups.png">
                                                        </span>
                                                        <span><img src="img/02_interest/Todoist.png"></span>
                                                    </td>
                                                    <td colspan="2">
                                                        Topic Title
                                                    </td>
                                                    <td class="text-right">
                                                        <p>1 min</p>
                                                        <p>
                                                            <img src="img/02_interest/interest_qxx_icon_download.png">888
                                                            <img src="img/02_interest/interest_qxx_icon_pl.png">888
                                                        </p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <span class="WithNumber">
                                                            <span class="WithNumbers">18</span>
                                                        <img class="WithNumberImg" src="img/02_interest/interest_qxx_pic_ups.png">
                                                        </span>
                                                        <span><img src="img/02_interest/Todoist.png"></span>
                                                    </td>
                                                    <td colspan="2">
                                                        Topic Title
                                                    </td>
                                                    <td class="text-right">
                                                        <p>1 min</p>
                                                        <p>
                                                            <img src="img/02_interest/interest_qxx_icon_download.png">888
                                                            <img src="img/02_interest/interest_qxx_icon_pl.png">888
                                                        </p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <span class="WithNumber">
                                                            <span class="WithNumbers">18</span>
                                                        <img class="WithNumberImg" src="img/02_interest/interest_qxx_pic_ups.png">
                                                        </span>
                                                        <span><img src="img/02_interest/Todoist.png"></span>
                                                    </td>
                                                    <td colspan="2">
                                                        Topic Title
                                                    </td>
                                                    <td class="text-right">
                                                        <p>1 min</p>
                                                        <p>
                                                            <img src="img/02_interest/interest_qxx_icon_download.png">888
                                                            <img src="img/02_interest/interest_qxx_icon_pl.png">888
                                                        </p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <span class="WithNumber">
                                                            <span class="WithNumbers">18</span>
                                                        <img class="WithNumberImg" src="img/02_interest/interest_qxx_pic_ups.png">
                                                        </span>
                                                        <span><img src="img/02_interest/Todoist.png"></span>
                                                    </td>
                                                    <td colspan="2">
                                                        Topic Title
                                                    </td>
                                                    <td class="text-right">
                                                        <p>1 min</p>
                                                        <p>
                                                            <img src="img/02_interest/interest_qxx_icon_download.png">888
                                                            <img src="img/02_interest/interest_qxx_icon_pl.png">888
                                                        </p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <span class="WithNumber">
                                                            <span class="WithNumbers">18</span>
                                                        <img class="WithNumberImg" src="img/02_interest/interest_qxx_pic_ups.png">
                                                        </span>
                                                        <span><img src="img/02_interest/Todoist.png"></span>
                                                    </td>
                                                    <td colspan="2">
                                                        Topic Title
                                                    </td>
                                                    <td class="text-right">
                                                        <p>1 min</p>
                                                        <p>
                                                            <img src="img/02_interest/interest_qxx_icon_download.png">888
                                                            <img src="img/02_interest/interest_qxx_icon_pl.png">888
                                                        </p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <span class="WithNumber">
                                                            <span class="WithNumbers">18</span>
                                                        <img class="WithNumberImg" src="img/02_interest/interest_qxx_pic_ups.png">
                                                        </span>
                                                        <span><img src="img/02_interest/Todoist.png"></span>
                                                    </td>
                                                    <td colspan="2">
                                                        Topic Title
                                                    </td>
                                                    <td class="text-right">
                                                        <p>1 min</p>
                                                        <p>
                                                            <img src="img/02_interest/interest_qxx_icon_download.png">888
                                                            <img src="img/02_interest/interest_qxx_icon_pl.png">888
                                                        </p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <span class="WithNumber">
                                                            <span class="WithNumbers">18</span>
                                                        <img class="WithNumberImg" src="img/02_interest/interest_qxx_pic_ups.png">
                                                        </span>
                                                        <span><img src="img/02_interest/Todoist.png"></span>
                                                    </td>
                                                    <td colspan="2">
                                                        Topic Title
                                                    </td>
                                                    <td class="text-right">
                                                        <p>1 min</p>
                                                        <p>
                                                            <img src="img/02_interest/interest_qxx_icon_download.png">888
                                                            <img src="img/02_interest/interest_qxx_icon_pl.png">888
                                                        </p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <span class="WithNumber">
                                                            <span class="WithNumbers">18</span>
                                                        <img class="WithNumberImg" src="img/02_interest/interest_qxx_pic_ups.png">
                                                        </span>
                                                        <span><img src="img/02_interest/Todoist.png"></span>
                                                    </td>
                                                    <td colspan="2">
                                                        Topic Title
                                                    </td>
                                                    <td class="text-right">
                                                        <p>1 min</p>
                                                        <p>
                                                            <img src="img/02_interest/interest_qxx_icon_download.png">888
                                                            <img src="img/02_interest/interest_qxx_icon_pl.png">888
                                                        </p>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <!-- Group list 群列表 end -->
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
    <script src="/Public/Web/web/js/index.js"></script>
    <script src="/Public/Web/web/js/loginQuit.js"></script>
    <script>
        //注意：选项卡 依赖 element 模块，否则无法进行功能性操作
        layui.use('element', function(){
        var element = layui.element;
        
        //…
        });
    </script>
    <script>
            $(".personal_content .personal_title .P_title_friend .Friend_Follow").on("click",function(){
                if($(this).attr("data-ison")==="true"){
                    $(this).text("Followed")
                    $(this).attr("data-Ison","false")
                }else{
                    $(this).text("Follow")
                    $(this).attr("data-ison","true")
                }
            })
        </script>

<script>

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
</body>

</html>
<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Group details</title>
    <meta name="viewport" content="width=device-width, initial-scale=0 user-scalable=no, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="/Public/Web/web/css/register.css">
    <link rel="stylesheet" href="/Public/Web/web/css/Donation.css">
    <link rel="stylesheet" href="/Public/Web/web/css/AcademicGroups.css">
    <link rel="stylesheet" href="/Public/Web/js/lib/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Public/Web/js/lib/bootstrap/dist/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="/Public/Web/js/lib/bootstrap/dist/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="/Public/Web/js/lib/layui/dist/css/layui.css">
    <link rel="stylesheet" href="/Public/Web/web/css/GroupDetails.css">
    <link rel="stylesheet" href="/Public/Web//web/css/AcademicChose.css">
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
        <a href="<?php echo U('Index/Academic/academic');?>" class="crumbsa">Academic</a>
        <cite class="Icon"></cite>
        <span class="crumbsTitle">Group name</span>
    </div>
    <!-- Carousel advertising start 轮播广告 -->
    <div class="layui-carousel Banner" id="test2">
        <div carousel-item="">
            <div><img src="/Public/Web/web/img/banner.png"></div>
            <div><img src="/Public/Web/web/img/banner.png"></div>
            <div><img src="/Public/Web/web/img/banner.png"></div>
            <div><img src="/Public/Web/web/img/banner.png"></div>
            <div><img src="/Public/Web/web/img/banner.png"></div>
        </div>
    </div>
    <!-- Carousel advertising end 轮播广告 -->
    <!-- Group list 群列表 sataer -->
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="LatestContentContainer">
                    <div class="TitleSearch">
                        <h4 class="h4">Latest Content</h4>
                        <div class="SelectionContainer">
                            <input type="text" class="layui-input" id="Selectionform">
                            <a href="#" id="SelectionIcon">
                            <img src="/Public/Web/web/img/02_interest/interest_qxx_search_icon.png">
                          </a>
                        </div>
                    </div>
                    <div class="LatestContainer">
                        <div class="layui-tab">
                        	<div class="layui-row layui-col-space10">
	                            <div class=" layui-col-md8 layui-col-space10 btnlist">
	                            	<ul class="layui-tab-title layui-col-space10">
	                               		<li class="layui-this layui-btn layui-btn-radius layui-btn-xs layui-btn-normal layui-col-md4 btn_normal" >Post</li>
										<li class="layui-btn layui-btn-radius layui-btn-xs layui-btn-normal layui-col-md4 btn_normal">Q&A</li>
										<li class="layui-btn layui-btn-radius layui-btn-xs layui-btn-normal layui-col-md4 btn_normal">Resources</li>
										<li class="layui-btn layui-btn-radius layui-btn-xs layui-btn-normal layui-col-md6 btn_normal">Provide counselling</li>
										<li class="layui-btn layui-btn-radius layui-btn-xs layui-btn-normal layui-col-md6 btn_normal">Seeking counselling</li>
	                            	</ul>
	                            </div>
		                        <div class="layui-input-block More layui-col-md2">
		                            <select class="form-control" name="city" lay-verify="required">
		                                <option value="">Time sorting</option>
		                                <option value="0">1</option>
		                            </select>
		                        </div>
                        	</div>
                            <div class="layui-tab-content">
                                <div class="layui-tab-item layui-show">
                                    <table class="layui-table PostTable" lay-skin="line">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <a href="<?php echo U('Index/Academic/stickSonDetails');?>" style="text-decoration: none;">
                                                        <span class="WithNumber">
                                                            <span class="WithNumbers">18</span>
                                                            <img class="WithNumberImg" src="/Public/Web/web/img/02_interest/interest_qxx_pic_ups.png">
                                                        </span>
                                                        <span class="ImgBox">
                                                            <img src="/Public/Web/web/img/02_interest/Todoist.png">
                                                        </span>
                                                    </a>
                                                </td>
                                                <td class="NameBox">
                                                    <a href="<?php echo U('Index/Academic/stickSonDetails');?>" style="text-decoration: none;">
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
                                                    <a href="<?php echo U('Index/Academic/postVideoDetails');?>" style="text-decoration: none;">
                                                        <span class="WithNumber">
                                                            <span class="WithNumbers">18</span>
                                                            <img class="WithNumberImg" src="/Public/Web/web/img/02_interest/interest_qxx_pic_ups.png">
                                                        </span>
                                                        <span class="ImgBox">
                                                            <img src="/Public/Web/web/img/02_interest/Todoist.png">
                                                        </span>
                                                    </a>
                                                </td>
                                                <td colspan="2">
                                                    <a href="<?php echo U('Index/Academic/postVideoDetails');?>" style="text-decoration: none;">
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
                                                    <span class="ImgBox"><img src="/Public/Web/web/img/02_interest/Todoist.png"></span>
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
                                                    <span class="ImgBox"><img src="/Public/Web/web/img/02_interest/Todoist.png"></span>
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
                                                    <span class="ImgBox"><img src="/Public/Web/web/img/02_interest/Todoist.png"></span>
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
                                                    <span class="ImgBox"><img src="/Public/Web/web/img/02_interest/Todoist.png"></span>
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
                                            
                                            
                                            
                                        </tbody>
                                    </table>
                                </div>
                                <div class="layui-tab-item">
                                    <table class="layui-table PostTable" lay-skin="line">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <a href="<?php echo U('Index/Academic/questionAnswerDetails');?>" style="text-decoration: none;">
                                                        <span class="WithNumber">
                                                            <span class="WithNumbers">18</span>
                                                            <img class="WithNumberImg" src="/Public/Web/web/img/02_interest/interest_qxx_pic_ups.png">
                                                        </span>
                                                        <span class="ImgBox">
                                                            <img src="/Public/Web/web/img/02_interest/Todoist.png">
                                                        </span>
                                                    </a>
                                                </td>
                                                <td class="NameBox">
                                                    <a href="<?php echo U('Index/Academic/questionAnswerDetails');?>" style="text-decoration: none;">
                                                        Topic Title
                                                    </a>
                                                </td>
                                                <td class="NameIcom">
                                                    <img src="/Public/Web/web/img/02_interest/interest_qxx_icon_top.png">
                                                    <img src="/Public/Web/web/img/02_interest/interest_qxx_icon_jing.png">
                                                </td>
                                                <td class="text-right">
                                                    <p>1 min</p>
                                                    <p>
                                                        <img src="/Public/Web/web/img/02_interest/interest_qxx_icon_xs.png">888
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
                                                    <span class="ImgBox"><img src="/Public/Web/web/img/02_interest/Todoist.png"></span>
                                                </td>
                                                <td colspan="2">
                                                    Topic Title
                                                </td>
                                                <td class="text-right">
                                                    <p>1 min</p>
                                                    <p>
                                                        <img src="/Public/Web/web/img/02_interest/interest_qxx_icon_xs.png">888
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
                                                    <span class="ImgBox"><img src="/Public/Web/web/img/02_interest/Todoist.png"></span>
                                                </td>
                                                <td colspan="2">
                                                    Topic Title
                                                </td>
                                                <td class="text-right">
                                                    <p>1 min</p>
                                                    <p>
                                                        <img src="/Public/Web/web/img/02_interest/interest_qxx_icon_xs.png">888
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
                                                    <span class="ImgBox"><img src="/Public/Web/web/img/02_interest/Todoist.png"></span>
                                                </td>
                                                <td colspan="2">
                                                    Topic Title
                                                </td>
                                                <td class="text-right">
                                                    <p>1 min</p>
                                                    <p>
                                                        <img src="/Public/Web/web/img/02_interest/interest_qxx_icon_xs.png">888
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
                                                    <span class="ImgBox"><img src="/Public/Web/web/img/02_interest/Todoist.png"></span>
                                                </td>
                                                <td colspan="2">
                                                    Topic Title
                                                </td>
                                                <td class="text-right">
                                                    <p>1 min</p>
                                                    <p>
                                                        <img src="/Public/Web/web/img/02_interest/interest_qxx_icon_xs.png">888
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
                                                    <span class="ImgBox"><img src="/Public/Web/web/img/02_interest/Todoist.png"></span>
                                                </td>
                                                <td colspan="2">
                                                    Topic Title
                                                </td>
                                                <td class="text-right">
                                                    <p>1 min</p>
                                                    <p>
                                                        <img src="/Public/Web/web/img/02_interest/interest_qxx_icon_xs.png">888
                                                        <img src="/Public/Web/web/img/02_interest/interest_qxx_icon_pl.png">888
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
                                                    <a href="<?php echo U('Index/Academic/resourceDetails');?>" style="text-decoration: none;">
                                                        <span class="WithNumber">
                                                            <span class="WithNumbers">18</span>
                                                            <img class="WithNumberImg" src="/Public/Web/web/img/02_interest/interest_qxx_pic_ups.png">
                                                        </span>
                                                        <span class="ImgBox">
                                                            <img src="/Public/Web/web/img/02_interest/Todoist.png">
                                                        </span>
                                                    </a>
                                                </td>
                                                <td class="NameBox">
                                                    <a href="<?php echo U('Index/Academic/resourceDetails');?>" style="text-decoration: none;">
                                                        Topic Title
                                                    </a>
                                                </td>
                                                <td class="NameIcom">
                                                    <img src="/Public/Web/web/img/02_interest/interest_qxx_icon_top.png">
                                                    <img src="/Public/Web/web/img/02_interest/interest_qxx_icon_jing.png">
                                                </td>
                                                <td class="text-right">
                                                    <p>1 min</p>
                                                    <p>
                                                        <img src="/Public/Web/web/img/02_interest/interest_qxx_icon_download.png">888
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
                                                    <span class="ImgBox"><img src="/Public/Web/web/img/02_interest/Todoist.png"></span>
                                                </td>
                                                <td colspan="2">
                                                    Topic Title
                                                </td>
                                                <td class="text-right">
                                                    <p>1 min</p>
                                                    <p>
                                                        <img src="/Public/Web/web/img/02_interest/interest_qxx_icon_download.png">888
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
                                                    <span class="ImgBox"><img src="/Public/Web/web/img/02_interest/Todoist.png"></span>
                                                </td>
                                                <td colspan="2">
                                                    Topic Title
                                                </td>
                                                <td class="text-right">
                                                    <p>1 min</p>
                                                    <p>
                                                        <img src="/Public/Web/web/img/02_interest/interest_qxx_icon_download.png">888
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
                                                    <span class="ImgBox"><img src="/Public/Web/web/img/02_interest/Todoist.png"></span>
                                                </td>
                                                <td colspan="2">
                                                    Topic Title
                                                </td>
                                                <td class="text-right">
                                                    <p>1 min</p>
                                                    <p>
                                                        <img src="/Public/Web/web/img/02_interest/interest_qxx_icon_download.png">888
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
                                                    <span class="ImgBox"><img src="/Public/Web/web/img/02_interest/Todoist.png"></span>
                                                </td>
                                                <td colspan="2">
                                                    Topic Title
                                                </td>
                                                <td class="text-right">
                                                    <p>1 min</p>
                                                    <p>
                                                        <img src="/Public/Web/web/img/02_interest/interest_qxx_icon_download.png">888
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
                                                    <span class="ImgBox"><img src="/Public/Web/web/img/02_interest/Todoist.png"></span>
                                                </td>
                                                <td colspan="2">
                                                    Topic Title
                                                </td>
                                                <td class="text-right">
                                                    <p>1 min</p>
                                                    <p>
                                                        <img src="/Public/Web/web/img/02_interest/interest_qxx_icon_download.png">888
                                                        <img src="/Public/Web/web/img/02_interest/interest_qxx_icon_pl.png">888
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
            <div class="col-md-4">
                <div class="ReleaseButContainer">
                    <a href="<?php echo U('Index/Academic/groupDetailsRelease');?>" class="layui-btn layui-btn-radius layui-btn-lg layui-btn-normal" id="GroupBtn">
                        Release
                    </a>
                </div>
                <div class="ReleaseButContainer">
                    <a href="<?php echo U('Index/Academic/groupDetailsRelease');?>" class="layui-btn layui-btn-radius layui-btn-lg layui-btn-normal" id="GroupBtn">
                        Provide counseling
                    </a>
                </div>
                <div class="ReleaseButContainer">
                    <a href="<?php echo U('Index/Academic/groupDetailsRelease');?>" class="layui-btn layui-btn-radius layui-btn-lg layui-btn-normal" id="GroupBtn">
                        Seeking counseling
                    </a>
                </div>
                <div class="GroupDetailsContainer">
                    <h4 class="text-center FontColor">Group Details</h4>
                    <div class="p"><b>Group icon  : </b>&nbsp;&nbsp;<div class="Group_icon"><img src="/Public/Web/web/img/02_interest/Todoist.png"></div></div>
                    <p class="p"><b>Group Name  :</b>Fancy Child</p>
                    <p class="p"><b>Creator  : </b>Jess.J</p>
                    <p class="p">
                        <b>Introduction  :</b>
                        <div class="textp">roduce.intweroduceintroductroducec.intro duce ntweroduceintroduceceintroduce.ceintroduce..</div>
                    </p>
                    <p><img src="/Public/Web/web/img/02_interest/interest_sy_gl_icon_renshu.png">&nbsp;&nbsp;<b>1288</b></p>
                    <p class="text-center Followtbut">
                        <a class="layui-btn layui-btn-radius layui-btn-lg layui-btn-normal join_btn" id="GroupBtn">
                            To join the group
                        </a>
                    </p>
                </div>
                <div class="GroupDetailsContainer">
                    <h4 class="text-center FontColor MoreMembersbox">
                        Group Member
                        <a href="<?php echo U('Index/Academic/moreMembers');?>" class="MoreMembersA">
                            <img src="/Public/Web/web/img/01_shouye/home_sy_icon_c_more_n.png">
                        </a>
                    </h4>
                    <p class="p"><b>Administrator  : </b></p>
                    <div class="p_box">
                        <div class="p_img">
                            <img src="/Public/Web/web/img/02_interest/Todoist.png" class="userimgs">
                        </div>
                        <div class="p_img">
                            <img src="/Public/Web/web/img/02_interest/Todoist.png" class="userimgs">
                        </div>
                        <div class="p_img">
                            <img src="/Public/Web/web/img/02_interest/Todoist.png" class="userimgs">
                        </div>
                        <div class="p_img">
                            <img src="/Public/Web/web/img/02_interest/Todoist.png" class="userimgs">
                        </div>
                        <div class="p_img">
                            <img src="/Public/Web/web/img/02_interest/Todoist.png" class="userimgs">
                        </div>
                    </div>
                    <p class="p"><b>Members  : </b></p>
                    <div class="p_box">
                        <div class="p_img">
                            <img src="/Public/Web/web/img/02_interest/Todoist.png" class="userimgs">
                        </div>
                        <div class="p_img">
                            <img src="/Public/Web/web/img/02_interest/Todoist.png" class="userimgs">
                        </div>
                        <div class="p_img">
                            <img src="/Public/Web/web/img/02_interest/Todoist.png" class="userimgs">
                        </div>
                        <div class="p_img">
                            <img src="/Public/Web/web/img/02_interest/Todoist.png" class="userimgs">
                        </div>
                    </div>
                </div>
                <div class="BannerContainer">
                    <h4 class="text-center FontColor">Advertising</h4>
                    <div class="Container1">
                        <img src="/Public/Web/web/img/01_shouye/pic2.png" class="img">
                        <p class="text-center Font">University</p>
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
    <script src="/Public/Web/web/js/index.js"></script>
    <script>
        $(".GroupDetailsContainer .Followtbut .join_btn").on("click",function(){
            if($(this).attr("data-Join")!="true"){
                $(this).css("background","#bdbdbd")
                $(this).text("Have joined the group")
                $(this).attr("data-Join","true")
            }else{

            }
        })
    </script>
</body>

</html>
<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Group details</title>
    <meta name="viewport" content="width=device-width, initial-scale=0 user-scalable=no, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="/Public/Web/web/css/register.css">
    <link rel="stylesheet" href="/Public/Web/web/css/Donation.css">
    <link rel="stylesheet" href="/Public/Web/web/css/CreateInterest.css">
    <link rel="stylesheet" href="/Public/Web/web/css/GroupDetails.css">
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
          <span class="CrumbsTitle">Group name</span>
        </span>
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
                        <div class="layui-input-block More">
                            <select class="form-control" name="city" lay-verify="required">
                                <option value="">Time sorting</option>
                                <option value="0">1</option>
                            </select>
                        </div>
                        <div class="layui-tab">
                            <ul class="layui-tab-title">
                                <li class="layui-this">Post</li>
                                <li>Q&A</li>
                                <li>Resources</li>
                            </ul>
                            <div class="layui-tab-content">
                                <div class="layui-tab-item layui-show">
                                    <table class="layui-table PostTable" lay-skin="line">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <a href="<?php echo U('Index/Jobs/stickSonDetails');?>" style="text-decoration: none;">
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
                                                    <a href="<?php echo U('Index/Jobs/stickSonDetails');?>" style="text-decoration: none;">
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
                                                    <a href="<?php echo U('Index/Jobs/postVideoDetails');?>" style="text-decoration: none;">
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
                                                    <a href="<?php echo U('Index/Jobs/postVideoDetails');?>" style="text-decoration: none;">
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
                                            
                                            
                                        </tbody>
                                    </table>
                                </div>
                                <div class="layui-tab-item">
                                    <table class="layui-table PostTable" lay-skin="line">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <a href="<?php echo U('Index/Jobs/questionAnswerDetails');?>" style="text-decoration: none;">
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
                                                    <a href="<?php echo U('Index/Jobs/questionAnswerDetails');?>" style="text-decoration: none;">
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
                                                    <span><img src="/Public/Web/web/img/02_interest/Todoist.png"></span>
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
                                                    <span><img src="/Public/Web/web/img/02_interest/Todoist.png"></span>
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
                                                    <span><img src="/Public/Web/web/img/02_interest/Todoist.png"></span>
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
                                                    <span><img src="/Public/Web/web/img/02_interest/Todoist.png"></span>
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
                                                    <span><img src="/Public/Web/web/img/02_interest/Todoist.png"></span>
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
                                                    <a href="<?php echo U('Index/Jobs/resourceDetails');?>" style="text-decoration: none;">
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
                                                    <a href="<?php echo U('Index/Jobs/resourceDetails');?>" style="text-decoration: none;">
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
                                                    <span><img src="/Public/Web/web/img/02_interest/Todoist.png"></span>
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
                                                    <span><img src="/Public/Web/web/img/02_interest/Todoist.png"></span>
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
                                                    <span><img src="/Public/Web/web/img/02_interest/Todoist.png"></span>
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
                                                    <span><img src="/Public/Web/web/img/02_interest/Todoist.png"></span>
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
                                                    <span><img src="/Public/Web/web/img/02_interest/Todoist.png"></span>
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
                    <a href="<?php echo U('Index/Jobs/groupDetailsRelease');?>" class="layui-btn layui-btn-radius layui-btn-lg layui-btn-normal" id="GroupBtn">
                        Release
                    </a>
                </div>
                <div class="GroupDetailsContainer">
                    <h4 class="text-center FontColor">Group Details</h4>
                    <p class="p"><b>Group icon  : </b>&nbsp;&nbsp;<img src="/Public/Web/web/img/02_interest/Todoist.png"></p>
                    <p class="p"><b>Group Name  :</b>Fancy Child</p>
                    <p class="p"><b>Creator  : </b>Jess.J</p>
                    <p class="p">
                        <b>Introduction  :</b>
                        <div class="textp">roduce.intweroduceintroductroducec.intro duce ntweroduceintroduceceintroduce.ceintroduce..</div>
                    </p>
                    <p><img src="/Public/Web/web/img/02_interest/interest_sy_gl_icon_renshu.png">&nbsp;&nbsp;<b>1288</b></p>
                    <p class="text-center Followtbut">
                        <a href="#" class="layui-btn layui-btn-radius layui-btn-lg layui-btn-normal" id="GroupBtn">
                        Follow
                        </a>
                    </p>
                </div>
                <div class="GroupDetailsContainer">
                    <h4 class="text-center FontColor MoreMembersbox">
                        Group Member
                        <a href="<?php echo U('Index/Jobs/moreMembers');?>" class="MoreMembersA">
                            <img src="/Public/Web/web/img/01_shouye/home_sy_icon_c_more_n.png">
                        </a>
                    </h4>
                    <p class="p"><b>Group icon  : </b></p>
                    <p class="p"><img src="/Public/Web/web/img/02_interest/Todoist.png" class="userimgs"><img src="/Public/Web/web/img/02_interest/Todoist.png" class="userimgs"><img src="/Public/Web/web/img/02_interest/Todoist.png" class="userimgs"><img src="/Public/Web/web/img/02_interest/Todoist.png" class="userimgs"><img src="/Public/Web/web/img/02_interest/Todoist.png" class="userimgs"></p>
                    <p class="p"><b>Group icon  : </b></p>
                    <p><img src="/Public/Web/web/img/02_interest/Todoist.png" class="userimgs"><img src="/Public/Web/web/img/02_interest/Todoist.png" class="userimgs"><img src="/Public/Web/web/img/02_interest/Todoist.png" class="userimgs"><img src="/Public/Web/web/img/02_interest/Todoist.png" class="userimgs"></p>
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
</body>

</html>
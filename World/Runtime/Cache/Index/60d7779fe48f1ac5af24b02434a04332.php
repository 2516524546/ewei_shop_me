<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Group details</title>
    <meta name="viewport" content="width=device-width, initial-scale=0 user-scalable=no, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="/Public/Web/web/css/register.css">
    <link rel="stylesheet" href="/Public/Web/web/css/Donation.css">
    <link rel="stylesheet" href="/Public/Web/web/css/CreateInterest.css">
    <link rel="stylesheet" href="/Public/Web/js/lib/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Public/Web/js/lib/bootstrap/dist/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="/Public/Web/js/lib/bootstrap/dist/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="/Public/Web/js/lib/layui/dist/css/layui.css">
    <link rel="stylesheet" href="/Public/Web/web/css/GroupDetails.css">
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
        <span class="crumbsTitle"><?php echo ($crowone['crowd_name']); ?></span>

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
                            <a href="javascript:void(0)" id="SelectionIcon" onclick="seek()">
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
                                <li class="layui-this" onclick="settype(1)">Post</li>
                                <li onclick="settype(2)">Q&A</li>
                                <li onclick="settype(3)">Resources</li>
                            </ul>
                            <div class="layui-tab-content">
                                <div id="notelist" class="layui-tab-item layui-show">
                                    <table class="layui-table PostTable" lay-skin="line">
                                        <tbody id="postcontent">
                                            <?php if(is_array($notelist)): foreach($notelist as $notekey=>$note): ?><tr>
                                                <td>
                                                    <a href="<?php echo U('Index/Rnterst/stickSonDetails');?>" style="text-decoration: none;">

                                                        <span class="ImgBox">
                                                            <img src="<?php if($note["user_icon"]): ?>./Uploads/<?php echo ($note['user_icon']); else: ?>/Public/Web/web/img/01_shouye/UserPic.png<?php endif; ?>">
                                                        </span>
                                                    </a>
                                                </td>
                                                <td class="NameBox">
                                                    <a href="<?php echo U('Index/Rnterst/stickSonDetails');?>" style="text-decoration: none;">
                                                        <span class="TopicNames"><?php echo ($note['note_name']); ?></span>
                                                    </a>
                                                </td>
                                                <td class="NameIcom">
                                                    <?php if($note["note_istop"] == 1): ?><img src="/Public/Web/web/img/02_interest/interest_qxx_icon_top.png"><?php endif; ?>
                                                    <?php if($note["note_iswally"] == 1): ?><img src="/Public/Web/web/img/02_interest/interest_qxx_icon_jing.png"><?php endif; ?>
                                                </td>
                                                <td class="text-right">
                                                    <p><?php echo ($note['note_createtime']); ?></p>
                                                    <p>
                                                        <img src="/Public/Web/web/img/02_interest/interest_qxx_icon_pl.png"><?php echo ($note['note_comments']); ?>
                                                    </p>
                                                </td>
                                            </tr><?php endforeach; endif; ?>

                                        </tbody>
                                    </table>
                                </div>
                                <div id="question" class="layui-tab-item">
                                    <table class="layui-table PostTable" lay-skin="line">
                                        <tbody id="questioncontent">
                                        <?php if(is_array($questionlist)): foreach($questionlist as $questionkey=>$question): ?><tr>
                                                <td>
                                                    <a href="<?php echo U('Index/Rnterst/questionAnswerDetails');?>" style="text-decoration: none;">
                                                        <!--<span class="WithNumber">
                                                            <span class="WithNumbers">18</span>
                                                            <img class="WithNumberImg" src="/Public/Web/web/img/02_interest/interest_qxx_pic_ups.png">
                                                        </span>-->
                                                        <span class="ImgBox">
                                                            <img src="<?php if($question["user_icon"]): ?>./Uploads/<?php echo ($question['user_icon']); else: ?>/Public/Web/web/img/01_shouye/UserPic.png<?php endif; ?>">
                                                        </span>
                                                    </a>
                                                </td>
                                                <td class="NameBox">
                                                    <a href="<?php echo U('Index/Rnterst/questionAnswerDetails');?>" style="text-decoration: none;">
                                                        <?php echo ($question['question_name']); ?>
                                                    </a>
                                                </td>
                                                <td class="NameIcom">
                                                    <?php if($question["question_istop"] == 1): ?><img src="/Public/Web/web/img/02_interest/interest_qxx_icon_top.png"><?php endif; ?>
                                                    <?php if($question["question_iswally"] == 1): ?><img src="/Public/Web/web/img/02_interest/interest_qxx_icon_jing.png"><?php endif; ?>
                                                </td>
                                                <td class="text-right">
                                                    <p><?php echo ($question["question_createtime"]); ?></p>
                                                    <p>
                                                        <img src="/Public/Web/web/img/02_interest/interest_qxx_icon_xs.png"><?php echo ($question["question_reward"]); ?>
                                                        <img src="/Public/Web/web/img/02_interest/interest_qxx_icon_pl.png"><?php echo ($question["question_comments"]); ?>
                                                    </p>
                                                </td>
                                            </tr><?php endforeach; endif; ?>

                                        </tbody>
                                    </table>
                                </div>
                                <div id="resource" class="layui-tab-item">
                                    <table class="layui-table PostTable" lay-skin="line">
                                        <tbody id="resourcecontent">
                                        <?php if(is_array($resourcelist)): foreach($resourcelist as $resourcekey=>$resource): ?><tr>
                                                <td>
                                                    <a href="<?php echo U('Index/Rnterst/resourceDetails');?>" style="text-decoration: none;">
                                                        <!--<span class="WithNumber">
                                                            <span class="WithNumbers">18</span>
                                                            <img class="WithNumberImg" src="/Public/Web/web/img/02_interest/interest_qxx_pic_ups.png">
                                                        </span>-->
                                                        <span class="ImgBox">
                                                            <img src="<?php if($resource["user_icon"]): ?>./Uploads/<?php echo ($question['user_icon']); else: ?>/Public/Web/web/img/01_shouye/UserPic.png<?php endif; ?>">
                                                        </span>
                                                    </a>
                                                </td>
                                                <td class="NameBox">
                                                    <a href="<?php echo U('Index/Rnterst/resourceDetails');?>" style="text-decoration: none;">
                                                        <?php echo ($resource["resource_name"]); ?>
                                                    </a>
                                                </td>
                                                <td class="NameIcom">
                                                    <?php if($resource["resource_istop"] == 1): ?><img src="/Public/Web/web/img/02_interest/interest_qxx_icon_top.png"><?php endif; ?>
                                                    <?php if($resource["resource_iswally"] == 1): ?><img src="/Public/Web/web/img/02_interest/interest_qxx_icon_jing.png"><?php endif; ?>
                                                </td>
                                                <td class="text-right">
                                                    <p><?php echo ($resource["resource_createtime"]); ?></p>
                                                    <p>
                                                        <img src="/Public/Web/web/img/02_interest/interest_qxx_icon_download.png"><?php echo ($resource["resource_reward"]); ?>
                                                        <img src="/Public/Web/web/img/02_interest/interest_qxx_icon_pl.png"><?php echo ($resource["resource_comments"]); ?>
                                                    </p>
                                                </td>
                                            </tr><?php endforeach; endif; ?>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <?php if($join_in == 1): ?><div class="ReleaseButContainer">
                    <a href="javascript:void(0)" class="layui-btn layui-btn-radius layui-btn-lg layui-btn-normal" onclick="release()" id="GroupBtn">
                        Release
                    </a>
                </div><?php endif; ?>
                <div class="GroupDetailsContainer">
                    <h4 class="text-center FontColor">Group Details</h4>
                    <div class="p"><b>Group icon  : </b>&nbsp;&nbsp;<div class="Group_icon"><img src="Uploads/<?php echo ($crowone['crowd_icon']); ?>"></div></div>
                    <p class="p"><b>Group Name  :</b><?php echo ($crowone['crowd_name']); ?></p>
                    <p class="p"><b>Creator  : </b><?php echo ($crowone['user_name']); ?></p>
                    <p class="p">
                        <b>Introduction  :</b>
                        <div class="textp"><?php echo ($crowone['crowd_intro']); ?></div>
                    </p>
                    <p><img src="/Public/Web/web/img/02_interest/interest_sy_gl_icon_renshu.png">&nbsp;&nbsp;<b><?php echo ($crowone['crowd_peoplenum']); ?></b></p>
                    <?php if($join_in != 1): ?><p class="text-center Followtbut">
                        <a class="layui-btn layui-btn-radius layui-btn-lg layui-btn-normal join_btn" id="GroupBtn">
                            To join the group
                        </a>
                    </p><?php endif; ?>
                </div>
                <div class="GroupDetailsContainer">
                    <h4 class="text-center FontColor MoreMembersbox">
                        Group Member
                        <a href="<?php echo U('Index/Rnterst/moreMembers');?>&&cid=<?php echo ($cid); ?>" class="MoreMembersA">
                            <img src="/Public/Web/web/img/01_shouye/home_sy_icon_c_more_n.png">
                        </a>
                    </h4>
                    <p class="p"><b>Administrator  : </b></p>
                    <div class="p_box">
                    <?php if(is_array($adminlist)): foreach($adminlist as $adminkey=>$admin): ?><div class="p_img">
                            <img src="Uploads/<?php echo ($admin['user_icon']); ?>" class="userimgs">
                        </div><?php endforeach; endif; ?>
                    </div>
                    <p class="p"><b>Members  : </b></p>
                    <div class="p_box">
                    <?php if(is_array($memberlist)): foreach($memberlist as $memberkey=>$member): ?><div class="p_img">
                            <img src="Uploads/<?php echo ($member['user_icon']); ?>" class="userimgs">
                        </div><?php endforeach; endif; ?>
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
    <script src="/Public/Web/web/js/loginQuit.js"></script>
</body>

<script>
    
    function release() {

        var aa = "<?php echo ($userid); ?>";
        var cid = "<?php echo ($crowone['crowd_id']); ?>"
        if(aa){
            var url = "<?php echo U('Index/Rnterst/groupDetailsRelease');?>&cid="+cid
            window.location.href=url;
        }else{
            layer.msg("请先登录",{
                    time:1500,
                },function(){

                    window.location.href="<?php echo U('Index/Login/login');?>";
                }
            );
        }


    }
    
    var type = 1;
    var notepage = 1;
    var questionpage = 1;
    var resourcepage = 1;
    var notecount = <?php echo ($notecount); ?>;
    var questioncount = <?php echo ($questioncount); ?>;
    var resourcecount = <?php echo ($resourcecount); ?>;
    var c = 1;
    var a = 1;
    var noteorder = 'note_istop desc,note_iswally desc,note_createtime desc'
    var questionorder = 'question_istop desc,question_iswally desc,question_createtime desc'
    var resourceorder = 'resource_istop desc,resource_iswally desc,resource_createtime desc'

    function settype(num) {
        type = num
    }

    $(window).scroll(function () {
        var scrollTop = $(document).scrollTop();
        var scrollHeight = $(document).height();
        var windowHeight = $(this).height();
        var gocheng =parseInt(scrollTop)+parseInt(windowHeight);

        if (gocheng>(scrollHeight-200)) {

            if (type == 1){
                if (c==a){
                    var limit1 = notepage*20;
                    if (limit1<notecount){
                        c = 2;
                        havenote(2,noteorder,notepage,20)
                        notepage += 1;
                    }else{
                        /*layer.msg('已没数据!',{
                                time:1500,
                                icon:2,
                            }
                        );*/
                    }
                }
            }else if (type == 2){

                if (c==a){

                    var limit1 = questionpage*20;

                    if (limit1<questioncount){
                        c = 2;
                        havequestion(2,questionorder,questionpage,20)
                        questionpage += 1;
                    }else{
                        /*layer.msg('已没数据!',{
                                time:1500,
                                icon:2,
                            }
                        );*/
                    }
                }
            }else if (type == 3){

                if (c==a){

                    var limit1 = resourcepage*20;

                    if (limit1<resourcecount){
                        c = 2;
                        haveresource(2,resourceorder,resourcepage,20)
                        resourcepage += 1;
                    }else{
                        /*layer.msg('已没数据!',{
                                time:1500,
                                icon:2,
                            }
                        );*/
                    }
                }
            }
        }
    })

    function seek() {
        if (type == 1){
            notepage = 0
            havenote(1,noteorder,notepage,20)

        }else if (type == 2){
            questionpage = 0
            havequestion(1,questionorder,questionpage,20)
        } else if (type == 3){
            resourcepage = 0
            haveresource(1,resourceorder,resourcepage,20)
        }
    }

    function havenote(type,order,limit1,limit2) {

        $.ajax({
            type:"post",
            url:"<?php echo U('Index/Ajax/ajax_havenote');?>",
            data:{
                name:$("#Selectionform").val(),
                order:order,
                limit1:limit1,
                limit2:limit2,
                cid:'<?php echo ($cid); ?>'

            },
            dataType:"json",
            async:false,
            success: function(list){

                if(list!=null&&list!=""){

                    if (list.str == 1){

                        var message = '';
                        for (var i = 0; i < list.msg.length; i++) {

                            message += '<tr><td>';
                            var url = '#';
                            message += '<a href="'+url+'" style="text-decoration: none;">';
                            message += '<span class="ImgBox">'
                            var src = '/Public/Web/web/img/01_shouye/UserPic.png'
                            if (list.msg[i].user_icon&&list.msg[i].user_icon!=''&&list.msg[i].user_icon!=null){
                                src = 'Uploads/'+list.msg[i].user_icon;
                            }
                            message += '<img src="'+src+'">';
                            message += '</span></a></td><td class="NameBox">'
                            message += '<a href="'+url+'" style="text-decoration: none;">';
                            message += '<span class="TopicNames">'+list.msg[i].note_name+'</span>'
                            message += '</a></td><td class="NameIcom">'
                            if(list.msg[i].note_istop==1){
                                message += '<img src="/Public/Web/web/img/02_interest/interest_qxx_icon_top.png">'
                            }
                            if(list.msg[i].note_iswally==1){
                                message += '<img src="/Public/Web/web/img/02_interest/interest_qxx_icon_jing.png">'
                            }
                            message += '</td><td class="text-right">'
                            message += '<p>'+list.msg[i].note_createtime+'</p>'
                            message += '<p><img src="/Public/Web/web/img/02_interest/interest_qxx_icon_pl.png">'+list.msg[i].note_comments+'</p>'
                            message += '</td></tr>'

                        }

                        if (type==1){
                            c = 1;
                            notepage = 1;
                            notecount = list.count;
                            $("#postcontent").html(message);

                        }else{
                            c=1;
                            var postcontenthtml = $("#postcontent").html()+message
                            $("#postcontent").html(postcontenthtml);
                        }
                    }else if (list.str == 2){
                        if (type==1){
                            notepage = 1;
                            c=1;
                            notecount = list.count;
                            $("#postcontent").html('');

                        }else{
                            c=1;

                        }
                    }else{
                        layer.msg(list.msg,{
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
    
    function havequestion(type,order,limit1,limit2) {

        $.ajax({
            type:"post",
            url:"<?php echo U('Index/Ajax/ajax_havequestion');?>",
            data:{
                name:$("#Selectionform").val(),
                order:order,
                limit1:limit1,
                limit2:limit2,
                cid:'<?php echo ($cid); ?>'

            },
            dataType:"json",
            async:false,
            success: function(list){

                if(list!=null&&list!=""){

                    if (list.str == 1){

                        var message = '';
                        for (var i = 0; i < list.msg.length; i++) {

                            message += '<tr><td>';
                            var url = '#';
                            message += '<a href="'+url+'" style="text-decoration: none;">';
                            message += '<span class="ImgBox">'
                            var src = '/Public/Web/web/img/01_shouye/UserPic.png'
                            if (list.msg[i].user_icon&&list.msg[i].user_icon!=''&&list.msg[i].user_icon!=null){
                                src = 'Uploads/'+list.msg[i].user_icon;
                            }
                            message += '<img src="'+src+'">';
                            message += '</span></a></td><td class="NameBox">'
                            message += '<a href="'+url+'" style="text-decoration: none;">';
                            message += '<span class="TopicNames">'+list.msg[i].question_name+'</span>'
                            message += '</a></td><td class="NameIcom">'
                            if(list.msg[i].question_istop==1){
                                message += '<img src="/Public/Web/web/img/02_interest/interest_qxx_icon_top.png">'
                            }
                            if(list.msg[i].question_iswally==1){
                                message += '<img src="/Public/Web/web/img/02_interest/interest_qxx_icon_jing.png">'
                            }
                            message += '</td><td class="text-right">'
                            message += '<p>'+list.msg[i].note_createtime+'</p>'
                            message += '<p><img src="/Public/Web/web/img/02_interest/interest_qxx_icon_xs.png">'+list.msg[i].question_reward+'<img src="/Public/Web/web/img/02_interest/interest_qxx_icon_pl.png">'+list.msg[i].question_comments+'</p>'
                            message += '</td></tr>'

                        }

                        if (type==1){
                            c = 1;
                            questionpage = 1;
                            questioncount = list.count;
                            $("#questioncontent").html(message);

                        }else{
                            c=1;
                            var postcontenthtml = $("#questioncontent").html()+message
                            $("#questioncontent").html(postcontenthtml);
                        }
                    }else if (list.str == 2){
                        if (type==1){
                            questionpage = 1;
                            c=1;
                            questioncount = list.count;
                            $("#questioncontent").html('');

                        }else{
                            c=1;

                        }
                    }else{
                        layer.msg(list.msg,{
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

    function haveresource(type,order,limit1,limit2) {

        $.ajax({
            type:"post",
            url:"<?php echo U('Index/Ajax/ajax_haveresource');?>",
            data:{
                name:$("#Selectionform").val(),
                order:order,
                limit1:limit1,
                limit2:limit2,
                cid:'<?php echo ($cid); ?>'

            },
            dataType:"json",
            async:false,
            success: function(list){

                if(list!=null&&list!=""){

                    if (list.str == 1){

                        var message = '';
                        for (var i = 0; i < list.msg.length; i++) {

                        /*
                            <td class="NameBox">
                                <a href="<?php echo U('Index/Rnterst/resourceDetails');?>" style="text-decoration: none;">
                                <?php echo ($resource["resource_name"]); ?>
                                </a>
                                </td>
                                <td class="NameIcom">
                                <?php if($resource["resource_istop"] == 1): ?><img src="/Public/Web/web/img/02_interest/interest_qxx_icon_top.png"><?php endif; ?>
                                <?php if($resource["resource_iswally"] == 1): ?><img src="/Public/Web/web/img/02_interest/interest_qxx_icon_jing.png"><?php endif; ?>
                                </td>
                                <td class="text-right">
                                <p><?php echo ($resource["resource_createtime"]); ?></p>
                                <p>
                                <img src="/Public/Web/web/img/02_interest/interest_qxx_icon_download.png"><?php echo ($resource["resource_reward"]); ?>
                                <img src="/Public/Web/web/img/02_interest/interest_qxx_icon_pl.png"><?php echo ($resource["resource_comments"]); ?>
                                </p>
                                </td>
                                </tr>*/
                            message += '<tr><td>';
                            var url = '#';
                            message += '<a href="'+url+'" style="text-decoration: none;">';
                            message += '<span class="ImgBox">'
                            var src = '/Public/Web/web/img/01_shouye/UserPic.png'
                            if (list.msg[i].user_icon&&list.msg[i].user_icon!=''&&list.msg[i].user_icon!=null){
                                src = 'Uploads/'+list.msg[i].user_icon;
                            }
                            message += '<img src="'+src+'">';
                            message += '</span></a></td><td class="NameBox">'
                            message += '<a href="'+url+'" style="text-decoration: none;">';
                            message += list.msg[i].resource_name
                            message += '</a></td><td class="NameIcom">'
                            if(list.msg[i].resource_istop==1){
                                message += '<img src="/Public/Web/web/img/02_interest/interest_qxx_icon_top.png">'
                            }
                            if(list.msg[i].resource_iswally==1){
                                message += '<img src="/Public/Web/web/img/02_interest/interest_qxx_icon_jing.png">'
                            }
                            message += '</td><td class="text-right">'
                            message += '<p>'+list.msg[i].resource_createtime+'</p>'
                            message += '<p><img src="/Public/Web/web/img/02_interest/interest_qxx_icon_download.png">'+list.msg[i].resource_reward+'<img src="/Public/Web/web/img/02_interest/interest_qxx_icon_pl.png">'+list.msg[i].resource_comments+'</p>'
                            message += '</td></tr>'

                        }

                        if (type==1){
                            c = 1;
                            resourcepage = 1;
                            resourcecount = list.count;
                            $("#resourcecontent").html(message);

                        }else{
                            c=1;
                            var postcontenthtml = $("#resourcecontent").html()+message
                            $("#resourcecontent").html(postcontenthtml);
                        }
                    }else if (list.str == 2){
                        if (type==1){
                            resourcepage = 1;
                            c=1;
                            resourcecount = list.count;
                            $("#resourcecontent").html('');

                        }else{
                            c=1;

                        }
                    }else{
                        layer.msg(list.msg,{
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

</html>
<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>work</title>
    <meta name="viewport" content="width=device-width, initial-scale=0 user-scalable=no, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="/Public/Web/web/css/Academic.css">
    <link rel="stylesheet" href="/Public/Web/js/lib/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Public/Web/js/lib/bootstrap/dist/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="/Public/Web/js/lib/bootstrap/dist/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="/Public/Web/js/lib/layui/dist/css/layui.css">
    <link rel="stylesheet" href="/Public/Web/web/css/success_index.css">
</head>

<body>
    <!-- Head information start 头信息 -->
    <div class="container headerBox">
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="logo" title="logo"></a>
            </div>
            <div class="col-md-6">
                
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
                <div class="nav">
                    <nav class="navbar NavBg">
                        <ul class="ListInline">
                            <li>
                                <a href="<?php echo U('Index/Index/index');?>">Home</a>
                            </li>
                            <li>
                                <a href="<?php echo U('Index/Rnterst/interest');?>">Interst</a>
                            </li>
                            <li>
                                <a href="<?php echo U('Index/Academic/academic');?>">Academic</a>
                            </li>
                            <li>
                                <a href="<?php echo U('Index/Jobs/work');?>" id="NavSelected">Jobs</a>
                            </li>
                            <li>
                                <a href="<?php echo U('Index/Life/life');?>">Life</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Head information end 头信息 -->
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
    <!-- search sataer 搜索 -->
    <form class="layui-form" action="">
        <div class="container SearchContainer">
            <div class="row">
                <div class="col-md-5">

                    <div class="SelectionTypeContainer">
                        <label class="layui-form-label">
                            <span><img src="/Public/Web/web/img/04_jobs/jobs_create_icon_location.png"></span>
                        </label>
                        <div class="layui-input-block">
                            <select name="city" lay-verify="required">
                                <option>Choose a location</option>
                                <option>Washington</option>
                                <option>Washington</option>
                                <option>Washington</option>
                            </select>
                        </div>
                    </div>
                    <div class="SelectionTypeContainer">
                        <label class="layui-form-label">
                            <span><img src="/Public/Web/web/img/04_jobs/jobs_create_icon_industry.png"></span>
                        </label>
                        <div class="layui-input-block">
                            <select name="city" lay-verify="required">
                                <option>Choose industry</option>
                                <option>Investment</option>
                                <option>Investment</option>
                            </select>
                        </div>
                    </div>
                    <div class="SelectionTypeContainer">
                        <label class="layui-form-label">
                            <span><img src="/Public/Web/web/img/04_jobs/jobs_create_icon_type.png"></span>
                        </label>
                        <div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
                            <ul class="layui-tab-title" style="border: none;">
                                <li class="layui-this">Ordinary group</li>
                                <li>Social network group</li>
                            </ul>
                            <div class="layui-tab-content">
                                <div class="layui-tab-item layui-show">
                                    <div class="SelectionTypeContainer" style="margin-left: -10px;">
                                        <label class="layui-form-label">
                                            <span><img src="/Public/Web/web/img/04_jobs/jobs_create_icon_country.png"></span>
                                        </label>
                                        <div class="layui-input-block">
                                            <select name="city" lay-verify="required">
                                                <option>Choose a country</option>
                                                <option>China</option>
                                                <option>China</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="SelectionTypeContainer" style="margin-left: -10px;">
                                        <label class="layui-form-label">
                                            <span><img src="/Public/Web/web/img/04_jobs/jobs_create_icon_school.png"></span>
                                        </label>
                                        <div class="layui-input-block">
                                            <select name="city" lay-verify="required">
                                                <option>Choose a school</option>
                                                <option>Harvard</option>
                                                <option>Harvard</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="layui-tab-item">
                                    <div class="SelectionTypeContainer" style="margin-left: -10px;">
                                        <label class="layui-form-label">
                                            <span><img src="/Public/Web/web/img/04_jobs/jobs_create_icon_major.png"></span>
                                        </label>
                                        <div class="layui-input-block">
                                            <select name="city" lay-verify="required">
                                                <option>Choose the major</option>
                                                <option>1</option>
                                                <option>2</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="SelectionTypeContainer" style="margin-left: -10px;">
                                        <label class="layui-form-label">
                                            <span><img src="/Public/Web/web/img/04_jobs/jobs_create_icon_school.png"></span>
                                        </label>
                                        <div class="layui-input-block">
                                            <input type="text" name="title" lay-verify="title" autocomplete="off" placeholder="Enter a graduate school" class="layui-input">
                                        </div>
                                    </div>
                                    <div class="SelectionTypeContainer" style="margin-left: -10px;">
                                        <label class="layui-form-label">
                                            <span><img src="/Public/Web/web/img/04_jobs/jobs_sy_icon_07.png"></span>
                                        </label>
                                        <div class="layui-input-block">
                                            <input type="text" name="title" lay-verify="title" autocomplete="off" placeholder="Graduation time  xx/xx/xxxx" class="layui-input">
                                        </div>
                                    </div>
                                    <div class="SelectionTypeContainer" style="margin-left: -10px;">
                                        <label class="layui-form-label">
                                            <span><img src="/Public/Web/web/img/04_jobs/jobs_create_icon_jobtitle.png"></span>
                                        </label>
                                        <div class="layui-input-block">
                                            <input type="text" name="title" lay-verify="title" autocomplete="off" placeholder="Enter the job title" class="layui-input">
                                        </div>
                                    </div>
                                    <div class="SelectionTypeContainer" style="margin-left: -10px;">
                                        <label class="layui-form-label">
                                            <span><img src="/Public/Web/web/img/04_jobs/jobs_create_icon_company.png"></span>
                                        </label>
                                        <div class="layui-input-block">
                                            <input type="text" name="title" lay-verify="title" autocomplete="off" placeholder="Enter the working company" class="layui-input">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="SelectionContainer">
                        <input type="text" class="layui-input" id="Selectionform">
                        <a href="#" id="SelectionIcon"><img src="/Public/Web/web/img/02_interest/interest_qxx_search_icon.png"></a>
                    </div>
                </div>
                <div class="col-md-2">
                    <a href="<?php echo U('Index/Jobs/jobList');?>" class="layui-btn layui-btn-radius layui-btn-lg layui-btn-normal" id="GroupBtn" style="margin-bottom: 12px;padding: 0 48px;">
						Find A Job
					</a>
					<a href="<?php echo U('Index/Jobs/projectsProfessionals');?>" class="layui-btn layui-btn-radius layui-btn-lg layui-btn-normal" id="GroupBtn" style="margin-bottom: 12px;margin-left: 4px;padding: 0 60px;">
						Project
					</a>
					<a href="#" class="layui-btn layui-btn-radius layui-btn-lg layui-btn-normal" id="GroupBtn" style="margin-left: 4px;padding: 0 32px;">
						Create A Group
					</a>
                    <p class="text-right Help">
                        <a href="#" title="Functional introduction">
							<img src="/Public/Web/web/img/02_interest/interest_sy_question.png">
						</a>
                    </p>
                </div>
            </div>
        </div>
    </form>
    <!-- search end 搜索 -->
    <!--Group list sataer 群列表-->
    <div class="container GroupList">
        <div class="row">
            <div class="col-md-10">
                <h4 class="text-center GroupTitle">Group List</h4>
                <div class="row">
                    <div class="col-xs-8 col-sm-6">
                        <div class="UserBox">
                            <a href="<?php echo U('Index/Jobs/groupDetails');?>" class="UserLink">
									<img src="/Public/Web/web/img/02_interest/user.png" alt="" class="img-circle userimg" />
									<h4 class="UserTitle">Travel group</h4>
									<p class="UserFollow">
										<img src="/Public/Web/web/img/02_interest/interest_sy_gl_icon_renshu.png" alt="" /> &nbsp;&nbsp;80
									</p>
									<p class="UserName">
										Creator : Jess J <span class="UserTime">01/20/2018</span>
									</p>
									<p class="UserContent">
										Introduction : Long life, I have accompanied you. The world is so big, human beings are so small, but even so...
									</p>
								</a>
                        </div>
                    </div>
                    <div class="col-xs-4 col-sm-6">
                        <div class="UserBox">
                            <a href="<?php echo U('Index/Jobs/groupDetails');?>" class="UserLink">
									<img src="/Public/Web/web/img/02_interest/user.png" alt="" class="img-circle userimg" />
									<h4 class="UserTitle">Travel group</h4>
									<p class="UserFollow">
										<img src="/Public/Web/web/img/02_interest/interest_sy_gl_icon_renshu.png" alt="" /> &nbsp;&nbsp;80
									</p>
									<p class="UserName">
										Creator : Jess J <span class="UserTime">01/20/2018</span>
									</p>
									<p class="UserContent">
										Introduction : Long life, I have accompanied you. The world is so big, human beings are so small, but even so...
									</p>
								</a>
                        </div>
                    </div>
                    <div class="col-xs-8 col-sm-6">
                        <div class="UserBox">
                            <a href="<?php echo U('Index/Jobs/groupDetails');?>" class="UserLink">
									<img src="/Public/Web/web/img/02_interest/user.png" alt="" class="img-circle userimg" />
									<h4 class="UserTitle">Travel group</h4>
									<p class="UserFollow">
										<img src="/Public/Web/web/img/02_interest/interest_sy_gl_icon_renshu.png" alt="" /> &nbsp;&nbsp;80
									</p>
									<p class="UserName">
										Creator : Jess J <span class="UserTime">01/20/2018</span>
									</p>
									<p class="UserContent">
										Introduction : Long life, I have accompanied you. The world is so big, human beings are so small, but even so...
									</p>
								</a>
                        </div>
                    </div>
                    <div class="col-xs-4 col-sm-6">
                        <div class="UserBox">
                            <a href="<?php echo U('Index/Jobs/groupDetails');?>" class="UserLink">
									<img src="/Public/Web/web/img/02_interest/user.png" alt="" class="img-circle userimg" />
									<h4 class="UserTitle">Travel group</h4>
									<p class="UserFollow">
										<img src="/Public/Web/web/img/02_interest/interest_sy_gl_icon_renshu.png" alt="" /> &nbsp;&nbsp;80
									</p>
									<p class="UserName">
										Creator : Jess J <span class="UserTime">01/20/2018</span>
									</p>
									<p class="UserContent">
										Introduction : Long life, I have accompanied you. The world is so big, human beings are so small, but even so...
									</p>
								</a>
                        </div>
                    </div>
                    <div class="col-xs-8 col-sm-6">
                        <div class="UserBox">
                            <a href="<?php echo U('Index/Jobs/groupDetails');?>" class="UserLink">
									<img src="/Public/Web/web/img/02_interest/user.png" alt="" class="img-circle userimg" />
									<h4 class="UserTitle">Travel group</h4>
									<p class="UserFollow">
										<img src="/Public/Web/web/img/02_interest/interest_sy_gl_icon_renshu.png" alt="" /> &nbsp;&nbsp;80
									</p>
									<p class="UserName">
										Creator : Jess J <span class="UserTime">01/20/2018</span>
									</p>
									<p class="UserContent">
										Introduction : Long life, I have accompanied you. The world is so big, human beings are so small, but even so...
									</p>
								</a>
                        </div>
                    </div>
                    <div class="col-xs-4 col-sm-6">
                        <div class="UserBox">
                            <a href="<?php echo U('Index/Jobs/groupDetails');?>" class="UserLink">
									<img src="/Public/Web/web/img/02_interest/user.png" alt="" class="img-circle userimg" />
									<h4 class="UserTitle">Travel group</h4>
									<p class="UserFollow">
										<img src="/Public/Web/web/img/02_interest/interest_sy_gl_icon_renshu.png" alt="" /> &nbsp;&nbsp;80
									</p>
									<p class="UserName">
										Creator : Jess J <span class="UserTime">01/20/2018</span>
									</p>
									<p class="UserContent">
										Introduction : Long life, I have accompanied you. The world is so big, human beings are so small, but even so...
									</p>
								</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="BannerContainer">
                    <h4 class="text-center FontColor">Advertising</h4>
                    <div class="Container1">
                        <img src="/Public/Web/web/img/01_shouye/pic2.png" class="img">
                        <p class="text-center Font">University</p>
                    </div>
                    <div class="Container2">
                        <img src="/Public/Web/web/img/01_shouye/pic3.png" class="img">
                        <p class="text-center Font">University</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!--Group list end 群列表-->
    <!--foot start 底部信息-->
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
    <!--foot end 底部信息-->
    <script src="/Public/Web/js/lib/jquery/dist/jquery.min.js"></script>
    <script src="/Public/Web/js/lib/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/Public/Web/js/lib/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/Public/Web/js/lib/layui/dist/layui.all.js"></script>
    <script src="/Public/Web/js/lib/layui/src/layui.js"></script>
    <script src="/Public/Web/web/js/index.js"></script>
    <script src="/Public/Web/web/js/loginQuit.js"></script>
</body>

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

</html>
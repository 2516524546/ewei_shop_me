<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Job list</title>
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
    </header>
    <hr>
    <!-- Crumbs nav -->
    <div class="container crumbs">
        <a href="<?php echo U('Index/Jobs/work');?>" class="crumbsa">Jobs</a>
        <cite class="Icon"></cite>
        <a href="<?php echo U('Index/Jobs/jobList');?>" class="crumbsa">Job Listings</a>
        <cite class="Icon"></cite>
        <span class="crumbsTitle">Post a job</span>

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
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="background: none;border: none;margin-left: -20px;">
                            <img src="/Public/Web/web/img/04_jobs/jobs_create_icon_type.png">
                        </label>
                        <div class="layui-input-block" style="margin-left: 0;">
                            <input type="radio" name="type" value="1" title="Full Time" checked="">
                            <input type="radio" name="type" value="2" title="Part Time">
                            <input type="radio" name="type" value="3" title="Practice">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 64px;">
                            <img src="/Public/Web/web/img/04_jobs/jobs_sy_icon_08.png">
                        </label>
                        <div class="layui-input-block" style="margin-left: 64px;">
                            <input type="text" name="position" id="position" lay-verify="title" autocomplete="off" placeholder="Enter a job title" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-inline">
                            <label class="layui-form-label" style="width: 64px;">
                                <img src="/Public/Web/web/img/04_jobs/jobs_create_icon_money.png">
                            </label>
                            <div class="layui-input-inline" style="width: 100px;">
                                <input type="text" name="minmoney" id="minmoney" placeholder="￥" autocomplete="off" class="layui-input">
                            </div>
                            <div class="layui-form-mid">-</div>
                            <div class="layui-input-inline" style="width: 100px;">
                                <input type="text" name="maxmoney" id="maxmoney" placeholder="￥" autocomplete="off" class="layui-input">
                            </div>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 64px;">
                            <img src="/Public/Web/web/img/04_jobs/jobs_sy_icon_07.png" width="24px" height="auto">
                        </label>
                        <div class="layui-input-block" style="margin-left: 64px;">
                            <input type="text" name="years" id="years" lay-verify="title" autocomplete="off" placeholder="Enter the number of years of service" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 64px;">
                            <img src="/Public/Web/web/img/04_jobs/jobs_create_icon_school.png">
                        </label>
                        <div class="layui-input-block" style="margin-left: 64px;">
                            <input type="text" name="school" id="school" lay-verify="title" autocomplete="off" placeholder="Enter a graduate school" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 64px;">
                            <img src="/Public/Web/web/img/04_jobs/1.png">
                        </label>
                        <div class="layui-input-block" style="margin-left: 64px;">
                            <input type="text" name="degree" id="degree" lay-verify="title" autocomplete="off" placeholder="Enter your degree" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 64px;">
                            <img src="/Public/Web/web/img/04_jobs/jobs_create_icon_major.png">
                        </label>
                        <div class="layui-input-block" style="margin-left: 64px;">
                            <input type="text" name="specialty" id="specialty" lay-verify="title" autocomplete="off" placeholder="Enter professional" class="layui-input">
                        </div>
                    </div>
                    <!--<p class="h6">Matching circle reordering : </p>
                    <div class="layui-form-item">
                        <select name="interest" lay-filter="aihao">
                            <option value="" selected="">Graduated School</option>
                            <option value="0">1</option>
                            <option value="1">2</option>
                        </select>
                        <p class="text-center" style="margin: 4px 0;">
                            <img src="/Public/Web/web/img/04_jobs/2.png">
                        </p>
                    </div>
                    <div class="layui-form-item">
                        <select name="interest" lay-filter="aihao">
                            <option value="" selected="">Years of service</option>
                            <option value="0">1</option>
                            <option value="1">2</option>
                        </select>
                        <p class="text-center" style="margin: 4px 0;">
                            <img src="/Public/Web/web/img/04_jobs/2.png">
                        </p>
                    </div>
                    <div class="layui-form-item">
                        <select name="interest" lay-filter="aihao">
                            <option value="" selected="">Bachelor of Science</option>
                            <option value="0">1</option>
                            <option value="1">2</option>
                        </select>
                        <p class="text-center" style="margin: 4px 0;">
                            <img src="/Public/Web/web/img/04_jobs/2.png">
                        </p>
                    </div>
                    <div class="layui-form-item">
                        <select name="interest" lay-filter="aihao">
                            <option value="" selected="">Position</option>
                            <option value="0">1</option>
                            <option value="1">2</option>
                        </select>
                        <p class="text-center" style="margin: 4px 0;">
                            <img src="/Public/Web/web/img/04_jobs/2.png">
                        </p>
                    </div>
                    <div class="layui-form-item">
                        <select name="interest" lay-filter="aihao">
                            <option value="" selected="">Profession</option>
                            <option value="0">1</option>
                            <option value="1">2</option>
                        </select>
                        <p class="text-center" style="margin: 4px 0;">
                            <img src="/Public/Web/web/img/04_jobs/2.png">
                        </p>
                    </div>
                    <div class="layui-form-item">
                        <select name="interest" lay-filter="aihao">
                            <option value="" selected="">position</option>
                            <option value="0">1</option>
                            <option value="1">2</option>
                        </select>
                    </div>-->
                    <p class="h6 text-center">Company Information</p>
                    <div class="layui-form-item layui-form-item">
                        <label class="layui-form-label" style="width: 64px;">
                            <img src="/Public/Web/web/img/04_jobs/jobs_create_icon_company.png">
                        </label>
                        <div class="layui-input-block" style="margin-left: 64px;">
                            <input type="text" name="company_name" id="company_name" lay-verify="title" autocomplete="off" placeholder="Company name" class="layui-input">
                        </div>
                    </div>
                    <div class="FormContainer layui-form-item" pane>
                        <label class="layui-form-label label-spacing">
                            <img src="/Public/Web/web/img/04_jobs/jobs_create_icon_choose.png">
                        </label>
                        <div class="layui-input-block" id="layui-input-block">
                            <select name="company_nature" id="company_nature" lay-verify="required">
                                <option value="">Please choose the nature of the company</option>
                                <option value="1">Private</option>
                                <option value="2">state-owned</option>
                            </select>
                        </div>
                    </div>
                    <div class="FormContainer layui-form-item" pane>
                        <label class="layui-form-label label-spacing">
                            <img src="/Public/Web/web/img/04_jobs/jobs_create_icon_type.png">
                        </label>
                        <div class="layui-input-block" id="layui-input-block">
                            <select name="company_type" id="company_type" lay-verify="required">
                                <option value="">Please select company type</option>
                                <?php if(is_array($companytypelist)): foreach($companytypelist as $k=>$c): ?><option value="<?php echo ($c['works_company_type_id']); ?>"><?php echo ($c['works_company_type_name']); ?></option><?php endforeach; endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 64px;">
                            <img src="/Public/Web/web/img/04_jobs/jobs_create_icon_groupname.png">
                        </label>
                        <div class="layui-input-block" style="margin-left: 64px;">
                            <input type="text" name="company_size" id="company_size" lay-verify="title" autocomplete="off" placeholder="Enter the company size" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 64px;">
                            <img src="/Public/Web/web/img/04_jobs/jobs_create_icon_email.png">
                        </label>
                        <div class="layui-input-block" style="margin-left: 64px;">
                            <input type="text" name="company_mail" id="company_mail" lay-verify="title" autocomplete="off" placeholder="Enter the resume mailbox" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item layui-form-text" style="height: 100px;">
                        <label class="layui-form-label" style="width: 12%;z-index: 2;background: none;border: none;">
                            <img src="/Public/Web/web/img/04_jobs/jobs_create_icon_write.png">
                        </label>
                        <div class="layui-input-block" style="position: relative;top: -46px;">
                            <textarea placeholder="Enter the company information" name="company_content" id="company_content" class="layui-textarea" style="padding: 12px 58px 0;"></textarea>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="background: none;border: none;margin-left: -20px;width: 154px;">
                            Salary Negotiable
                        </label>
                        <div class="layui-input-block" style="margin-left: 0;">
                            <input type="radio" name="isnegotiable" value="no" title="no" checked="">
                            <input type="radio" name="isnegotiable" value="yes" title="yes">
                        </div>
                    </div>
                    <div class="FormContainer from-but" style="margin-top: 0;">
                        <button class="layui-btn layui-btn-normal layui-btn-radius Submit-but" lay-submit="demo1" lay-filter="demo1">
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
    <script src="/Public/Web/web/js/ListOfDonations.js"></script>
    <script src="/Public/Web/web/js/loginQuit.js"></script>
</body>

<script>

    layui.use('form', function(){
        var form = layui.form;

        form.on('submit(demo1)', function(data){

            var type = $("input[name='type']:checked").val();
            var position = $("#position").val();
            var minmoney = $("#minmoney").val();
            var maxmoney = $("#maxmoney").val();
            var years = $("#years").val();
            var school = $("#school").val();
            var degree = $("#degree").val();
            var specialty = $("#specialty").val();
            var company_name = $("#company_name").val();
            var company_nature = $("#company_nature").val();
            var company_type = $("#company_type").val();
            var company_size = $("#company_size").val();
            var company_mail = $("#company_mail").val();
            var company_content = $("#company_content").val();
            var isnegotiable = $("input[name='isnegotiable']:checked").val();


            $.ajax({
                type:"post",
                url:"<?php echo U('Index/Ajax/ajax_createworks');?>",
                data:{
                    type:type,
                    position:position,
                    minmoney:minmoney,
                    maxmoney:maxmoney,
                    years:years,
                    school:school,
                    degree:degree,
                    specialty:specialty,
                    company_name:company_name,
                    company_nature:company_nature,
                    company_type:company_type,
                    company_size:company_size,
                    company_mail:company_mail,
                    company_content:company_content,
                    isnegotiable:isnegotiable,
                },
                dataType:"json",
                async:false,
                success: function(works){

                    if (works!=null&&works!="") {
                        if (works.str == 1) {

                            layer.msg(works.msg,{
                                    time:1500,
                                    icon:1,
                                },function () {
                                    window.location.href="<?php echo U('Index/Jobs/jobList');?>";
                                }
                            );

                        }else{
                            layer.msg(works.msg,{
                                    time:1500,
                                    icon:2,
                                },sendverify()
                            );
                        }

                    }else{
                        layer.msg('请求错误!',{
                                time:1500,
                                icon:2,
                            },sendverify()
                        );
                    }

                },
                error:function(XMLHttpRequest, textStatus, errorThrown){

                    layer.msg('请求失败!',{
                            time:1500,
                            icon:2,
                        },sendverify()
                    );
                }

            })
            return false; //阻止表单跳转。如果需要表单跳转，去掉这段即可。
        });

    });

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
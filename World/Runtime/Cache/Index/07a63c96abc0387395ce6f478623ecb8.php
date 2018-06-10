<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Resume Details</title>
        <meta name="viewport" content="width=device-width, initial-scale=0 user-scalable=no, maximum-scale=1.0, minimum-scale=1.0">
        <link rel="stylesheet" href="/Public/Web/web/css/register.css">
        <link rel="stylesheet" href="/Public/Web/web/css/Donation.css">
        <link rel="stylesheet" href="/Public/Web/web/css/Crumbsnav.css">
        <link rel="stylesheet" href="/Public/Web/web/css/CreateAcademic.css">
        <link rel="stylesheet" href="../js/lib/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="/Public/Web/js/lib/bootstrap/dist/css/bootstrap-grid.min.css">
        <link rel="stylesheet" href="/Public/Web/js/lib/bootstrap/dist/css/bootstrap-reboot.min.css">
        <link rel="stylesheet" href="/Public/Web/js/lib/layui/dist/css/layui.css">
        <link rel="stylesheet" href="/Public/Web/web/css/Crumbsnav.css">
        <link rel="stylesheet" href="/Public/Web/web/css/success_index.css">
        <link rel="stylesheet" href="/Public/Web/web/css/ResumeDetails.css">
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
        <?php if($goindex == 1): ?><a href="<?php echo U('Index/Index/index');?>" class="crumbsa"><img src="/Public/Web/web/img/common_dh_icon_home.png" alt=""></a>
        <?php else: ?>
            <a href="<?php echo U('Index/Jobs/jobList');?>" class="crumbsa">Jobs List</a><?php endif; ?>
        <cite class="Icon"></cite>
        <span class="crumbsTitle">Resume details</span>
    </div>
    
    <!-- ResumeDetails content -->
    <div class="container">
    <div class="Resumetails_content">
            <div class="Resumetails_title">
                <div class="title_item">
                    <a href="DeliveryRecord.html">
                        Delivery record
                    </a>
                </div>
                <div class="title_item">
                    <a href="ResumeTemplateList.html">
                        Resume template
                    </a>
                </div>
                <div class="title_item AutoDelivery">
                    <a href="#">
                        Automatic delivery
                    </a>
                </div>
            </div>

            <div class="Resume_details">
                <form action="" class="layui-form layui-form-pane">
                    <div class="form_box">
                        <div class="form_title">
                            <div class="form_title_img">
                                <img src="/Public/Web/web/img/common_icon_write.png" alt="">
                            </div>
                            <h3>Basic Information</h3>
                        </div>
                        <div class="form_details">

                            <div class="form_details_item">
                                <div class="form_details_left">
                                    <div class="form_details_item_img">
                                        <img src="/Public/Web/web/img/02_interest/interest_qxx_fb_icon_02.png" alt="">
                                    </div>
                                </div>
                                <div class="layui-input-block">
                                    <input type="radio" name="JobTime" value="1" title="Full Time" <?php if(!$resumeone["resume_tid"]||$resumeone["resume_tid"]==1): ?>checked<?php endif; ?>>
                                    <input type="radio" name="JobTime" value="2" title="Part Time" <?php if($resumeone["resume_tid"]==2): ?>checked<?php endif; ?>>
                                    <input type="radio" name="JobTime" value="3" title="Practice" <?php if($resumeone["resume_tid"]==3): ?>checked<?php endif; ?>>
                                </div>
                            </div>

                            <div class="form_details_item">
                                    <div class="form_details_left form_details_item_border">
                                            <div class="form_details_item_img">
                                                <img src="/Public/Web/web/img/02_interest/interest_sy_gl_icon_renshu.png" alt="">
                                            </div>
                                        </div>
                                    <div class="layui-input-block">
                                        <input type="text" name="title" id="name" required  lay-verify="required" placeholder="Enter the real name" autocomplete="off" <?php if($resumeone["resume_name"]): ?>value="<?php echo ($resumeone['resume_name']); ?>"<?php endif; ?> class="layui-input">
                                    </div>
                            </div>

                            <div class="form_details_item">
                                    <div class="form_details_left form_details_item_border">
                                            <div class="form_details_item_img">
                                                <img src="/Public/Web/web/img/06_gerenzhongxin/grzx_sz_icon_06.png" alt="">
                                            </div>
                                        </div>
                                    <div class="layui-input-block">
                                        <input type="text" name="title" id="position" required  lay-verify="required" placeholder="Enter a job title" autocomplete="off" <?php if($resumeone["resume_position"]): ?>value="<?php echo ($resumeone['resume_position']); ?>"<?php endif; ?> class="layui-input">
                                    </div>
                            </div>


                            <div class="form_details_item">
                                    <div class="form_details_left form_details_item_border">
                                            <div class="form_details_item_img">
                                                <img src="/Public/Web/web/img/06_gerenzhongxin/grzx_icon_money.png" alt="">
                                            </div>
                                        </div>
                                    <div class="layui-input-block">
                                            <div class="layui-input-inline">
                                                <input type="text" name="price_min" id="lowmoney" placeholder="$" autocomplete="off" <?php if($resumeone["resume_lowmoney"]): ?>value="<?php echo ($resumeone['resume_lowmoney']); ?>"<?php endif; ?> class="layui-input">
                                            </div>
                                                <div class="layui-form-mid">~</div>
                                            <div class="layui-input-inline">
                                                <input type="text" name="price_max" id="hightmoney" placeholder="$" autocomplete="off" <?php if($resumeone["resume_hightmoney"]): ?>value="<?php echo ($resumeone['resume_hightmoney']); ?>"<?php endif; ?> class="layui-input">
                                            </div>
                                    </div>
                            </div>

                            <div class="form_details_item">
                                    <div class="form_details_left form_details_item_border">
                                            <div class="form_details_item_img">
                                                <img src="/Public/Web/web/img/06_gerenzhongxin/grzx_homepage_xinxi_icon_03.png" alt="">
                                            </div>
                                        </div>
                                    <div class="layui-input-block">
                                        <input type="text" name="title" id="workyear" required  lay-verify="required" placeholder="Enter the number of years of service" autocomplete="off" <?php if($resumeone["resume_workyear"]): ?>value="<?php echo ($resumeone['resume_workyear']); ?>"<?php endif; ?> class="layui-input">
                                    </div>
                            </div>

                            <div class="form_details_item">
                                    <div class="form_details_left form_details_item_border">
                                            <div class="form_details_item_img">
                                                <img src="/Public/Web/web/img/02_interest/interest_create_icon_02.png" alt="">
                                            </div>
                                        </div>
                                    <div class="layui-input-block">
                                        <input type="text" name="title" id="university" required  lay-verify="required" placeholder="Enter a graduate school" autocomplete="off" <?php if($resumeone["resume_university"]): ?>value="<?php echo ($resumeone['resume_university']); ?>"<?php endif; ?> class="layui-input">
                                    </div>
                            </div>

                            <div class="form_details_item">
                                    <div class="form_details_left form_details_item_border">
                                            <div class="form_details_item_img">
                                                <img src="/Public/Web/web/img/06_gerenzhongxin/degree.png" alt="">
                                            </div>
                                        </div>
                                    <div class="layui-input-block">
                                        <input type="text" name="title" id="degree" required  lay-verify="required" placeholder="Enter your degree" autocomplete="off" <?php if($resumeone["resume_degree"]): ?>value="<?php echo ($resumeone['resume_degree']); ?>"<?php endif; ?> class="layui-input">
                                    </div>
                            </div>

                            <div class="form_details_item">
                                    <div class="form_details_left form_details_item_border">
                                            <div class="form_details_item_img">
                                                <img src="/Public/Web/web/img/03_academic/academic_create_icon_04.png" alt="">
                                            </div>
                                        </div>
                                    <div class="layui-input-block">
                                        <input type="text" name="title" id="specialty" required  lay-verify="required" placeholder="Enter professional" autocomplete="off" <?php if($resumeone["resume_specialty"]): ?>value="<?php echo ($resumeone['resume_specialty']); ?>"<?php endif; ?> class="layui-input">
                                    </div>
                            </div>

                            <div class="form_details_item">
                                    <div class="form_details_middle">
                                            Upload resume : 
                                    </div>
                                    <div class="layui-input-block">
                                        <div class="addImages">
                                            <div class="files_name"><span> <?php if($resumeone["resume_fileurl"]): echo ($resumeone['resume_fileurl']); else: ?>Choose to upload the resume file<?php endif; ?></span></div>
                                            <button type="button" class="layui-btn layui-btn-normal" id="testList">Browse</button>
                                        </div>
                                    </div>
                            </div>

                            <div class="form_details_item">
                                <div class="form_details_middle">
                                            Salary Negotiable :
                                </div>
                                <div class="layui-input-block">
                                    <input type="radio" name="isnegotiable" value="0" title="no" <?php if(!$resumeone["resume_isnegotiable"]||$resumeone["resume_isnegotiable"]==0): ?>checked<?php endif; ?>>
                                    <input type="radio" name="isnegotiable" value="1" title="yes" <?php if($resumeone["resume_isnegotiable"]==1): ?>checked<?php endif; ?>>
                                </div>
                            </div>

                            <div class="form_details_item">
                                <div class="form_details_middle">
                                    Upload status :
                                </div>
                                <div class="layui-input-block">
                                    <p><?php if($resumeone["resume_status"]==1): ?>To be delivered<?php endif; if(!$resumeone["resume_status"]||$resumeone["resume_status"]==0): ?>To be prefect<?php endif; ?></p>
                                </div>
                            </div>

                            <div class="form_details_item item_btn" style="cursor: pointer;" lay-submit="demo1" lay-filter="demo1">
                                    <button>Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="ResumeDetails_shadow">
        <div class="shadow_box">
            <h2>warm prompt</h2>
            <div class="shadow_quit">x</div>
            <span>Automatic delivery successful</span>
        </div>
        
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
    </body>
        <script src="/Public/Web/js/lib/jquery/dist/jquery.min.js"></script>
		<script src="/Public/Web/js/lib/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
		<script src="/Public/Web/js/lib/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="/Public/Web/js/lib/layui/dist/layui.all.js"></script>
        <script src="/Public/Web/web/js/loginQuit.js"></script>
        <script>
            var fileone
            if ('<?php echo ($resumeone["resume_fileurl"]); ?>'){
                fileone = 1
            }

            var $ = layui.jquery,upload = layui.upload;
            var demoListView = $('.addImages .files_name'), uploadListIns = upload.render({
                     elem: '#testList'
                        ,url: 'yourUrl'
                        ,accept: 'file'
                        ,data:{}   //可放扩展数据  key-value
                        ,multiple: true
                        ,auto: false
                        ,bindAction: '#testListAction',elem: '#testList'
                        ,url: 'yourUrl'
                        ,accept: 'file'
                        ,data:{}   //可放扩展数据  key-value
                        ,multiple: true
                        ,auto: false
                        ,bindAction: '#testListAction',
                        choose:function(obj){
                            obj.preview(function(index, file, result){
                                var tr = $(['<span>'+file.name+'</span>'].join(''));
                                fileone = file;
                                demoListView.eq(0)[0].childNodes[0].remove();
                                demoListView.append(tr);
                            }) 
                        }
                })

            layui.use('form', function(){
                var form = layui.form;

                form.on('submit(demo1)', function(data){

                    var fd = new FormData();
                    fd.append('img', fileone);

                    if (fileone == 1){

                        $.ajax({
                            type: "post",
                            url: "<?php echo U('Index/Ajax/ajax_resumedetails');?>",
                            data: {
                                name: $("#name").val(),
                                position: $("#position").val(),
                                tid: $("input[name='JobTime']:checked").val(),
                                lowmoney: $("#lowmoney").val(),
                                hightmoney: $("#hightmoney").val(),
                                workyear: $("#workyear").val(),
                                university: $("#university").val(),
                                degree: $("#degree").val(),
                                specialty: $("#specialty").val(),
                                fileurl: '<?php echo ($resumeone["resume_fileurl"]); ?>',
                                isnegotiable: $("input[name='isnegotiable']:checked").val(),

                            },
                            dataType: "json",
                            async: false,
                            success: function (resume) {

                                if (resume != null && resume != "") {
                                    if (resume.str == 1) {

                                        layer.msg(resume.msg, {
                                                time: 1500,
                                                icon: 1,
                                            }, function () {

                                                location.reload();
                                            }
                                        );

                                    } else {
                                        layer.msg(resume.msg, {
                                                time: 1500,
                                                icon: 2,
                                            }
                                        );
                                    }

                                } else {
                                    layer.msg('请求错误!', {
                                            time: 1500,
                                            icon: 2,
                                        }
                                    );
                                }

                            },
                            error: function (XMLHttpRequest, textStatus, errorThrown) {

                                layer.msg('请求失败!', {
                                        time: 1500,
                                        icon: 2,
                                    }
                                );
                            }

                        })

                    }else {
                        $.ajax({
                            url: "<?php echo U('Index/Ajax/ajax_uploadfile');?>",
                            type: "POST",
                            async: false,
                            cache: false,
                            processData: false,// 告诉jQuery不要去处理发送的数据
                            contentType: false,// 告诉jQuery不要去设置Content-Type请求头
                            data: fd,
                            dataType: "json",
                            success: function (data) {
                                console.log(data)
                                if (data.str == 1) {
                                    $.ajax({
                                        type: "post",
                                        url: "<?php echo U('Index/Ajax/ajax_resumedetails');?>",
                                        data: {
                                            name: $("#name").val(),
                                            position: $("#position").val(),
                                            tid: $("input[name='JobTime']:checked").val(),
                                            lowmoney: $("#lowmoney").val(),
                                            hightmoney: $("#hightmoney").val(),
                                            workyear: $("#workyear").val(),
                                            university: $("#university").val(),
                                            degree: $("#degree").val(),
                                            specialty: $("#specialty").val(),
                                            fileurl: data.msg,
                                            isnegotiable: $("input[name='isnegotiable']:checked").val(),

                                        },
                                        dataType: "json",
                                        async: false,
                                        success: function (resume) {
                                            if (resume != null && resume != "") {
                                                if (resume.str == 1) {

                                                    layer.msg(resume.msg, {
                                                            time: 1500,
                                                            icon: 1,
                                                        }, function () {

                                                            location.reload();
                                                        }
                                                    );


                                                } else {
                                                    layer.msg(resume.msg, {
                                                            time: 1500,
                                                            icon: 2,
                                                        }
                                                    );
                                                }

                                            } else {
                                                layer.msg('请求错误!', {
                                                        time: 1500,
                                                        icon: 2,
                                                    }
                                                );
                                            }

                                        },
                                        error: function (XMLHttpRequest, textStatus, errorThrown) {

                                            layer.msg('请求失败!', {
                                                    time: 1500,
                                                    icon: 2,
                                                }
                                            );
                                        }

                                    })

                                } else {
                                    layer.msg('文件上传失败!', {
                                            time: 1500,
                                            icon: 2,
                                        }
                                    );
                                }

                            },
                            error: function (err) {

                                layer.msg('请求失败!', {
                                        time: 1500,
                                        icon: 2,
                                    }
                                );
                            }
                        });
                    }

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
        <script>
            $(".Resumetails_content .Resumetails_title .AutoDelivery").on("click",function(){
                $(".ResumeDetails_shadow").css("display","block")
            })
            $(".ResumeDetails_shadow .shadow_box .shadow_quit").on("click",function(){
                $(".ResumeDetails_shadow").css("display","none")
            })
        </script>


<script>



</script>
</html>
<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Group details release</title>
    <meta name="viewport" content="width=device-width, initial-scale=0 user-scalable=no, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="/Public/Web/web/css/register.css">
    <link rel="stylesheet" href="/Public/Web/web/css/Donation.css">
    <link rel="stylesheet" href="/Public/Web/web/css/CreateInterest.css">
    <link rel="stylesheet" href="/Public/Web/web/css/GroupDetailsRelease.css">
    <link rel="stylesheet" href="/Public/Web/js/lib/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Public/Web/js/lib/bootstrap/dist/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="/Public/Web/js/lib/bootstrap/dist/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="/Public/Web/js/lib/layui/dist/css/layui.css">
    <link rel="stylesheet" href="/Public/Web/web/css/Crumbsnav.css">
    <link rel="stylesheet" href="/Public/Web/web/css/success_index.css">
    <link rel="stylesheet" href="/Public/Web/web/css/EditResource.css">
    <link rel="stylesheet" href="/Public/Web/web/css/changeimg.css">
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
        <a href="Interest.html" class="crumbsa">interest</a>
        <cite class="Icon"></cite>
        <a href="GroupDetails.html" class="crumbsa">Group name</a>
        <cite class="Icon"></cite>
        <span class="crumbsTitle">Relase</span>
    </div>

    <!-- Forget the password form -->
    <form class="layui-form layui-form-pane" action="" id="formdata">
        <div class="PasswordContainer">
            <div class="StepContainer">
                <div class="StepContainerOne">
                    <div class="InterestTitle">
                        <h3 class="text-center Interesth3">
                            Post basic information
                        </h3>
                    </div>
                    <div class="FormContainer" pane>
                        <label class="layui-form-label label-spacing">
                            <span class="TitlesIcon"></span>
                        </label>
                        <div class="layui-input-block input-spacing">
                            <input type="text" name="number" id="name" lay-verify="required" autocomplete="off" placeholder="Enter the title" class="layui-input">
                        </div>
                    </div>
                    <div class="FormContainer" pane>
                        <label class="layui-form-label label-spacing">
                            <span class="TypesIcon"></span>
                        </label>
                        <div class="layui-input-block" id="layui-input-block">
                            <select name="city" lay-verify="required" class="select_use" lay-filter="test">
                                <?php if(is_array($tablist)): foreach($tablist as $tabkey=>$tab): ?><option value="<?php echo ($tab['crowd_tab_id']); ?>"><?php echo ($tab['crowd_tab_name']); ?></option><?php endforeach; endif; ?>
                            </select>
                        </div>
                    </div>

                    <div class="Post_box">
                        <div class="FormContainer" pane>
                            <label class="layui-form-label label-spacing">
                                <span class="ContentsIcon"></span>
                            </label>
                            <div class="layui-input-block input-spacing">
                                <input type="text" name="number" id="postcontent" autocomplete="off" placeholder="Enter the content" class="layui-input">
                            </div>
                        </div>

                    </div>

                    <div class="QaA_box">
                        <div class="FormContainer" pane>
                            <label class="layui-form-label label-spacing">
                                <span class="MoneyIcon"></span>
                            </label>
                            <div class="layui-input-block input-spacing">
                                <input type="text" name="number" id="qareward"  autocomplete="off" placeholder="Enter the amount of the reward" class="layui-input">
                            </div>
                        </div>
                        <div class="FormContainer" pane>
                            <label class="layui-form-label label-spacing">
                                <span class="ContentsIcon"></span>
                            </label>
                            <div class="layui-input-block input-spacing">
                                <input type="text" name="number" id="qacontent"  autocomplete="off" placeholder="Enter the content" class="layui-input">
                            </div>
                        </div>

                    </div>

                    <div class="Resource_box">
                        <div class="FormContainer" pane>
                            <label class="layui-form-label label-spacing">
                                <span class="NumberIcon"></span>
                            </label>
                            <div class="layui-input-block input-spacing">
                                <input type="text" name="number" id="resourcereward" autocomplete="off" placeholder="Enter numbers of virtual currency to download" class="layui-input">
                            </div>
                        </div>
                        <div class="FormContainer" pane>
                            <label class="layui-form-label label-spacing">
                                <span class="ContentsIcon"></span>
                            </label>
                            <div class="layui-input-block input-spacing">
                                <input type="text" name="number" id="resourcecontent" autocomplete="off" placeholder="Enter the resource description" class="layui-input">
                            </div>
                        </div>
                        <div class="FormContainer-one" pane>
                            <label class="HeadPortraitbox-one">
                                <span class="filesIcon">Upload resources</span>
                            </label>
                            <div class="picDiv-one">
                                <div class="addImages">
                                        <div class="files_name"><span>Choose to upload the resume file</span></div>
                                        <button type="button" class="layui-btn layui-btn-normal" id="testList">Browse</button> 
                                </div>
                            </div>
                            <div class="msg" style="display: none;"></div>
                        </div>

                    </div>

                    <div class="FormContainer" pane>
                        <label class="HeadPortraitbox">
                            <span class="HeadPortraitIcon"></span>
                        </label>
                        <div class="picDiv">
                            <div id="video" class="w50" style="display: none;"></div>
                            <div id="result">
                                <div class="add_btn" data-isNew="false">
                                    <input type="file" name="file_input[]" id="file_input" multiple onchange="xmTanUploadImg(this)" />
                                    <span>+</span>
                                </div>
                                <div class="shadow_video">
                                    </div>
                                            <div class="video_box">
                                                <div class="video_shut">x</div>
                                                <div class="video_area">
                                                <!-- <video width="100%" height="100%">
                                                        <source src="../web/img/video.mp4" type="video/mp4"></source>
                                                    </video>
                                                </div> -->
                                            </div>
                                </div>
                            </div>
                        </div>
                        <div class="msg" style="display: none;"></div>
                    </div>

                    <div class="FormContainer from-but">
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
    <script src="/Public/Web/web/js/GroupDetailsRelease.js"></script>
    <script src="/Public/Web/web/js/loginQuit.js"></script>
    <script src="/Public/Web/web/js/changeimg.js"></script>
    <script>
        var resourcefile=''
        var $ = layui.jquery,upload = layui.upload;
        var demoListView = $('.FormContainer-one .picDiv-one .addImages .files_name'),
        uploadListIns = upload.render({
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
                        demoListView.eq(0)[0].childNodes[0].remove();
                        demoListView.append(tr);
                        resourcefile = file
                    }) 
                }
        })
    </script>
    <script>
            var form = layui.form;
            var selectedValue =1
            form.on('select',function(data){
                console.log(data.value);
                selectedValue = data.value;
                console.log(selectedValue)
                if(selectedValue==1){
                    $(".Post_box").css("display","block");
                    $(".QaA_box").css("display","none");
                    $(".Resource_box").css("display","none");
                }
                if(selectedValue==2){
                    $(".Post_box").css("display","none");
                    $(".QaA_box").css("display","block");
                    $(".Resource_box").css("display","none");

                }
                if(selectedValue==3){
                    $(".Post_box").css("display","none");
                    $(".QaA_box").css("display","none");
                    $(".Resource_box").css("display","block");
                }


            })

            layui.use('form', function(){
                var form = layui.form;

                form.on('submit(demo1)', function(data){


                    if (selectedValue ==1 ) {
                        var file_files = document.getElementById('file_input').files;
                        var file_obj = document.getElementById('formdata');
                        var fd = new FormData();
                        for (var i = 0; i < file_files.length; i++){
                            console.log(file_files[i])
                            fd.append('img['+i+']',file_files[i])
                        }
                        fd.append('name',$("#name").val())
                        fd.append('content',$("#postcontent").val())
                        fd.append('cid','<?php echo ($cid); ?>')
                        $.ajax({
                            url: "<?php echo U('Index/Ajax/ajax_createnote');?>",
                            type: "POST",
                            async: false,
                            cache: false,
                            processData: false,// 告诉jQuery不要去处理发送的数据
                            contentType: false,// 告诉jQuery不要去设置Content-Type请求头
                            data: fd,
                            dataType: "json",
                            success: function (data) {
                                if (data.str == 1){
                                    layer.msg('创建成功',{
                                            time:1500,
                                            icon:1,
                                        },function () {
                                            window.location.href="<?php echo U('Index/Rnterst/postVideoDetails');?>&nid="+data.msg;
                                        }
                                    );

                                }else{
                                    layer.msg(data.msg,{
                                            time:1500,
                                            icon:2,
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
                    }else if (selectedValue ==2 ){

                    }


                    return false; //阻止表单跳转。如果需要表单跳转，去掉这段即可。
                });
            });
    </script>
</body>

</html>
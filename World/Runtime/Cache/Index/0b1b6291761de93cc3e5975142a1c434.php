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
    <div class="container Crumbs">
        <span class="CrumbsSpan">
          <a href="<?php echo U('Index/Rnterst/interest');?>" class="CrumbsA">Interest</a>
          <cite class="CrumbsIcon"></cite>
          <span class="CrumbsTitle"><a href="<?php echo U('Index/Rnterst/groupDetails');?>" class="CrumbsA">Group name</a></span>
        <cite class="CrumbsIcons"></cite>
        <span class="CrumbsTitles">Release</span>
        </span>
    </div>
    <!-- Forget the password form -->
    <form class="layui-form layui-form-pane" action="">
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
                            <input type="text" name="number" lay-verify="required" autocomplete="off" placeholder="Enter the title" class="layui-input">
                        </div>
                    </div>
                    <div class="FormContainer" pane>
                        <label class="layui-form-label label-spacing">
                            <span class="TypesIcon"></span>
                        </label>
                        <div class="layui-input-block" id="layui-input-block">
                            <select name="city" lay-verify="required">
                                <?php if(is_array($tablist)): foreach($tablist as $tabkey=>$tab): ?><option value="<?php echo ($tab['crowd_tab_id']); ?>"><?php echo ($tab['crowd_tab_name']); ?></option><?php endforeach; endif; ?>

                            </select>
                        </div>
                    </div>
                    <div class="FormContainer" pane>
                        <label class="layui-form-label label-spacing">
                            <span class="ContentsIcon"></span>
                        </label>
                        <div class="layui-input-block input-spacing">
                            <input type="text" name="number" lay-verify="required" autocomplete="off" placeholder="Enter the content" class="layui-input">
                        </div>
                    </div>
                    <div class="FormContainer" pane>
                        <label class="HeadPortraitbox">
                            <span class="HeadPortraitIcon"></span>
                        </label>
                        <div class="picDiv">
                            <div class="addImages" id="addfile">
                                <!--multiple属性可选择多个图片上传-->
                                <input type="file" class="file" id="fileInput" multiple="" accept="image/png, image/jpeg, image/gif, image/jpg">
                                <div class="text-detail">
                                    <span>+</span>
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
    <script src="/Public/Web/web/js/GroupDetailsRelease.js"></script>
    <script src="/Public/Web/web/js/loginQuit.js"></script>
    <!--<script src="/Public/Web/web/js/GroupDetailsRelease.js"></script>-->
</body>


<script>


    layui.use('form', function(){
        var form = layui.form;

        form.on('submit(demo1)', function(data){

            var filelist = $(".file")[0].files;

            console.log(filelist[0].type)

            $.ajax({
                type:"post",
                url:"<?php echo U('Index/Ajax/ajax_createdonation');?>",
                data:{
                },
                dataType:"json",
                async:false,
                success: function(data){

                    if (data!=null&&data!="") {

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
            return false; //阻止表单跳转。如果需要表单跳转，去掉这段即可。
        });

    });


    var imgnum = 0;
    var videonum = 0;
    //图片上传预览功能
    var userAgent = navigator.userAgent; //用于判断浏览器类型

    $(".file").change(function() {
        //获取选择图片的对象
        var docObj = $(this)[0];
        var picDiv = $(this).parents(".picDiv");
        //得到所有的图片文件
        var fileList = docObj.files;
        //循环遍历
        for (var i = 0; i < fileList.length; i++) {

            console.log(fileList[i])
            if(fileList[i].type == 'video/mp4'){


                var videoHtml = "<div class='imageDiv' > <video id='img" + fileList[i].name + "' ></video> <div class='cover'><i class='delbtn'>delete</i></div></div>";
                picDiv.prepend(videoHtml);
                var imgObjPreview = document.getElementById("img" + fileList[i].name);
                imgObjPreview.src = window.URL.createObjectURL(docObj.files[i]);
                imgObjPreview.style.display = 'block';
                imgObjPreview.style.width = '160px';
                imgObjPreview.style.height = '130px';

            }

            //动态添加html元素
            var picHtml = "<div class='imageDiv' > <img id='img" + fileList[i].name + "' /> <div class='cover'><i class='delbtn'>delete</i></div></div>";
            //console.log(picHtml);
            picDiv.prepend(picHtml);
            imgnum +=1;
            //获取图片imgi的对象
            var imgObjPreview = document.getElementById("img" + fileList[i].name);
            if (fileList && fileList[i]) {
                //图片属性
                imgObjPreview.style.display = 'block';
                imgObjPreview.style.width = '160px';
                imgObjPreview.style.height = '130px';
                //imgObjPreview.src = docObj.files[0].getAsDataURL();
                //火狐7以上版本不能用上面的getAsDataURL()方式获取，需要以下方式
                if (userAgent.indexOf('MSIE') == -1) {
                    //IE以外浏览器
                    imgObjPreview.src = window.URL.createObjectURL(docObj.files[i]); //获取上传图片文件的物理路径;
                    console.log(imgObjPreview.src);
                    // var msgHtml = '<input type="file" id="fileInput" multiple/>';
                } else {
                    //IE浏览器
                    if (docObj.value.indexOf(",") != -1) {
                        var srcArr = docObj.value.split(",");
                        imgObjPreview.src = srcArr[i];
                    } else {
                        imgObjPreview.src = docObj.value;
                    }
                }

            }
            document.getElementById("addfile").style.visibility="hidden";
        }

        /*删除功能*/
        $(".delbtn").click(function() {
            var _this = $(this);
            _this.parents(".imageDiv").remove();
            imgnum -= 1 ;
            if (imgnum == 0&&videonum == 0){
                document.getElementById("addfile").style.visibility="visible";
            }
        });
    });

</script>


</html>
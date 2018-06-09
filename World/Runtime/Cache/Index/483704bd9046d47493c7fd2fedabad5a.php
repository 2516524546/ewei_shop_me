<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<title>Create academic</title>
		<meta name="viewport" content="width=device-width, initial-scale=0 user-scalable=no, maximum-scale=1.0, minimum-scale=1.0">
		<link rel="stylesheet" href="/Public/Web/web/css/register.css">
		<link rel="stylesheet" href="/Public/Web/web/css/Donation.css">
		<link rel="stylesheet" href="/Public/Web/web/css/CreateAcademic.css">
		<link rel="stylesheet" href="/Public/Web/js/lib/bootstrap/dist/css/bootstrap.min.css">
		<link rel="stylesheet" href="/Public/Web/js/lib/bootstrap/dist/css/bootstrap-grid.min.css">
		<link rel="stylesheet" href="/Public/Web/js/lib/bootstrap/dist/css/bootstrap-reboot.min.css">
		<link rel="stylesheet" href="/Public/Web/js/lib/layui/dist/css/layui.css">
		<link rel="stylesheet" href="/Public/Web/web/css/Crumbsnav.css">
		<link rel="stylesheet" href="/Public/Web/web/css/success_index.css">
	</head>

	<body>
		<!--logo-->
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
		<hr />
		<!-- Crumbs nav -->
		<div class="container crumbs">
			<a href="<?php echo U('Index/Academic/academic');?>" class="crumbsa">Academic</a>
			<cite class="Icon"></cite>
			<span class="crumbsTitle">Create A Group</span>

		</div>
		<!--Basic Information form-->
		<form class="layui-form layui-form-pane" action="" autocomplete="off">
			<div class="PasswordContainer">
				<div class="StepContainer">
					<div class="StepContainerOne">
						<div class="InterestTitle">
							<h3 class="text-center Interesth3">
                            <span class="InterestTitleIcon"></span>Basic Information
                        </h3>
						</div>
						<?php if(is_array($data)): foreach($data as $firstkey=>$first): ?><div id="first<?php echo ($first['first_mark_id']); ?>" class="FormContainer" pane>
							<label class="layui-form-label label-spacing">
                            <span class="<?php if($firstkey == 0): ?>CountryIcon<?php elseif($firstkey == 1): ?>SchoolIcon<?php elseif($firstkey == 2): ?>InterestIcon<?php else: ?>ProfessionIcon<?php endif; ?>"></span>
                        </label>
							<div class="layui-input-block" id="layui-input-block">
								<input type="hidden" value="" id="in<?php echo ($first['first_mark_id']); ?>">
								<select name="second" lay-verify="required" lay-filter="firstselect">
									<option value="" selected="selected">Choose a <?php if($firstkey == 0): ?>year<?php elseif($firstkey == 1): ?>school<?php elseif($firstkey == 2): ?>college<?php else: ?>profession<?php endif; ?></option>
									<?php if(is_array($first['message'])): foreach($first['message'] as $secondkey=>$second): ?><option value="<?php echo ($second['second_mark_id']); ?>"><?php echo ($second['second_mark_name']); ?></option><?php endforeach; endif; ?>
								</select>
							</div>
						</div><?php endforeach; endif; ?>

						<div class="FormContainer" pane>
							<label class="HeadPortraitbox">
                            <span class="HeadPortraitIcon"></span>
                        </label>
							<div class="UserHeadImage">
								<img id="pic" class="img">
								<input id="upload" class="but" name="file" accept="image/*" type="file">
							</div>
						</div>
						<div class="FormContainer" pane>
							<label class="layui-form-label label-spacing">
                            <span class="GroupNameIcon"></span>
                        </label>
							<div class="layui-input-block input-spacing">
								<input type="text" name="number" id="name" lay-verify="required" autocomplete="off" placeholder="Group name" class="layui-input">
							</div>
						</div>
						<div class="FormContainer" pane>
							<label class="layui-form-label label-spacing">
                            <span class="BriefIntroductionIcon"></span>
                        </label>
							<div class="layui-input-block input-spacing">
								<input type="text" id="content"  name="number" lay-verify="required" autocomplete="off" placeholder="Enter the signature" class="layui-input">
							</div>
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
		<!--foot 信息-->
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
		<script src="/Public/Web/js/lib/jquery/dist/jquery.min.js"></script>
		<script src="/Public/Web/js/lib/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
		<script src="/Public/Web/js/lib/bootstrap/dist/js/bootstrap.min.js"></script>
		<script src="/Public/Web/js/lib/layui/dist/layui.all.js"></script>
		<script src="/Public/Web/web/js/CreateInterest.js"></script>
		<script src="/Public/Web/web/js/loginQuit.js"></script>
	</body>

<script>



    layui.use('form', function(){
        var form = layui.form;

        form.on('select(firstselect)', function(firstdata){
            //父级id
            //data.othis.parent().parent().attr('id')
            $.ajax({
                type:"post",
                url:"<?php echo U('Index/Ajax/ajax_secondmarkone');?>",
                data:{
                    secondid:firstdata.value,
                },
                dataType:"json",
                success: function(data){
                    console.log(data)
                    if (data!=null&&data!="") {
                        //alert(data.str)
                        if (data.str == 1) {
                            console.log(data.msg)

                            if ( $("#second"+data.firstid).length > 0 ) {

                                var message = '<div class="layui-input-block" id="layui-input-block" style="margin-bottom: 8px;"><select name="third" lay-verify="required" lay-filter="secondselect"><option value="">choose</option>';

                                for (var i = 0; i < data.msg.length; i++) {

                                    message +='<option value="'+data.msg[i]['third_mark_id']+'">';
                                    message +=data.msg[i]['third_mark_name']+'</option>';

                                }
                                message +='</select></div>';
                                $("#second"+data.firstid).html(message)
                            }else{

                                var message = '<div id="second'+data.firstid+'" class="FormContainer" pane><div class="layui-input-block" id="layui-input-block" style="margin-bottom: 8px;"><select name="third" lay-verify="required" lay-filter="secondselect"><option value="">choose</option>';
                                for (var i = 0; i < data.msg.length; i++) {

                                    message +='<option value="'+data.msg[i]['third_mark_id']+'">';
                                    message +=data.msg[i]['third_mark_name']+'</option>';

                                }
                                message +='</select></div></div>';

                                firstdata.othis.parent().parent().after(message);
                            }

                            form.render()
                            rmfour($('#in'+data.firstid).val())
                            $('#in'+data.firstid).val(firstdata.value)
                            createthird();
                        }

                    }
                }

            })

        });

        form.on('submit(demo1)', function(data){
            var second = ''
            $("select[name='second']").each(function(j,item){
                if(second == ''){
                    second+=item.value //输出input 中的 value 值到控制台
                }else{
                    second+=','+item.value //输出input 中的 value 值到控制台
                }

            });
            var third = ''
            $("select[name='third']").each(function(j,item){
                if(third == ''){
                    third+=item.value //输出input 中的 value 值到控制台
                }else{
                    third+=','+item.value //输出input 中的 value 值到控制台
                }
            });
            var four = ''
            $("select[name='four']").each(function(j,item){
                if(four == ''){
                    four += item.value //输出input 中的 value 值到控制台
                }else{
                    four += ','+item.value //输出input 中的 value 值到控制台
                }
            });


            var file_obj = document.getElementById('upload').files[0];
            var fd = new FormData();
            fd.append('img', file_obj);

            $.ajax({
                url: "<?php echo U('Index/Ajax/ajax_uploadimg');?>",
                type: "POST",
                async: false,
                cache: false,
                processData: false,// 告诉jQuery不要去处理发送的数据
                contentType: false,// 告诉jQuery不要去设置Content-Type请求头
                data: fd,
                dataType:"json",
                success: function(data){
                    //console.log(data)
                    if (data.str == 1){
                        $.ajax({
                            type:"post",
                            url:"<?php echo U('Index/Ajax/ajax_createacademic');?>",
                            data:{
                                second:second,
                                third:third,
                                four:four,
                                crowd_name:$("#name").val(),
                                crowd_icon:data.msg,
                                crowd_intro:$("#content").val(),

                            },
                            dataType:"json",
                            async:false,
                            success: function(academic){
                                //console.log(interest)
                                if (academic.str == 1){
                                    layer.msg('创建成功',{
                                            time:1500,
                                            icon:1,
                                        },function () {
                                            window.location.href="<?php echo U('Index/Academic/academicGroups');?>&cid="+academic.msg;
                                        }
                                    );

                                }else{
                                    layer.msg(academic.msg,{
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

                    }else{
                        layer.msg('图片上传失败!',{
                                time:1500,
                                icon:2,
                            }
                        );
                    }

                },
                error: function(err) {

                    layer.msg('请求失败!',{
                            time:1500,
                            icon:2,
                        }
                    );
                }
            });



            /*$.ajax({
                type:"post",
                url:"<?php echo U('Index/Ajax/ajax_createinterest');?>",
                data:{
                    img:file_obj,
                },
                dataType:"json",
                async:false,
                success: function(data){
                    console.log(data)

                },
                error:function(XMLHttpRequest, textStatus, errorThrown){

                    layer.msg('请求失败!',{
                            time:1500,
                            icon:2,
                        },sendverify()
                    );
                }

            })*/

            return false; //阻止表单跳转。如果需要表单跳转，去掉这段即可。
        });
    });

    function createthird() {

        layui.use('form', function(){
            var form = layui.form;

            form.on('select(secondselect)', function(seconddata){

                $.ajax({
                    type:"post",
                    url:"<?php echo U('Index/Ajax/ajax_thirdmarkone');?>",
                    data:{
                        thirdid:seconddata.value,
                    },
                    dataType:"json",
                    success: function(data){
                        console.log(data)
                        if (data.str == 1) {
                            if ($("#third" + data.secondid).length > 0) {

                                var message = '<div class="layui-input-block"  id="layui-input-block"><select name="four" lay-verify="required" lay-filter="thirdselect"><option value="">choose</option>';

                                for (var i = 0; i < data.msg.length; i++) {

                                    message += '<option value="' + data.msg[i]['fourth_mark_id'] + '">';
                                    message += data.msg[i]['fourth_mark_name'] + '</option>';

                                }
                                message += '</select></div>';
                                $("#third" + data.secondid).html(message)
                            } else {

                                var message = '<div id="third' + data.secondid + '" class="FormContainer" style="margin-bottom: 8px;" pane><div class="layui-input-block" id="layui-input-block"><select name="four" lay-verify="required" lay-filter="thirdselect"><option value="">choose</option>';
                                for (var i = 0; i < data.msg.length; i++) {

                                    message += '<option value="' + data.msg[i]['fourth_mark_id'] + '">';
                                    message += data.msg[i]['fourth_mark_name'] + '</option>';

                                }
                                message += '</select></div></div>';

                                seconddata.othis.parent().parent().after(message);

                            }

                            form.render()
                        }else{
                            if ($("#third" + data.secondid).length > 0) {
                                $("#third" + data.secondid).remove();
                            }

                            form.render();
                        }
                    }

                })

            });
        });

    }

    function rmfour(firstid) {

        layui.use('form', function() {
            var form = layui.form;
            //alert(aa)
            if ($("#third" + firstid).length > 0) {
                $("#third" + firstid).remove();
            }
            form.render();
        });

    }



</script>


</html>
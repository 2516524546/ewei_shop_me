<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<title>Academic</title>
		<meta name="viewport" content="width=device-width, initial-scale=0 user-scalable=no, maximum-scale=1.0, minimum-scale=1.0">
		<link rel="stylesheet" href="/Public/Web/web/css/Academic.css">
		<link rel="stylesheet" href="/Public/Web/js/lib/bootstrap/dist/css/bootstrap.min.css">
		<link rel="stylesheet" href="/Public/Web/js/lib/bootstrap/dist/css/bootstrap-grid.min.css">
		<link rel="stylesheet" href="/Public/Web/js/lib/bootstrap/dist/css/bootstrap-reboot.min.css">
		<link rel="stylesheet" href="/Public/Web/js/lib/layui/dist/css/layui.css">
		<link rel="stylesheet" href="/Public/Web/web/css/Crumbsnav.css">
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
									<a href="<?php echo U('Index/Academic/academic');?>" id="NavSelected">Academic</a>
								</li>
								<li>
									<a href="<?php echo U('Index/Jobs/work');?>">Jobs</a>
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
		<form class="layui-form" action="" autocomplete="off">
			<div class="container SearchContainer">
				<div class="row">

					<div class="col-md-4">
						<?php if(is_array($data)): foreach($data as $firstkey=>$first): ?><div class="SelectionTypeContainer" id="first<?php echo ($first['first_mark_id']); ?>">
							<label class="layui-form-label">
                            <span><img src="/Public/Web/web/img/03_academic/academic_create_icon_0<?php echo ($firstkey+1); ?>.png"></span>
                        </label>
							<div class="layui-input-block">
								<input type="hidden" value="" id="in<?php echo ($first['first_mark_id']); ?>">
								<select name="second" lay-verify="required" lay-filter="firstselect">
									<option value="" selected="selected">Choose a <?php if($firstkey == 0): ?>year<?php elseif($firstkey == 1): ?>school<?php elseif($firstkey == 2): ?>college<?php else: ?>profession<?php endif; ?></option>
									<?php if(is_array($first['message'])): foreach($first['message'] as $secondkey=>$second): ?><option value="<?php echo ($second['second_mark_id']); ?>"><?php echo ($second['second_mark_name']); ?></option><?php endforeach; endif; ?>
								</select>
							</div>
						</div><?php endforeach; endif; ?>
					</div>
					<div class="col-md-6">
						<div class="SelectionContainer">
							<input type="text" class="layui-input" id="Selectionform">
							<a href="javascript:void(0)" id="SelectionIcon" onclick="updata_interest_list(3,'crowd_creattime',0,10,1)"><img src="/Public/Web/web/img/02_interest/interest_qxx_search_icon.png"></a>
						</div>
					</div>
					<div class="col-md-2">
						<a href="javascript:void(0)" class="layui-btn layui-btn-radius layui-btn-lg layui-btn-normal" id="GroupBtn" onclick="gocreate()">
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
					<div class="row" id="crowdlist">
						<?php if(is_array($crodlist)): foreach($crodlist as $crodkey=>$crod): ?><div class="col-xs-8 col-sm-6">
							<div class="UserBox">
                                <a href="<?php echo U('Index/Academic/academicGroups');?>&cid=<?php echo ($crod['crowd_id']); ?>" class="UserLink">
                                    <div class="UserBox_img">
                                    <img src="./Uploads/<?php echo ($crod['crowd_icon']); ?>" alt="" class="img-circle userimg" />
                                    </div>
									<h4 class="UserTitle"><?php echo ($crod['crowd_name']); ?></h4>
									<p class="UserFollow">
										<img src="/Public/Web/web/img/02_interest/interest_sy_gl_icon_renshu.png" alt="" /> &nbsp;&nbsp;<?php echo ($crod['crowd_peoplenum']); ?>
									</p>
									<p class="UserName">
										Creator : <?php echo ($crod['user_name']); ?> <span class="UserTime"><?php echo ($crod['crowd_creattime']); ?></span>
									</p>
									<p class="UserContent">
										<?php echo ($crod['crowd_intro']); ?>
									</p>
								</a>
							</div>
						</div><?php endforeach; endif; ?>

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

    var page = 1;
    var count = <?php echo ($crowdcount); ?>;
    var c = 1;
    var a = 1;

    function gocreate() {
        var aa = "<?php echo ($userid); ?>";
        if(aa){
            window.location.href="<?php echo U('Index/Academic/createAcademic');?>";
        }else{
            layer.msg("请先登录",{
                    time:1500,
                },function(){
                    window.location.href="<?php echo U('Index/Login/login');?>";
                    //window.location.href="<?php echo U('Index/Login/login');?>";
                }
            );
        }
    }

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
                            //console.log(data.msg)

                            if ( $("#second"+data.firstid).length > 0 ) {

                                var message = '<div class="layui-input-block" ><select name="third" lay-verify="required" lay-filter="secondselect"><option value="">choose</option>';

                                for (var i = 0; i < data.msg.length; i++) {

                                    message +='<option value="'+data.msg[i]['third_mark_id']+'">';
                                    message +=data.msg[i]['third_mark_name']+'</option>';

                                }
                                message +='</select></div>';
                                $("#second"+data.firstid).html(message)
                            }else{

                                var message = '<div id="second'+data.firstid+'" class="SelectionTypeContainer" style="margin-bottom: 10px;"><div class="layui-input-block" ><select name="third" lay-verify="required" lay-filter="secondselect"><option value="">choose</option>';
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
                        }else{

                            $("#second"+data.firstid).remove();
                            form.render()
                            rmfour($('#in'+data.firstid).val())
                            $('#in'+data.firstid).val(firstdata.value)
                            createthird();

                        }

                    }
                }

            })

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
                        //console.log(data)
                        if (data.str == 1) {
                            if ($("#third" + data.secondid).length > 0) {

                                var message = '<div class="layui-input-block" ><select name="four" lay-verify="required" lay-filter="thirdselect"><option value="">choose</option>';

                                for (var i = 0; i < data.msg.length; i++) {

                                    message += '<option value="' + data.msg[i]['fourth_mark_id'] + '">';
                                    message += data.msg[i]['fourth_mark_name'] + '</option>';

                                }
                                message += '</select></div>';
                                $("#third" + data.secondid).html(message)
                            } else {

                                var message = '<div id="third' + data.secondid + '" class="SelectionTypeContainer" style="margin-bottom: 10px;"><div class="layui-input-block" ><select name="four" lay-verify="required" lay-filter="thirdselect"><option value="">choose</option>';
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

    function updata_interest_list(mid,order,limit1,limit2,type) {

        var second = ''
        $("select[name='second']").each(function(j,item){
            if (item.value!=''){
            	if(second == ''){
                	second+=item.value //输出input 中的 value 值到控制台
            	}else{
                	second+=','+item.value //输出input 中的 value 值到控制台
            	}
            }
        });
        var third = ''
        $("select[name='third']").each(function(j,item){
            if (item.value!='') {
                if (third == '') {
                    third += item.value //输出input 中的 value 值到控制台
                } else {
                    third += ',' + item.value //输出input 中的 value 值到控制台
                }
            }
        });
        var four = ''
        $("select[name='four']").each(function(j,item){
            if (item.value!='') {
                if (four == '') {
                    four += item.value //输出input 中的 value 值到控制台
                } else {
                    four += ',' + item.value //输出input 中的 value 值到控制台
                }
            }
        });

        $.ajax({
            type:"post",
            url:"<?php echo U('Index/Ajax/ajax_crowd_list');?>",
            data:{
                second:second,
                third:third,
                four:four,
                crowd_name:$("#Selectionform").val(),
                mid:mid,
                order:order,
                limit1:limit1,
                limit2:limit2,

            },
            dataType:"json",
            async:false,
            success: function(list){
                console.log(list)
                if(list!=null&&list!=""){

                    if (list.str == 1){

                        var message = '';
                        for (var i = 0; i < list.msg.length; i++) {
                            message +='<div class="col-xs-8 col-sm-6"><div class="UserBox">';
                            var url="<?php echo U('Index/Rnterst/groupDetails');?>"+list.msg[i].crowd_id;
                            message += '<a href="'+url+'" class="UserLink">';
                            message += '<img src="./Uploads/'+list.msg[i].crowd_icon+'" class="img-circle userimg">';
                            message += '<h4 class="UserTitle">'+list.msg[i].crowd_name+'</h4>'
                            message += '<p class="UserFollow"><img src="/Public/Web/web/img/02_interest/interest_sy_gl_icon_renshu.png">&nbsp;&nbsp;';
                            message += list.msg[i].crowd_peoplenum+'</p>';
                            message += '<p class="UserName">Creator : '+list.msg[i].user_name;
                            message += '<span class="UserTime">'+list.msg[i].crowd_creattime+'</span></p>';
                            message += '<p class="UserContent">'+list.msg[i].crowd_intro+'</p>';
                            message += '</a></div></div>';

                        }


                        if (type==1){
                            page = 1;
                            c = 1;
                            count = list.count;
                            $("#crowdlist").html(message);

                        }else{
                            c=1;
                            var crowdlisthtml = $("#crowdlist").html()+message
                            $("#crowdlist").html(crowdlisthtml);
                        }
                    }else if (list.str == 2){
                        page = 1;
                        c = 1;
                        count = 0;
                        $("#crowdlist").html('');
                        layer.msg(list.msg,{
                                time:1500,
                                icon:2,
                            }
                        );
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

    $(window).scroll(function () {
        var scrollTop = $(document).scrollTop();
        var scrollHeight = $(document).height();
        var windowHeight = $(this).height();
        var gocheng =parseInt(scrollTop)+parseInt(windowHeight);

        if (gocheng>(scrollHeight-200)) {

            if (c==a){
                var limit1 = page*10;
                c = 2;
                if (limit1<count){
                    updata_interest_list(3,'crowd_creattime desc',limit1,10,2);
                    page += 1;
                }
            }
        }
    })

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
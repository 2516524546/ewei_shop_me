<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Second-Hand Market</title>
        <meta name="viewport" content="width=device-width, initial-scale=0 user-scalable=no, maximum-scale=1.0, minimum-scale=1.0">
        <link rel="stylesheet" href="/Public/Web/web/css/register.css">
        <link rel="stylesheet" href="/Public/Web/web/css/Donation.css">
        <link rel="stylesheet" href="/Public/Web/web/css/Life.css">
        <link rel="stylesheet" href="/Public/Web/js/lib/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="/Public/Web/js/lib/bootstrap/dist/css/bootstrap-grid.min.css">
        <link rel="stylesheet" href="/Public/Web/js/lib/bootstrap/dist/css/bootstrap-reboot.min.css">
        <link rel="stylesheet" href="/Public/Web/js/lib/layui/dist/css/layui.css">
        <link rel="stylesheet" href="/Public/Web/web/css/LSecondHandMarket.css">
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
        <a href="<?php echo U('Index/Life/life');?>" class="crumbsa">Life</a>
        <cite class="Icon"></cite>
        <span class="crumbsTitle">Second-Hand Market</span>
    </div>


        <!-- search -->
        <div class="container Second_Market_detail">
            <div class="row justify-content-between">
                <div class="col-md-6">
                    <form class="Produce_attribute">
                        <div class="attribute_content" >
                            <div class="content_img">
                                <img src="/Public/Web/web/img/04_jobs/jobs_create_icon_type.png">
                            </div>
                            <ul class="content_details" id="static">
                                <li class="active">All</li>
                                <?php if(is_array($static)): foreach($static as $key=>$s): ?><li value="<?php echo ($s['second_mark_id']); ?>"><?php echo ($s['second_mark_name']); ?></li><?php endforeach; endif; ?>
                            </ul>
                        </div>
                        
                        <div class="attribute_content" >
                                <div class="content_img">
                                    <img src="/Public/Web/web/img/04_jobs/jobs_create_icon_money.png">
                                </div>
                                <ul class="content_details" id="price">
                                    <li class="active">All</li>
                                    <?php if(is_array($money)): foreach($money as $key=>$m): ?><li value="<?php echo ($m['second_mark_id']); ?>"><?php echo ($m['second_mark_name']); ?></li><?php endforeach; endif; ?>
                                </ul>
                                <div class="content_input">
                                    <div class="layui-input-inline" style="width: 100px;">
                                        <input type="text" name="price_min" id="minmonry" placeholder="$" autocomplete="off" class="layui-input">
                                        </div>
                                        <div class="layui-form-mid">~</div>
                                        <div class="layui-input-inline" style="width: 100px;">
                                        <input type="text" name="price_max" id="maxmonry" placeholder="$" autocomplete="off" class="layui-input">
                                    </div>
                                </div>
                                
                            </div>

                            <div class="attribute_content" >
                                    <div class="content_img">
                                        <img src="/Public/Web/web/img/05_life/life_create_icon_zhou.png">
                                    </div>
                                    <ul class="content_details" id="state">
                                        <li class="active">All</li>
                                        <?php if(is_array($state)): foreach($state as $key=>$s): ?><li value="<?php echo ($s['second_mark_id']); ?>"><?php echo ($s['second_mark_name']); ?></li><?php endforeach; endif; ?>
                                    </ul>
                            </div>

                            <div class="attribute_content" >
                                    <div class="content_img">
                                        <img src="/Public/Web/web/img/05_life/life_sy_icon_02.png">
                                    </div>
                                    <ul class="content_details" id="city">
                                        <li class="active">All</li>
                                        <?php if(is_array($city)): foreach($city as $key=>$c): ?><li value="<?php echo ($c['second_mark_id']); ?>"><?php echo ($c['second_mark_name']); ?></li><?php endforeach; endif; ?>
                                    </ul>
                            </div>

                            <div class="attribute_content" >
                                    <div class="content_img">
                                        <img src="/Public/Web/web/img/05_life/life_sy_icon_03.png">
                                    </div>
                                    <ul class="content_details" id="university">
                                        <li class="active">All</li>
                                        <?php if(is_array($university)): foreach($university as $key=>$u): ?><li value="<?php echo ($u['second_mark_id']); ?>"><?php echo ($u['second_mark_name']); ?></li><?php endforeach; endif; ?>
                                    </ul>
                            </div>

                            <div class="attribute_content" >
                                    <div class="content_img">
                                        <img src="/Public/Web/web/img/05_life/life_secondhandmarket_icon_03.png">
                                    </div>
                                    <div class="layui-form-item-one">
                                            <div class="layui-input-block-one">
                                                <div class="radio_box to">
                                                    <input type="radio" name="pic" value="With pictures" onclick="editpic(1)" title="With pictures" checked class="pic_input"><span class="pic_input_span">With pictures</span>

                                                </div>
                                                <div class="radio_box">
                                                    <input type="radio" name="pic" value="Without pictures" onclick="editpic(0)" title="Without pictures" class="pic_input"><span class="pic_input_span">Without pictures</span>
                                                </div>
                                            </div>
                                          </div>
                            </div>
                    </form>
                </div> 
                <div class="col-md-4">
                        <div class="SelectionContainer">
                            <input type="text" class="layui-input" id="Selectionform">
                            <a href="#" id="SelectionIcon" onclick="updata_market_list(5,'commodity_updatetime desc',0,10,1)">
                            <img src="/Public/Web/web/img/02_interest/interest_qxx_search_icon.png">
                            </a>
                        </div>
                        <div class="S_btn">
                                <a href="<?php echo U('Index/Life/mineProduct');?>" class="layui-btn layui-btn-radius layui-btn-lg layui-btn-normal" id="GroupBtn">
                                        My product
                                </a>
                        </div>
                        <div class="S_btn">
                                <a href="<?php echo U('Index/Life/postProduct');?>" class="layui-btn layui-btn-radius layui-btn-lg layui-btn-normal" id="GroupBtn">
                                        Post product
                                </a>
                        </div>
                </div>
            </div>
            
        </div>


        <!-- Second-Hand Market start 二手市场-->
        <div class="container S_Market">
            <h4 class="text-center S_Market_title">
                    New Products
                </h4>
            <div class="row S_Market_detail" id="marketlist">
                <?php if(is_array($commoditylist)): foreach($commoditylist as $key=>$c): ?><div class="col-md-12">
                    <a href="<?php echo U('Index/Life/lifeProductDetails');?>&cid=<?php echo ($c['commodity_id']); ?>">
                        <div class="S_Market_detail_all">
                                    <div class="fl">
                                            <div class="pro_img">
                                                    <img src="./Uploads/<?php echo ($c['commodity_img']); ?>" alt="" class="img-circle userimg" />
                                            </div>
                                            <div class="pro_detail">
                                                <div class="pro_Name">
                                                    Product Name:
                                                    <span><?php echo ($c['commodity_name']); ?></span>
                                                </div>
                                                <div class="pro_Price">
                                                    Price: 
                                                    <p><small>$</small><?php echo ($c['commodity_price']); ?></p>
                                                </div>
                                                <div class="pro_Description">
                                                    Product Description:
                                                    <p><?php echo ($c['commodity_content']); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="fr pro_right">
                                            <div class="pro_right_img">
                                                    <img src="./Uploads/<?php echo ($c['user_icon']); ?>" alt="" class="img-circle userimg" />
                                            </div>
                                            <div class="pro_right_name">
                                                <?php echo ($c['user_name']); ?>
                                            </div>
                                        </div>                                        
                            </div>
                        </a>                                    
                </div><?php endforeach; endif; ?>

            </div>

    </div>

    <!-- Second-Hand Market end 二手市场 -->
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
    <script src="/Public/Web/web/js/jquery-1.11.0.js"></script>
    <script src="/Public/Web/web/js/jquery-2.1.0.js"></script>
    <script src="/Public/Web/js/lib/jquery/dist/jquery.min.js"></script>
    <script src="/Public/Web/js/lib/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/Public/Web/js/lib/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/Public/Web/js/lib/layui/dist/layui.all.js"></script>
    <script src="/Public/Web/web/js/loginQuit.js"></script>


<script>

var pic = 1;
var page = 1;
var count = <?php echo ($crowdcount); ?>;
var c = 1;
var a = 1;
var staticli = 0;
var moneyli = 0;
var stateli = 0;
var cityli = 0;
var universityli = 0;

    $(function(){
        (function(){
            var num;
            $('.Produce_attribute').on('click','.attribute_content',function(event){
                num = $(this).index();
            })
            $('.Produce_attribute .attribute_content .content_details li').on('click',function(event){
                // console.log($(this).addClass("active").siblings().removeClass('active'))
                $(this).addClass("active").siblings().removeClass('active')

                staticli = document.getElementById("static").getElementsByClassName("active")[0]
                moneyli = document.getElementById("price").getElementsByClassName("active")[0]
                stateli = document.getElementById("state").getElementsByClassName("active")[0]
                cityli = document.getElementById("city").getElementsByClassName("active")[0]
                universityli = document.getElementById("university").getElementsByClassName("active")[0]
                console.log(staticli.value)
                console.log(moneyli.value)
                console.log(stateli.value)
                console.log(cityli.value)
                console.log(universityli.value)
                console.log('pic:'+pic)
                //updata_market_list(5,'commodity_updatetime desc',0,10,1)
                // $(this).eq(num).addClass("active").siblings().removeClass('active');
            });
            $(".layui-form-item-one .layui-input-block-one .radio_box input[type='radio']").click(function(){
                $(this).parent().addClass("to").siblings().removeClass('to');
            })
        })();
    });


    function updata_market_list(mid,order,limit1,limit2,type) {

        $.ajax({
            type:"post",
            url:"<?php echo U('Index/Ajax/ajax_market_list');?>",
            data:{
                staticli:staticli.value,
                moneyli:moneyli.value,
                stateli:stateli.value,
                cityli:cityli.value,
                universityli:universityli.value,
                minmonry:$("#minmonry").val(),
                maxmonry:$("#maxmonry").val(),
                order:order,
                limit1:limit1,
                limit2:limit2,
                name:$("#Selectionform").val(),

            },
            dataType:"json",
            async:false,
            success: function(list){
                console.log(list)
                if(list!=null&&list!=""){

                    if (list.str == 1){

                        var message = '';
                        for (var i = 0; i < list.msg.length; i++) {

                            message +='<div class="col-md-12">';
                            var url="<?php echo U('Index/Life/lifeProductDetails');?>&cid="+list.msg[i].commodity_id;
                            message += '<a href="'+url+'">';
                            message += '<div class="S_Market_detail_all"><div class="fl"><div class="pro_img">';
                            message += '<img src="./Uploads/'+list.msg[i].commodity_img+'" alt="" class="img-circle userimg" />';
                            message += '</div><div class="pro_detail"><div class="pro_Name">Product Name:&nbsp;<span>'+list.msg[i].commodity_name+'</span></div>';
                            message += '<div class="pro_Price">Price:<p><small>$</small>'+list.msg[i].commodity_price+'</p></div>';
                            message += '<div class="pro_Description">Product Description:<p>'+list.msg[i].commodity_content+'</p></div></div></div>';
                            message += '<div class="fr pro_right"><div class="pro_right_img">';
                            message += '<img src="./Uploads/'+list.msg[i].user_icon+'" alt="" class="img-circle userimg" /></div>'
                            message += '<div class="pro_right_name">'+list.msg[i].user_name+'</div>';
                            message += '</div></div></a></div>'

                        }

                        if (type==1){
                            page = 1;
                            c = 1;
                            count = list.count;
                            $("#marketlist").html(message);

                        }else{
                            c=1;
                            var crowdlisthtml = $("#crowdlist").html()+message
                            $("#marketlist").html(crowdlisthtml);
                        }
                    }else if (list.str == 2){
                        page = 1;
                        c = 1;
                        count = 0;
                        $("#marketlist").html('');
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

    function editpic(a) {
        pic = a
    }




</script>

</html>
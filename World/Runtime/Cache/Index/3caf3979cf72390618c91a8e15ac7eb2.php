<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>index</title>
    <meta name="viewport" content="width=device-width, initial-scale=0 user-scalable=no, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="/Public/Web/web/css/index.css">
    <link rel="stylesheet" href="/Public/Web/js/lib/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Public/Web/js/lib/bootstrap/dist/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="/Public/Web/js/lib/bootstrap/dist/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="/Public/Web/js/lib/layui/dist/css/layui.css">
    <link rel="stylesheet" href="/Public/Web/web/css/success_index.css">
    <link rel="stylesheet" href="/Public/Web/web/css/iconfont.css">
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
                            <li><a href="<?php echo U('Index/Index/index');?>" id="NavSelected">Home</a></li>
                            <li><a href="<?php echo U('Index/Rnterst/interest');?>" >Interst</a></li>
                            <li><a href="<?php echo U('Index/Academic/academic');?>">Academic</a></li>
                            <li><a href="<?php echo U('Index/Jobs/work');?>">Jobs</a></li>
                            <li><a href="<?php echo U('Index/Life/life');?>">Life</a></li>
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
    <!-- Honor list start 荣誉榜 -->
    <div class="container">
        <p class="text-center PublicStyleIcons">
            <img src="/Public/Web/web/img/01_shouye/home_sy_title_icon_01.png" class="TitleIcon">
        </p>
        <p class="text-center PublicStyleTitle">
            <span class="Titleline"><img src="/Public/Web/web/img/01_shouye/home_sy_title_fgx.png"></span>
            <span class="Title">HONOR LIST</span>
        </p>
        <div class="row">
            <div class="col-md-6">
                <div class="layui-tab layui-tab-brief" id="ListContainer" lay-filter="docDemoTabBrief">
                    <ul class="layui-tab-title">
                        <li class="layui-this">Wealth</li>
                        <li>Donate</li>
                        <li>Expenditure</li>
                        <a href="<?php echo U('Index/Index/honoraryEdition');?>" class="More">
                        	<img src="/Public/Web/web/img/01_shouye/home_sy_icon_c_more_n.png">
                        </a>
                    </ul>
                    <div class="layui-tab-content">
                        <div class="layui-tab-item layui-show">
                            <div class="layui-form">
                                <table class="layui-table">
                                    <tbody>
                                    <?php if(is_array($wealth)): foreach($wealth as $k=>$w): ?><tr>
                                            <td>
                                                <span>
                                                    <?php switch($k): case "0": ?><img src="/Public/Web/web/img/01_shouye/home_sy_hl_icon_01.png"><?php break;?>
                                                        <?php case "1": ?><img src="/Public/Web/web/img/01_shouye/home_sy_hl_icon_02.png"><?php break;?>
                                                        <?php case "2": ?><img src="/Public/Web/web/img/01_shouye/home_sy_hl_icon_03.png"><?php break;?>
                                                        <?php default: ?><img src="/Public/Web/web/img/01_shouye/home_sy_hl_icon_04.png"><?php endswitch;?>

                                            		&nbsp;&nbsp;<?php echo ($k+1); ?>st
                                            	</span>
                                            </td>
                                            <td>
                                                <div class="img-circle">
                                                    <img src="<?php if($w["user_icon"]): ?>./Uploads/<?php echo ($w['user_icon']); else: ?>/Public/Web/web/img/01_shouye/UserPic.png<?php endif; ?>">
                                                </div>
                                                &nbsp;&nbsp;<?php echo ($w['user_name']); ?>
                                            </td>
                                            <td><?php echo ($w['user_havecoin']); ?> virtual currency</td>
                                        </tr><?php endforeach; endif; ?>
                                        <!--<tr>
                                            <td>
                                                <img src="/Public/Web/web/img/01_shouye/home_sy_hl_icon_02.png"> &nbsp;&nbsp;2st
                                            </td>
                                            <td>
                                                <img src="/Public/Web/web/img/01_shouye/UserPic.png" class="img-circle"> &nbsp;&nbsp;Kendall J
                                            </td>
                                            <td>800 virtual currency</td>
                                        </tr>-->

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="layui-tab-item">
                            <div class="layui-form">
                                <table class="layui-table">
                                    <tbody>
                                    <?php if(is_array($donate)): foreach($donate as $k=>$d): ?><tr>
                                            <td>
                                                <span>
                        	                		<?php switch($k): case "0": ?><img src="/Public/Web/web/img/01_shouye/home_sy_hl_icon_01.png"><?php break;?>
                                                        <?php case "1": ?><img src="/Public/Web/web/img/01_shouye/home_sy_hl_icon_02.png"><?php break;?>
                                                        <?php case "2": ?><img src="/Public/Web/web/img/01_shouye/home_sy_hl_icon_03.png"><?php break;?>
                                                        <?php default: ?><img src="/Public/Web/web/img/01_shouye/home_sy_hl_icon_04.png"><?php endswitch;?>

                                            		&nbsp;&nbsp;<?php echo ($k+1); ?>st
                        	                	</span>
                                            </td>
                                            <td>
                                                <img src="<?php if($d["user_icon"]): ?>./Uploads/<?php echo ($d['user_icon']); else: ?>/Public/Web/web/img/01_shouye/UserPic.png<?php endif; ?>" class="img-circle"> &nbsp;&nbsp;<?php echo ($d['user_name']); ?>
                                            </td>
                                            <td><?php echo ($d['user_outcoin']); ?> virtual currency</td>
                                        </tr><?php endforeach; endif; ?>
                                        <!--<tr>
                                            <td>
                                                <img src="/Public/Web/web/img/01_shouye/home_sy_hl_icon_02.png"> &nbsp;&nbsp;2st
                                            </td>
                                            <td>
                                                <img src="/Public/Web/web/img/01_shouye/UserPic.png" class="img-circle"> &nbsp;&nbsp;Kendall J
                                            </td>
                                            <td>800 virtual currency</td>
                                        </tr>-->

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="layui-tab-item">
                            <div class="layui-form">
                                <table class="layui-table">
                                    <tbody>
                                    <?php if(is_array($expenditure)): foreach($expenditure as $k=>$e): ?><tr>
                                            <td>
                                                <span>
                        	                		<?php switch($k): case "0": ?><img src="/Public/Web/web/img/01_shouye/home_sy_hl_icon_01.png"><?php break;?>
                                                        <?php case "1": ?><img src="/Public/Web/web/img/01_shouye/home_sy_hl_icon_02.png"><?php break;?>
                                                        <?php case "2": ?><img src="/Public/Web/web/img/01_shouye/home_sy_hl_icon_03.png"><?php break;?>
                                                        <?php default: ?><img src="/Public/Web/web/img/01_shouye/home_sy_hl_icon_04.png"><?php endswitch;?>

                                            		&nbsp;&nbsp;<?php echo ($k+1); ?>st
                        	                	</span>
                                            </td>
                                            <td>
                                                <img src="<?php if($e["user_icon"]): ?>./Uploads/<?php echo ($e['user_icon']); else: ?>/Public/Web/web/img/01_shouye/UserPic.png<?php endif; ?>" class="img-circle"> &nbsp;&nbsp;<?php echo ($e['user_name']); ?>
                                            </td>
                                            <td>$ <?php echo ($e['user_outmoney']); ?></td>
                                        </tr><?php endforeach; endif; ?>
                                        <!--<tr>
                                            <td>
                                                <img src="/Public/Web/web/img/01_shouye/home_sy_hl_icon_02.png"> &nbsp;&nbsp;2st
                                            </td>
                                            <td>
                                                <img src="/Public/Web/web/img/01_shouye/UserPic.png" class="img-circle"> &nbsp;&nbsp;Kendall J
                                            </td>
                                            <td>$ 1000</td>
                                        </tr>-->

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="tile">
                    <div class="text">
                        <img src="/Public/Web/web/img/01_shouye/pic1.png">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Honor list end 荣誉榜 -->
    <!-- donate start 捐赠 -->
    <div class="container">
        <p class="text-center PublicStyleIcons">
            <img src="/Public/Web/web/img/01_shouye/home_sy_title_icon_02.png" class="TitleIcon">
        </p>
        <p class="text-center PublicStyleTitle">
            <span class="Titleline"><img src="/Public/Web/web/img/01_shouye/home_sy_title_fgx.png"></span>
            <span class="Title">Donate</span>
        </p>
        <div class="row">
            <div class="col-xs-6 col-md-7">
                <table class="layui-table ListContainer" lay-skin="line">
                    <tbody>
                        <tr>
                            <td class="text-center FontColor" colspan="2">
                                Donations Information
                                <a href="javascript:void(0)" class="More" onclick="donationlist()">
                    				<img src="/Public/Web/web/img/01_shouye/home_sy_icon_c_more_n.png">
                    			</a>
                            </td>
                        </tr>
                        <?php if(is_array($donatelist)): foreach($donatelist as $k=>$d): ?><tr>
                            <td class="FontOverflow">
                                <?php echo ($d['user_name']); ?> donated $ <?php echo ($d['donation_money']); ?> to the platform and earned <?php echo ($d['donation_coin']); ?> virtual coins
                            </td>
                            <td class="TimeColor"><?php echo ($d['donation_paytime']); ?></td>
                        </tr><?php endforeach; endif; ?>
                        <!--<tr>
                            <td class="FontOverflow">
                                Tom donated $ 10 to the platform and earned 100 virtual coins
                            </td>
                            <td class="TimeColor">1920-09-30</td>
                        </tr>-->

                    </tbody>
                </table>
            </div>
            <div class="col-xs-6 col-md-3">
                <div class="DonateContainer">
                    <h4 class="text-center FontColor">Donate</h4>
                    <p class="Prompt">
                        Prompt :
                        <br> After the success of donation funding platform will give you a certain amount of virtual cur -rency to you!
                    </p>
                    <a href="javascript:void(0)" class="DonateBut layui-btn layui-btn-radius layui-btn-primary" onclick="godonation()">Donate</a>
                </div>
            </div>
            <div class="col-xs-6 col-md-2">
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
    <!-- donate end 捐赠 -->
    <!-- advice start 建议 -->
    <div class="container">
        <p class="text-center PublicStyleIcons">
            <img src="/Public/Web/web/img/01_shouye/home_sy_title_icon_03.png" class="TitleIcon">
        </p>
        <p class="text-center PublicStyleTitle">
            <span class="Titleline"><img src="/Public/Web/web/img/01_shouye/home_sy_title_fgx.png"></span>
            <span class="Title">Advice</span>
        </p>
        <!-- Modal frame stater 模态框 -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <p class="modal-header text-center">
              	<span class="ModalTitle" id="exampleModalLabel">New message</span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </p>
              <div class="modal-body">
                <form>
                	<div class="form-group">
                		<p class="text-center ModalTextColor">
                			Please submit your questions or suggestions when you are using this website, if there are any problems or which pages need improvement.
                		</p>
                	</div>
                  <div class="form-group">
                    <label for="recipient-name" class="control-label ModalFormHints">Suggested type:</label>
                    <select class="form-control" id="proposal-type">

                      <option>Select the recommended type</option>
                        <?php if(is_array($proposaltypelist)): foreach($proposaltypelist as $k=>$p): ?><option value="<?php echo ($p['proposal_type_id']); ?>"><?php echo ($p['proposal_type_content']); ?></option><?php endforeach; endif; ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="message-text" class="control-label ModalFormHints">Recommendations:</label>
                    <textarea class="form-control" id="message-text"></textarea>
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-info btn-block" onclick="upproposal()">Submit</button>
              </div>
            </div>
          </div>
        </div>
        <!-- Modal frame end 模态框 -->
        <div class="row">
            <div class="col-ms-6"><img src="/Public/Web/web/img/01_shouye/pic4.png" class="ProposalImg"></div>
            <div class="col-ms-6">
                <div class="ProposalContainer">
                	<div class="TitleContainer">
                		<a href="javascript:void(0)" class="Edit" data-toggle="modl" data-target="#exampleModal" data-whatever="@mdo" onclick="exampleup()">
                			<img src="/Public/Web/web/img/01_shouye/home_sy_icon_advice_bj_n.png">
                		</a>
                		<h4 class="text-center FontColor">Advice Column</h4>
						<!-- <a href="#" class="More">
                			<img src="img/01_shouye/home_sy_icon_c_more_n.png">
                		</a> -->
                	</div>
                    <p class="ProposaText">
                    	In order to better serve the site,please put forward your valuable advice
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- advice end 建议 -->
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
    <script src="/Public/Web/js/lib/layui/src/layui.js"></script>
    <script src="/Public/Web/web/js/index.js"></script>
    <script src="/Public/Web/web/js/loginQuit.js"></script>

</body>

<script>


    function godonation() {
        var aa = "<?php echo ($userid); ?>";
        if(aa){
            window.location.href="<?php echo U('Index/Index/donation');?>";
        }else{
            layer.msg("请先登录",{
                    time:1500,
                },function(){
                    //window.location.href="<?php echo U('Index/Login/login');?>&mm=Index&cc=Index&&aa=donation&&url=1";
                window.location.href="<?php echo U('Index/Login/login');?>";
                }
            );
        }
    }
    
    function exampleup() {

        var aa = "<?php echo ($userid); ?>";
        if(aa){
            $('#exampleModal').modal('show');
        }else{
            layer.msg("请先登录",{
                    time:1500,
                },function(){

                    window.location.href="<?php echo U('Index/Login/login');?>";
                }
            );
        }

        
    }

    function donationlist() {

        var aa = "<?php echo ($userid); ?>";
        if(aa){
            window.location.href="<?php echo U('Index/Index/listOfDonations');?>";
        }else{
            layer.msg("请先登录",{
                    time:1500,
                },function(){
                    //window.location.href="<?php echo U('Index/Login/login');?>&mm=Index&cc=Index&&aa=listOfDonations&&url=1";
                    window.location.href="<?php echo U('Index/Login/login');?>";
                }
            );
        }

    }
    
    function upproposal() {

        $.ajax({
            type:"post",
            url:"<?php echo U('Index/Ajax/ajax_createproposal');?>",
            data:{
                text:$("#message-text").val(),
                type:$("#proposal-type").val(),

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
                            $('#exampleModal').modal('hide');
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
<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>My Product</title>
        <meta name="viewport" content="width=device-width, initial-scale=0 user-scalable=no, maximum-scale=1.0, minimum-scale=1.0">
        <link rel="stylesheet" href="/Public/Web/web/css/register.css">
        <link rel="stylesheet" href="/Public/Web/web/css/Donation.css">
        <link rel="stylesheet" href="/Public/Web/js/lib/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="/Public/Web/js/lib/bootstrap/dist/css/bootstrap-grid.min.css">
        <link rel="stylesheet" href="/Public/Web/js/lib/bootstrap/dist/css/bootstrap-reboot.min.css">
        <link rel="stylesheet" href="/Public/Web/js/lib/layui/dist/css/layui.css">
        <link rel="stylesheet" href="/Public/Web/web/css/Crumbsnav.css">
        <link rel="stylesheet" href="/Public/Web/web/css/success_index.css">
        <link rel="stylesheet" href="/Public/Web/web/css/mineProduct.css">
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
    <div class="container">
        <div class="row">
                <div class="col-md-6 crumbs">
                        <a href="<?php echo U('Index/Life/life');?>" class="crumbsa">Life</a>
                        <cite class="Icon"></cite>
                        <a href="<?php echo U('Index/Life/lSecondHandMarket');?>" class="crumbsa">Second-Hand Market</a>
                        <cite class="Icon"></cite>
                        <span class="crumbsTitle">My product</span>
                    </div>
                    <div class="col-md-6">
                            <div class="SelectionContainer">
                                    <input type="text" class="layui-input" id="Selectionform">
                                    <a href="#" id="SelectionIcon">
                                    <img src="/Public/Web/web/img/02_interest/interest_qxx_search_icon.png">
                                    </a>
                                </div>
                    </div>
        </div>
    </div>
        <!-- tabs -->
        <div class="container">
                <div class="layui-tab">
                        <ul class="layui-tab-title">
                          <li class="layui-this">my release</li>
                          <li>my collection</li>
                        </ul>
                        <div class="layui-tab-content">
                          <div class="layui-tab-item layui-show MyRelease">
                              <div class="item_box">
                                  <div class="item_box_left">
                                      <div class="item_box_product_img">
                                            <img src="/Public/Web/web/img/02_interest/user.png">
                                      </div>
                                      <div class="item_box_product_details">
                                          <ul>
                                              <li>
                                                  <p>Product Name :</p>
                                                  <span>green food</span>
                                              </li>
                                              <li>
                                                    <p>Price :</p>
                                                    <span>$10</span>
                                                </li>
                                                <li>
                                                        <p>Product Description :</p>
                                                        <span>First, I want to tell you how proud we are. Getting into Columbia is a real testament of what 
                                                                a great well-rounded student you are. Your academic, artistic, and social skills have truly bl
                                                                ossomed in the last few years. Whether it is getting the highest grade in Calculus, completi
                                                                ng your elegant fashion design。
                                                            </span>
                                                    </li>
                                                    <li>
                                                            <p>Salary :</p>
                                                            <span>$ 1000 ~ $ 2000</span>
                                                        </li>
                                          </ul>
                                      </div>
                                  </div>
                                  <div class="item_box_right">
                                            <a href="#" data-toggle="modal" data-target="#box3" class="right_icon">
                                                <img src="/Public/Web/web/img/04_jobs/jobs_zwlb_m_icon_pj.png">
                                            </a>
                                            <a href="#" data-toggle="modal" data-target="#box2" class="right_icon">
                                                <img src="/Public/Web/web/img/04_jobs/jobs_zwlb_m_icon_close.png">
                                            </a>
                                            <a href="#" data-toggle="modal" data-target="#box1" class="right_icon">
                                                <img src="/Public/Web/web/img/04_jobs/jobs_zwlb_m_icon_del.png">
                                            </a>
                                    </div>
                                    
                            </div>

                            <div class="item_box">
                                <div class="item_box_left">
                                    <div class="item_box_product_img">
                                          <img src="/Public/Web/web/img/02_interest/user.png">
                                    </div>
                                    <div class="item_box_product_details">
                                        <ul>
                                            <li>
                                                <p>Product Name :</p>
                                                <span>green food</span>
                                            </li>
                                            <li>
                                                  <p>Price :</p>
                                                  <span>$10</span>
                                              </li>
                                              <li>
                                                      <p>Product Description :</p>
                                                      <span>First, I want to tell you how proud we are. Getting into Columbia is a real testament of what 
                                                              a great well-rounded student you are. Your academic, artistic, and social skills have truly bl
                                                              ossomed in the last few years. Whether it is getting the highest grade in Calculus, completi
                                                              ng your elegant fashion design。
                                                          </span>
                                                  </li>
                                                  <li>
                                                          <p>Salary :</p>
                                                          <span>$ 1000 ~ $ 2000</span>
                                                      </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="item_box_right">
                                          <a href="#" data-toggle="modal" data-target="#box3" class="right_icon">
                                              <img src="/Public/Web/web/img/04_jobs/jobs_zwlb_m_icon_pj.png">
                                          </a>
                                          <a href="#" data-toggle="modal" data-target="#box2" class="right_icon">
                                              <img src="/Public/Web/web/img/04_jobs/jobs_zwlb_m_icon_close.png">
                                          </a>
                                          <a href="#" data-toggle="modal" data-target="#box1" class="right_icon">
                                              <img src="/Public/Web/web/img/04_jobs/jobs_zwlb_m_icon_del.png">
                                          </a>
                                  </div>
                                  
                          </div>
                              </div>
                          
                          <div class="layui-tab-item">
                            <div class="item_box">
                                <div class="item_box_left">
                                        <a href="../web/lifeProductDetails.html">
                                    <div class="item_box_product_img">
                                          <img src="/Public/Web/web/img/02_interest/user.png">
                                    </div>
                                    <div class="item_box_product_details">
                                        <ul>
                                            <li>
                                                <p>Product Name :</p>
                                                <span>green food</span>
                                            </li>
                                            <li>
                                                  <p>Price :</p>
                                                  <span>$10</span>
                                              </li>
                                              <li>
                                                      <p>Product Description :</p>
                                                      <span>First, I want to tell you how proud we are. Getting into Columbia is a real testament of what 
                                                              a great well-rounded student you are. Your academic, artistic, and social skills have truly bl
                                                              ossomed in the last few years. Whether it is getting the highest grade in Calculus, completi
                                                              ng your elegant fashion design。
                                                          </span>
                                                  </li>
                                                  <li>
                                                          <p>Salary :</p>
                                                          <span>$ 1000 ~ $ 2000</span>
                                                      </li>
                                        </ul>
                                    </div>
                                </a>
                                </div>
                                <div class="item_box_right">
                                    <a href="../web/lifeProductDetails.html">
                                          <div class="right_pic">
                                              <img src="/Public/Web/web/img/02_interest/user.png" alt="">
                                          </div>
                                          <div class="right_name">
                                            Kendall J.
                                        </div>
                                    </a>
                                  </div>
                                 
                            </div>
                          </div>
                        </div>
                        </div>
                      </div>
        </div>
        <!-- 删除 -->
        <div id="box1" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="modal-title">
                            Reminder
                        </span>
                        <a class="close" data-dismiss="modal" aria-label="Close" style="position: absolute;right: 10px;top: 16px;">
                            <span aria-hidden="true">&times;
                        </a>
                    </div>
                    <div class="modal-body">
                        <p class="text-center">Do you delete the product?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">confirm</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- 关闭 -->
        <div id="box2" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="modal-title">
                            Reminder
                        </span>
                        <a class="close" data-dismiss="modal" aria-label="Close" style="position: absolute;right: 10px;top: 16px;">
                            <span aria-hidden="true">&times;
                        </a>
                    </div>
                    <div class="modal-body">
                        <p class="text-center">Do you confirm the completion of the transaction?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-completion-primary" data-dismiss="modal">confirm</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- 编辑 -->
        <div id="box3" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="modal-title">
                            Edit the product
                        </span>
                        <a class="close" data-dismiss="modal" aria-label="Close" style="position: absolute;right: 10px;top: 16px;">
                            <span aria-hidden="true">&times;
                        </a>
                    </div>
                    <div class="modal-body">
                        <div class="layui-form-item">
                            <label class="layui-form-label" style="margin-left: -22px;">
                                <p>product name ：</p>
                            </label>
                            <div class="layui-input-block" style="margin-left: 64px;">
                                <input type="text" name="title" lay-verify="title" autocomplete="off" placeholder="Enter product name" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label" style="margin-left: -22px;">
                                <p>product price ：</p>
                            </label>
                            <div class="layui-input-block" style="margin-left: 64px;">
                                <input type="text" name="title" lay-verify="title" autocomplete="off" placeholder="Enter product price" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label" style="margin-left: -22px;">
                                <p>Trading address ：</p>
                            </label>
                            <div class="layui-input-block" style="margin-left: 64px;">
                                <input type="text" name="title" lay-verify="title" autocomplete="off" placeholder="Enter transaction address" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label" style="margin-left: -22px;">
                                <p>contacts ：</p>
                            </label>
                            <div class="layui-input-block" style="margin-left: 64px;">
                                <input type="text" name="title" lay-verify="title" autocomplete="off" placeholder="Enter contacts" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label" style="margin-left: -22px;">
                                <p>contact number  ：</p>
                            </label>
                            <div class="layui-input-block" style="margin-left: 64px;">
                                <input type="text" name="title" lay-verify="title" autocomplete="off" placeholder="Enter contact number " class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label" style="margin-left: -22px;">
                                <p>genre ：</p>
                            </label>
                            <select class="form-control">
                                <option>default</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                        <div class="layui-form-item layui-form-text" style="height: 100px;">
                                <label class="layui-form-label" style="margin-left: -22px;">
                                        <p>introduce ：</p>
                                    </label>
                                <div class="layui-input-block" style="">
                                    <textarea placeholder="Introduction of imported goods" class="layui-textarea"></textarea>
                                </div>
                            </div>
                       <div class="layui-form-item">
                            <label class="layui-form-label" style="margin-left: -22px;">
                                <p>upload pictures ：</p>
                            </label>
                            <div class="UserHeadImage">
                                <img id="pic" class="img">
                                <input id="upload" class="but" name="file" accept="image/*" type="file">
                            </div>
                        </div>
                        <div class="layui-form-item layui-form-text" style="height: 100px;">
                                <label class="layui-form-label" style="margin-left: -22px;">
                                        <p>Remarks ：</p>
                                    </label>
                                <div class="layui-input-block" style="">
                                    <textarea placeholder="Input remarks" class="layui-textarea"></textarea>
                                </div>
                            </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary">Preservation</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container" id="NumberOfPagesContainer">
            <div id="NumberOfPages"></div>
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
        //注意：选项卡 依赖 element 模块，否则无法进行功能性操作
        layui.use('element', function(){
        var element = layui.element;
        
        //…
        });
    </script>    
    <script src="/Public/Web/web/js/ListOfDonations.js"></script>
    <!-- 点击关闭删除 -->
    <script>
        $(function(){
            (function(){
                var num;
                $(".MyRelease").on('click',".item_box", function(event) {
                    num = $(this).index();
                });
                $(".btn-primary").on('click', function(event) {
                        $(".MyRelease .item_box").eq(num).remove();
                });
                $('.btn-completion-primary').on('click',function(){
                    console.log($(".MyRelease .item_box .item_box_right").eq(num))
                    $(".MyRelease .item_box .item_box_right").eq(num).html("<img src='/Public/Web/web/img/05_life/life_mproduct_icon_finished.png'>")
                })
            })();
            
        });
    </script>


</html>
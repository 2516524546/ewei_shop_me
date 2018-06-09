<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
     <head>
        <meta charset="UTF-8">
        <title>Address Book</title>
        <meta name="viewport" content="width=device-width, initial-scale=0 user-scalable=no, maximum-scale=1.0, minimum-scale=1.0">
        <link rel="stylesheet" href="../web/css/register.css">
        <link rel="stylesheet" href="../web/css/Donation.css">
        <link rel="stylesheet" href="../web/css/Crumbsnav.css">
        <link rel="stylesheet" href="../js/lib/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="../js/lib/bootstrap/dist/css/bootstrap-grid.min.css">
        <link rel="stylesheet" href="../js/lib/bootstrap/dist/css/bootstrap-reboot.min.css">
        <link rel="stylesheet" href="../js/lib/layui/dist/css/layui.css">
        <link rel="stylesheet" href="../web/css/Crumbsnav.css">
        <link rel="stylesheet" href="../web/css/success_index.css">
        <link rel="stylesheet" href="../web/css/AddressBook.css">
    </head>

    <body>
         <!-- logo -->
        <header class="container">
                <div class="logreg">
                    <a href="login.html" class="Login">
                        <span class="LoginIcon"></span>
                        <span>Login</span>
                    </a>
                    <a href="register.html" class="SignUp">
                        <span class="SignUpIcon"></span>
                        <span>Sign Up</span>
                    </a>
                </div>
                <div class="login_success">
                                
                        <div class="success_index">
                                <a href="index.html">
                                    <img src="img/common_dh_icon_home.png" alt="">
                                </a>
                            </div>
                            <div class="success_setting">
                                    <img src="img/setting.png" alt="">
                                    <div class="dot"></div>
                                    <div class="setting_usage">
                                        <ul>
                                            <li>
                                                <a href="AcountSetting.html">
                                                    <div class="usage_img">
                                                        <img src="img/person.png"">
                                                    </div>
                                                    Account Settings
                                                </a>
                                            </li>
                                            <li>
                                                <a href="ResumeDetails.html">
                                                    <div class="usage_img">
                                                        <img src="img/resume.png"">
                                                    </div>
                                                    My Resume
                                                </a>
                                            </li>
                                            <li>
                                                <a href="MyPosts.html">
                                                        <div class="usage_img">
                                                                <img src="img/release.png"">
                                                            </div>
                                                    My Release
                                                </a>
                                            </li>
                                            <li>
                                                <a href="MyMessage.html">
                                                        <div class="usage_img">
                                                                <img src="img/message.png"">
                                                            </div>
                                                    Message
                                                    <div class="dot1"></div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="MyFollowing.html">
                                                        <div class="usage_img">
                                                                <img src="img/focus.png"">
                                                            </div>
                                                    My Focus
                                                </a>
                                            </li>
                                            <li>
                                                <a href="AddressBook.html">
                                                        <div class="usage_img">
                                                                <img src="img/contacts.png"">
                                                            </div>
                                                    Contacts
                                                </a>
                                            </li>
                                            <li>
                                                <a href="MyGroup.html">
                                                        <div class="usage_img">
                                                                <img src="img/group.png"">
                                                            </div>
                                                    My Group
                                                </a>
                                            </li>
                                            <li>
                                                <a href="feedback.html">
                                                        <div class="usage_img">
                                                                <img src="img/feedback.png"">
                                                            </div>
                                                    Feedback
                                                </a>
                                            </li>
                                            <li class="quit">
                                                <a href="#">
                                                    <div class="usage_img">
                                                        <img src="img/sign_out.png"">
                                                    </div>
                                                    Sign Out
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                            </div>
                            <div class="success_user">
                                <a href="PersonalCenter.html">
                                    <img src="img/01_shouye/UserPic.png" alt="">
                                </a>
                            </div>
                            <div class="success_name">
                                <a href="PersonalCenter.html">Davie</a>
                            </div>
                            <div class="success_line"></div>
                            <div class="success_money">
                                <a href="VirtualCurrencyRecharge.html">
                                    <div class="money_img">
                                        <img src="img/money.png" alt="">
                                    </div>
                                    <div class="money_num">
                                        1280
                                    </div>
                                </a>
                            </div>
                            
            </div>
            </header>
            <hr>

        <!-- Crumbs nav -->
        <div class="container">
                <div class="row">
                    <div class="col-md-6 crumbs">
                            <a href="index.html" class="crumbsa"><img src="./img/common_dh_icon_home.png" alt=""></a>
                            <cite class="Icon"></cite>
                            <span class="crumbsTitle">Address Book</span>
                        </div>
                        <div class="col-md-6">
                            <div class="SelectionContainer">
                                <input type="text" class="layui-input" id="Selectionform">
                                <a href="#" id="SelectionIcon">
                                <img src="img/02_interest/interest_qxx_search_icon.png">
                                </a>
                            </div>
                        </div>
                </div>
            </div>


            <!-- AddressBook content -->
            <div class="container">
                <div class="AddressBook_box">
                    <div class="AddressBook_item">
                        <div class="AddressBook_left">
                            <a href="PersonalCenter.html">
                                <div class="AddressBook_left_img">
                                    <img src="../web/img/01_shouye/UserPic.png" alt="">
                                </div>
                                <div class="AddressBook_left_user">
                                    Kendall J.
                                </div>
                        </a>
                            </div>
        
                            <div class="AddressBook_right">
                                <div class="AddressBook_btn">
                                        ChangeName
                                </div>
                                <div class="AddressBook_btn">
                                        Delete
                                </div>
                            </div>

                    </div>

                    <div class="AddressBook_item">
                        <div class="AddressBook_left">
                            <a href="PersonalCenter.html">
                                <div class="AddressBook_left_img">
                                    <img src="../web/img/01_shouye/UserPic.png" alt="">
                                </div>
                                <div class="AddressBook_left_user">
                                    Kendall J.
                                </div>
                        </a>
                    </div>
        
                            <div class="AddressBook_right">
                                <div class="AddressBook_btn">
                                        ChangeName
                                </div>
                                <div class="AddressBook_btn">
                                        Delete
                                </div>
                            </div>

                    </div>

                    <div class="AddressBook_item">
                        <div class="AddressBook_left">
                            <a href="PersonalCenter.html">
                                <div class="AddressBook_left_img">
                                    <img src="../web/img/01_shouye/UserPic.png" alt="">
                                </div>
                                <div class="AddressBook_left_user">
                                    Kendall J.
                                </div>
                        </a>
                    </div>
        
                            <div class="AddressBook_right">
                                <div class="AddressBook_btn">
                                        ChangeName
                                </div>
                                <div class="AddressBook_btn">
                                        Delete
                                </div>
                            </div>

                    </div>

                </div>
                <div class="container" id="NumberOfPagesContainer">
                        <div id="NumberOfPages"></div>
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
    <script src="../js/lib/jquery/dist/jquery.min.js"></script>
    <script src="../js/lib/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/lib/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../js/lib/layui/dist/layui.all.js"></script>
    <script src="../web/js/StickSonDetails.js"></script>
    <script src="../web/js/loginQuit.js"></script>
</html>
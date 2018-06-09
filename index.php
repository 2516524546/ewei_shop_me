<?php 
//设置头信息
header('Content-type:text/html;charset=utf-8');
//定义项目目录
define('APP_PATH','./World/');
//存储密码前缀
define('MA','Piano_');
//开启调试
define('APP_DEBUG',true);

//载入ThinkPHP入口文件
require 'ThinkPHP/ThinkPHP.php';

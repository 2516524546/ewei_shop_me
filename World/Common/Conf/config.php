<?php
return array(
	//'配置项'=>'配置值'
		
	//设置前后台模块
	'MODULE_ALLOW_LIST'      =>  array('Home','Index'),
	'DEFAULT_MODULE'        =>  'Index',  // 默认模块
	'DEFAULT_CONTROLLER'    =>  'index', // 默认控制器名称
	'DEFAULT_ACTION'        =>  'index', // 默认操作名称
	'URL_MODEL'             =>  0,       // URL访问模式,可选参数0、1、2、3,代表以下四种模式：
    // 0 (普通模式); 1 (PATHINFO 模式); 2 (REWRITE  模式); 3 (兼容模式)  默认为PATHINFO 模式
//	'READ_DATA_MAP'=>true, //开启自动处理字段映射
    //数据库配置
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  '127.0.0.1', // 服务器地址
    'DB_NAME'               =>  'newworld',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  'root',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  '',    // 数据库表前缀
    'UPLOAD_MAX_FILESIZE'=>'10M',//设置上传文件的大小
    'UPLOAD_ALLOW_EXTS'=>array('jpg', 'gif', 'png', 'jpeg'),//设置上传文件的类型
    'UPLOAD_ROOT_PATH'=>'./Public/Uploads/',//设置上传文件存储的根路径
    
	'DEFAULT_FILTER'        => 'strip_tags,htmlspecialchars,trim',
	//极光推送key
	'D_APPKEY' => 'aabd0016952aa348019316f8',
	'D_MAS' => '2dfd8ef803de86d74b426a31',
	'D_APPKEY1' => 'aabd0016952aa348019316f8',
	'D_MAS1' => '2dfd8ef803de86d74b426a31',
    //语言
    'LANG_SWITCH_ON' => true,   // 开启语言包功能
    'LANG_AUTO_DETECT' => true, // 自动侦测语言 开启多语言功能后有效
    'LANG_LIST'        => 'zh-cn,en-us', // 允许切换的语言列表 用逗号分隔
    'VAR_LANGUAGE'     => 'l', // 默认语言切换变量


);
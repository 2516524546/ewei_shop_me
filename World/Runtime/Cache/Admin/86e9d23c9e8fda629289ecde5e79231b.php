<?php if (!defined('THINK_PATH')) exit();?><head>
		<meta charset="utf-8" />
		<title>子昊钢琴后台管理系统</title>
		<meta name="keywords" content="子昊钢琴后台管理系统" />
		<meta name="description" content="子昊钢琴后台管理系统" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<!-- basic styles -->
		<link href="/Public/Admin//admin/css/bootstrap.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="/Public/Admin//admin/css/font-awesome.min.css" />

		<!--[if IE 7]>
		  <link rel="stylesheet" href="/Public/Admin//admin/css/font-awesome-ie7.min.css" />
		<![endif]-->

		<!-- page specific plugin styles -->
		<link rel="stylesheet" href="/Public/Admin/admin/css/jquery-ui-1.10.3.custom.min.css" />
		<link rel="stylesheet" href="/Public/Admin/admin/css/chosen.css" />
		<link rel="stylesheet" href="/Public/Admin/admin/css/datepicker.css" />
		<link rel="stylesheet" href="/Public/Admin/admin/css/bootstrap-timepicker.css" />
		<link rel="stylesheet" href="/Public/Admin/admin/css/daterangepicker.css" />
		<link rel="stylesheet" href="/Public/Admin/admin/css/colorpicker.css" />
		<link rel="stylesheet" href="/Public/Admin/admin/css/colorbox.css" />
		<!-- ace styles -->

		<link rel="stylesheet" href="/Public/Admin/admin/css/ace.min.css" />
		<link rel="stylesheet" href="/Public/Admin/admin/css/ace-rtl.min.css" />
		<link rel="stylesheet" href="/Public/Admin/admin/css/ace-skins.min.css" />

		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="/Public/Admin//admin/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->
			<!--[if !IE]> -->

		<script src="/Public/Admin/admin/js/jquery-2.0.3.min.js"></script>
		
		<!-- <![endif]-->
		<!-- ace settings handler -->

		<script src="/Public/Admin//admin/js/ace-extra.min.js"></script>

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

		<!--[if lt IE 9]>
		<script src="/Public/Admin//admin/js/html5shiv.js"></script>
		<script src="/Public/Admin//admin/js/respond.min.js"></script>
		<![endif]-->

		<style type="text/css">
			.info_table{
				margin-top:50px; 
				width:60%;
				float: left;
				margin-left:10%;
			}
			.info_table tr td{
				height: 50px;
				border: 1px;
				border: ridge;
				border-color:#ddd;
			}
			.table_title{
				width:20%;
				background-color: #eeeeee;
			}
			.table_content{
				width:30%;
			}
			.prd_table div{
				float:left;
				width:200px;
				height:320px;
				margin-top:40px;
				margin-left:40px;
			}
			.prd_table button{
				float: right;
				width: 25px;
				height:25px;
				margin-left:150px; 
			}
			.prd_table img{
				
				width:160px;
				height:220px;
				
			}
			.prd_table p{
				font-size:15px;
			}
			.moliao tr td{
				width:170px;
				height: 35px;
				border: 1px;
				border: ridge;
				border-color:#ddd;
				text-align:center;
			}
			.moliao{
				margin-top:20px;
			}
			.user_op{
				border-style: solid;
				border-color:#eee;
				background: #ddd;
				float:right;
				width:125px;
				margin-left:10px;
				margin-top:5px;
			}
			.page{
				position: absolute;
				bottom: 0px;
				right: 80%;
			}
			.fenhao{
				margin-left:15%; 
            	margin-bottom: 3px;    
            	width:350px;
            	height:200px;
            	text-align:center;
            	display: none;
			}
			.remen{
				margin-left:15%; 
            	margin-bottom: 3px;    
            	width:350px;
            	height:200px;
            	text-align:center;
            	display: none;
			}
			.closeroom{
				float;left;
				margin-left:15%; 
            	margin-bottom: 3px;    
            	width:350px;
            	height:200px;
            	text-align:center;
            	display: none;
			}
			.btnn{
				margin:15px;
				font-size: 21px;
				margin-left:15px;
				border: none;
				background-color:#ffffff; 
				color: blue;
			}
		</style>
	</head>
	<body style='background:#fff;'>
	<div class="main-content">
					<div class="breadcrumbs" id="breadcrumbs">
						<script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>

						<ul class="breadcrumb">
							<li>
								<i class="icon-home home-icon"></i>
								<a href="#">首页</a>
							</li>
							<li class="active">控制台</li>
						</ul><!-- .breadcrumb -->
					</div>

				
				</div><!-- /.main-content -->
<div class="page-content">
	<div class="page-header">
		<h1>
			设置
			<small> <i class="icon-double-angle-right"></i>
			修改个人信息	 
			</small>
		</h1>
	</div>
	<div class="row">
		<div class="col-xs-12">	
	
<div class="row" style="padding-bottom: 10px;">
							<div class="col-sm-12">
								<div id="sample-table-2_filter">
								
								<!-- 按钮样式 -->		
							<style type='text/css'>
								.anniu{width:100%; height:40px; position:relative;}
								 .anniu ul{width:auto; height:30px; border:1px solid #ccc; overflow:hidden; position:absolute; top:0; left:0; list-style:none; color:#333; box-sizing:border-box; font-size:13px; cursor: pointer;}	    
								 .anniu ul li.current{background:#2679b5; color:#fff;width:100px; height:30px; float:left; border-right:1px solid #ccc;  line-height:30px; text-align:center; box-sizing:border-box;}
								.anniu ul li{width:100px; height:30px; float:left; border-right:1px solid #ccc;  line-height:30px; text-align:center; box-sizing:border-box;}
							</style>
								<div class='anniu'>
									<ul>
										<li onClick="my_info()">个人信息</li>
										<li class="current" onClick="up_myinfo()" >修改个人信息</li>
										<li onClick="my_pwd()">修改密码</li>
										<!-- <li class="<?php if($status==3){echo 'current';}?>" onclick="shebie_renzheng(3)">认证不通过</li>
										 -->
									</ul>
								</div>
								<!-- 按钮样式 -->
								</div>
							</div>
						</div>
			
	
	<div class="row" style="background-color: #eff3f8;">
	
	<div class="row">
		<div class="col-xs-12">
			<form class="form-horizontal" action="<?php echo U('Admin/User/saveinfo');?>" method="POST" role="form" enctype="multipart/form-data">
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1">用户账号</label>
						<div class="col-sm-9">
							<input type="text" name="username" value="<?php echo $user['username'];?>" readonly/ />
						</div>
					</div>

				
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1">姓名</label>
						<div class="col-sm-9">
							<input type="text" name="fzr_name" value="" />	
						</div>
					</div>

					 <div class="form-group" >
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1">身份证</label>
						<div class="col-sm-9">
							<input type="text" name="card" value="" />
						</div>
			     	</div>
			     	 <div class="form-group" >
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1">联系电话</label>
						<div class="col-sm-9">
							<input type="text" name="mobile" value=""  />
						</div>
			     	</div>

					<div class="form-actions center">
					<a  class="btn btn-sm btn-success" id='queren'>
						<i class="icon-edit bigger-110"></i>
						确认
					</a>

					<a class="btn btn-sm btn-warning" href="javascript:history.back(-1)" target="rightFrame" class="myButton">
						<i class="icon-arrow-left icon-on-left bigger-110"></i>
						取消
					</a>
					</div>
			</form>

		</div>
	</div>
</div>



<script src="/Public/Admin/admin/js/date-time/bootstrap-datepicker.min.js"></script>
<script src="/Public/Admin/admin/js/date-time/bootstrap-timepicker.min.js"></script>
<script src="/Public/Admin/admin/js/date-time/moment.min.js"></script>
<script src="/Public/Admin/admin/js/date-time/daterangepicker.min.js"></script>

<!-- ajax 提交表单 -->

<script type="text/javascript" language="javascript" src="/Public/Admin/admin/js/jquery.tan.js"></script>
<script type="text/javascript" language="javascript" src="/Public/Admin/admin/js/jquery.form.js"></script>

<script>
function my_info(){
	location.href = "index.php?m=Admin&c=User&a=my_info"
}
function up_myinfo(){
	location.href = "index.php?m=Admin&c=User&a=up_myinfo"
}
function my_pwd(){
	location.href = "index.php?m=Admin&c=User&a=my_pwd"
}

$(function(){
	var options = {
		        beforeSubmit:showStart,
		        success:showSuccess,

		 };
	$('#queren').click(function(){
	  
		$('.form-horizontal').ajaxSubmit(options);
		
	})
	
})
function showSuccess(data){

    	if(data == 1){
    		alert('修改成功')
    		location.href="<?php echo U('Admin/User/my_info');?>"
    	}else{
    		alert(data)
    		return false
    	}

}
function showStart(){
    return true;
}
</script>
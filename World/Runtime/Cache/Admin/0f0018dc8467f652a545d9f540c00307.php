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
			个人信息	 
			</small>
		</h1>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<!-- PAGE CONTENT BEGINS -->
		
			<!-- <div class="alert alert-block alert-success">
				<button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button>
			
			</div> -->
		
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
										<li class="current" onClick="my_info()" >个人信息</li>
										<li onClick="up_myinfo()" >修改个人信息</li>
										<li onClick="my_pwd()">修改密码</li>
										<!-- <li class="<?php if($status==3){echo 'current';}?>" onclick="shebie_renzheng(3)">认证不通过</li>
										 -->
									</ul>
								</div>
								<!-- 按钮样式 -->
								</div>
							</div>
						</div>
			
			<div class="hr hr-18 dotted hr-double"></div>

		</div>
		<!-- /.col -->
		<div class="row">
		<div class="col-xs-12">
			<form class="form-horizontal" action="<?php echo U('Admin/my_info');?>" method="POST" role="form" enctype="multipart/form-data">
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1">用户账号</label>
						<div class="col-sm-9">
							<input type="text" name="username" value="<?php echo $list['username'];?>" readonly/>
						</div>
					</div>
				

					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1">角色</label>
						<div class="col-sm-9">
							<input type="text" name="juese" value="<?php if($list['juese']==1){echo '超级管理员';}else{echo '普通管理员';}?>" readonly />
						</div>
					</div>
				
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1">姓名</label>
						<div class="col-sm-9">
							<input type="text" name="fzr_name" value="<?php echo $list['fzr_name'];?> " readonly/>	
						</div>
					</div>

					 <div class="form-group" >
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1">身份证号码</label>
						<div class="col-sm-9">
							<input type="text" name="card" value="<?php echo $list['card'];?>" readonly/>
						</div>
			     	</div>
			     	 <div class="form-group" >
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1">联系电话</label>
						<div class="col-sm-9">
							<input type="text" name="mobile" value="<?php echo $list['mobile'];?>" readonly />
						</div>
			     	</div>

					
					</div>
			</form>
		</div>
	</div>
</div>

		
	<!-- /.row -->
</div>
<div id='datu' style=" background:rgba(0,0,0,0.5); height:auto; left:0; position: absolute; top:0; width:100%; padding-bottom:10%; z-index: 2;display:none"></div> 
</body>
<!-- /.page-content -->
<style type="text/css" media="screen">
	.btn-xs {
		margin-right: 10px!important;
	}
</style>

<script src="/Public/Admin/admin/js/date-time/bootstrap-datepicker.min.js"></script>
<script src="/Public/Admin/admin/js/date-time/bootstrap-timepicker.min.js"></script>
<script src="/Public/Admin/admin/js/date-time/moment.min.js"></script>
<script src="/Public/Admin/admin/js/date-time/daterangepicker.min.js"></script>

<script type="text/javascript">
	
$('.date-picker').datepicker({autoclose:true}).next().on(ace.click_event, function(){
	$(this).prev().focus();
});
</script>
<script src="/Public/Admin/admin/js/jquery.js" type="text/javascript"></script>
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

function renzheng(sb_id,status){
	$.ajax({
		url:"index.php?m=Admin&c=Renzheng&a=shebei_renzheng",
		data:'status='+status+'&sb_id='+sb_id,
		type:'post',
		success:function(msg){
			if(msg == 1){
				location.href = "index.php?m=Admin&c=Renzheng&a=shebei_renzheng_list&status="+status
			}else{
				alert(msg)
				return false
			}
			
		}
	})
}
$(function(){
   
   //点击全选
	 //获取所有checkbox对象
	/*    var box = document.getElementsByName("box");
	   var checkbox = document.getElementsByName("ids");
	   //alert(box[0].checked)
	   //return false
	   $("input[name='box']").click(function(){ 
		   if(box[0].checked){	
			    for(var i=0;i<checkbox.length;i++){
			        checkbox[i].checked = true;
			     }	
		    }else{
		    	for(var i=0;i<checkbox.length;i++){
			        checkbox[i].checked = false;
			     }
		    }
	   })
	   
	   $("input[name='ids']").click(function(){ 
		    var length=0;
		    for(var i=0;i<checkbox.length;i++){
		        if(checkbox[i].checked){
		        	length++
		        }  
		     }
		    if(length == checkbox.length){
		    	box[0].checked = true
		    }else{
		    	box[0].checked = false
		    }
	   }) */
})
</script>
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
				轮播图管理
			</small>
		</h1>
		
	<!-- 	 <form class="daoru" action="<?php echo U('Daili/Index/upload_execl');?>" method="POST" enctype="multipart/form-data" style="margin-top:20px;">
         <input type='file' name='execl' style=" width:150px; height:30px; display:inline-block; margin-right:30px;"/>
		 <span style='width:85px; height:30px; background:#2679b5; color:#fff; margin-right:10px; display:inline-block; line-height:30px;text-align:center; borde-radius:4px;' id='daoru'>导入数据</span>
		</form> 	 -->	
	</div>


<div class="row" style="padding-bottom: 10px;">
	 <form class="form-horizontal" action="<?php echo U('Admin/Conf/up_speed');?>" method="POST" role="form" enctype="multipart/form-data">
		<div class="col-sm-9" >
			当前轮播图速度 <input value="<?php echo $speed['speed']; ?>秒/图">
			<select name="speed"  >
				<option value="">请选择</option>
				<option value="1">1秒/图</option>
				<option value="2">2秒/图</option>
				<option value="3">3秒/图</option>
				<option value="4">4秒/图</option>
				<option value="5">5秒/图</option>
			</select>
			<a  id ="sure" class="btn btn-sm btn-success">
				<i class="icon-edit bigger-110">确定</i>
			</a>
		</div>
	</form>
</div>

<!-- ajax 提交表单 -->
<script type="text/javascript" language="javascript" src="/Public/Admin/admin/js/jquery.tan.js"></script>
<script type="text/javascript" language="javascript" src="/Public/Admin/admin/js/jquery.form.js"></script>

<script>
function showStart(){
    return true;
}
function showSuccess(data){	
    	if(data == 1){
    		alert('修改成功')
    		location.href="<?php echo U('Admin/Conf/lunbo_list');?>"
    	}else{
    		alert(data)
    		return false
    	} 
}
$(function(){
	var options = {
		        beforeSubmit:showStart,
		        success:showSuccess,
		 };
	$('#sure').click(function(){
		
		$('.form-horizontal').ajaxSubmit(options);
	})	
})
</script>











<div class="row">
	<div class="col-xs-12">
		<div class="row" style="padding-bottom: 10px;">
			<div id="sample-table-2_filter">	
				<div style=' width:50%; height:40px; '>
					<a href="<?php echo U('Admin/Conf/lunbo_add');?>" target="rightFrame"><span style=' width:100px; height:34px; background:#2679b5; color:#fff; margin-right:10px; display:inline-block; line-height:34px;text-align:center; borde-radius:4px;'>添加轮播图</span></a>
				</div> 
			</div>
		</div>
	</div>
</div>

			<div class="row">
				<div class="col-xs-12">
					<div class="table-responsive">
						<table id="sample-table-1" class="table table-striped table-bordered table-hover" style="margin-bottom: 0px;font-size:13px;width:60%;">
							<thead>
								<tr style=' font-size: 13px;'>
								    <!-- <th><input type='checkbox' name='' value=''></th> -->
									<th>序号</th>
									<th>平板轮播图</th>
									<th>手机轮播图</th>
									<th>跳转链接</th>	
									<th>播放位置</th>				
									<th>操作</th>
								</tr>
							</thead>

							<tbody>
							<?php foreach($list as $k=>$v){?>
								<tr>
								   <!--  <td><input type='checkbox' name='' value=''></td> -->
									<td><?php echo $k+1;?></td>
									<td>
									    <input value="<?php echo $v['b_url']?>" type="hidden">
                                      <img class="datu" src="<?php echo $v['b_url']?>"  height="30px;">
                                    </td>
									<td>
									    <input value="<?php echo $v['b_url1']?>" type="hidden">
                                      <img class="datu" src="<?php echo $v['b_url1']?>"  height="30px;">
                                    </td>
									<td><?php echo $v['b_link']?></td>
									<td><?php  if($v['b_set']==1){echo '首页';}elseif($v['b_set'] == 2){echo '直播室';}else{echo '琴行';}?></td>
									<td>
										<div class="visible-md visible-lg hidden-sm hidden-xs btn-group">
											<a href="index.php?m=Admin&c=Conf&a=banner_edit&bid=<?php echo $v['bid']?>" class="btn btn-xs btn-success" >修改</a>		
										    <a href="#" class="btn btn-xs btn-success" onClick="banner_del(<?php echo $v['bid']?>)" style="margin:0,0,0,45px;">删除</a>		
										
										</div>
									</td>
								</tr>
							<?php }?>	
							</tbody>
						</table>
						<div class="dataTables_paginate paging_bootstrap" style="border-top: 1px solid #DDD;padding-top: 12px;padding-bottom: 12px;background-color: #eff3f8;border-bottom: 1px solid #DDD;width:60%;">
							<div style='margin-right:56px;'>
							  <?php echo $page;?>
							</div>
						</div>
					</div>
					<!-- /.table-responsive -->
				</div>
				<!-- /span -->
			</div>
			<!-- /row -->
			<div class="hr hr-18 dotted hr-double"></div>

		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->
</div>
<div id='datu' style=" background:rgba(0,0,0,0.5); height:auto;min-height:100%; left:0; position: absolute; top:0; width:100%; padding-bottom:10%; z-index: 2;display:none"></div>
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
<script>
	
$('.date-picker').datepicker({autoclose:true}).next().on(ace.click_event, function(){
	$(this).prev().focus();
});

//删除轮播图
function banner_del(bid){
	if(confirm("此操作不可逆,确认删除吗?")){
		$.ajax({
			url:'index.php?m=Admin&c=Conf&a=banner_del',
			type:'post',
			data:'bid='+bid,
			success:function(msg){
				if(msg == 1){
					alert('操作成功')
					location.href = "index.php?m=Admin&c=Conf&a=lunbo_list"
				}else{
					alert(msg)
					return false
				}
			}
		})
	}
}

$(function(){
	//查看大图

	$('.datu').click(function(){
		$(".datu").css('display','block')
		$("#datu").css('display','block')
		
		var src=$(this).attr('src')
		var str='<img src="'+src+'" width="60%" style="margin:10% 0 0 20%;"/>'
		$("#datu").html(str)	
	})
    $("#datu").click(function(){
		$("#datu").css('display','none')
			
	})
})
</script>
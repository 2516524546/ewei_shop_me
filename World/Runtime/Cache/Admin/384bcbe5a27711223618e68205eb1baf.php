<?php if (!defined('THINK_PATH')) exit();?><head>
		<meta charset="utf-8" />
		<title>快乐琴行后台管理系统</title>
		<meta name="keywords" content="快乐琴行后台管理系统" />
		<meta name="description" content="快乐琴行后台管理系统" />
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
				app版本
			</small>
			 
		</h1>
		
	<!-- 	 <form class="daoru" action="<?php echo U('Daili/Index/upload_execl');?>" method="POST" enctype="multipart/form-data" style="margin-top:20px;">
         <input type='file' name='execl' style=" width:150px; height:30px; display:inline-block; margin-right:30px;"/>
		 <span style='width:85px; height:30px; background:#2679b5; color:#fff; margin-right:10px; display:inline-block; line-height:30px;text-align:center; borde-radius:4px;' id='daoru'>导入数据</span>
		</form> 	 -->	
	</div>
	<div class="row">
		<div class="col-xs-12">
		   
			 <div class="row" style="padding-bottom: 10px;">
							<div class="col-sm-12">
								<div id="sample-table-2_filter">
								<div style=' width:50%; height:40px; '>
					<a href="index.php?m=Admin&c=Conf&a=show_app_add" target="rightFrame"><span style=' width:100px; height:34px; background:#2679b5; color:#fff; margin-right:10px; display:inline-block; line-height:34px;text-align:center; borde-radius:4px;'>新增版本</span></a>
				</div> 
									<!-- <form class="form-horizontal" action="<?php echo U('Admin/Luntan/tiezi_list_sou');?>" method="POST" role="form" enctype="multipart/form-data">
									<div class="btn-group" style='margin-top:5px;'>
										<span>发贴人:</span>
										<input type="text" name="name" value="<?php if($name){echo $name;}?>">
									</div>
									<input type='hidden' name='button' value='1'/>
						
									
									<div class="btn-group" style="margin-right:10px;margin-top:5px;">											
											<div class="input-group">
											<span>发布时间：</span>
												<input class="form-control date-picker" value="<?php if($stime){echo $stime;}?>" name="stime" id="id-date-picker-1" style="width: 35%" type="text" data-date-format="yyyy-mm-dd" />
												-
												<input class="form-control date-picker" value="<?php if($etime){echo $etime;}?>" name="etime" id="id-date-picker-1" style="width: 35%" type="text" data-date-format="yyyy-mm-dd" /> 
											</div>
									</div>

								

									<div class="btn-group" style='margin-top:5px;'>
											<span class="input-group-btn">
												<button type="submit" style="padding:0" class="btn btn-purple btn-sm">
													搜索<i class="icon-search icon-on-right bigger-110"></i>
												</button>
											</span>
										
									</div>
								
									</form> -->
				
								</div>
							</div>
						</div>
			<div class="row">
				<div class="col-xs-12">
					<div class="table-responsive">
						<table id="sample-table-1" class="table table-striped table-bordered table-hover" style="margin-bottom: 0px;font-size:13px;">
							<thead>
								<tr style=' font-size: 13px;'>
								<!--   <th><input type='checkbox' name='' value=''></th>   -->
									<th>序号</th>
									<th>版本名</th>
									<th>链接地址</th>
									<th>发布时间</th>	
									<th>版本号</th>	
									<th>简介</th>	
									<th>适用</th>	
								
								</tr>
							</thead>

							<tbody>
							<?php foreach($list as $k=>$v){?>
								<tr>
								 <!--    <td><input type='checkbox' name='' value=''></td>--> 
									<td><?php echo $k+1;?></td>
									<td><?php echo $v['app_name'];?></td>
									<td><?php echo $v['app_url']?></td>
									<td><?php echo $v['app_time'];?></td>
									<td><?php echo $v['app_num'];?></td>
									<td><?php echo $v['app_info'];?></td>
									<td><?php if($v['app_kind']==1){echo '平板端更新';}else{echo '手机端更新';}?></td>
									<!-- <td><div class="visible-md visible-lg hidden-sm hidden-xs btn-group">
											<a href="index.php?m=Admin&c=Luntan&a=tiezi_xiang&id=<?php echo $v['tiezi_id']?>" class="btn btn-xs btn-success">详情</a>	
									</div></td> -->
									
								</tr>
							<?php }?>	
							</tbody>
						</table>
						<div class="dataTables_paginate paging_bootstrap" style="border-top: 1px solid #DDD;padding-top: 12px;padding-bottom: 12px;background-color: #eff3f8;border-bottom: 1px solid #DDD;">
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


<script src="/Public/Admin/admin/js/bootstrap.min.js"></script>
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




<!-- ajax 提交表单 -->

<script type="text/javascript" language="javascript" src="/Public/Admin/admin/js/jquery.tan.js"></script>
<script type="text/javascript" language="javascript" src="/Public/Admin/admin/js/jquery.form.js"></script>

<script>

//推荐
function tuijian(id){
	if(confirm("确定此操作吗?")){
		$.ajax({
			url:'index.php?m=Admin&c=Luntan&a=luntan_tuijian',
			data:'id='+id,
			type:'post',
			success:function(msg){
				if(msg == 1){
						alert('操作成功')
						location.href = "index.php?m=Admin&c=Luntan&a=show_tiezi_list"
					}else{
						alert(msg)
						return false
					}
			}
		})
	}	
}

//编辑
function jinhua(id){
	if(confirm("确定此操作吗?")){
		$.ajax({
			url:'index.php?m=Admin&c=Luntan&a=luntan_jinhua',
			data:'id='+id,
			type:'post',
			success:function(msg){
				if(msg == 1){
						alert('操作成功')
						location.href = "index.php?m=Admin&c=Luntan&a=show_tiezi_list"
					}else{
						alert(msg)
						return false
					}
			}
		})
	}	
}

//编辑
function mnew(id){
	if(confirm("确定此操作吗?")){
		$.ajax({
			url:'index.php?m=Admin&c=Luntan&a=luntan_new',
			data:'id='+id,
			type:'post',
			success:function(msg){
				if(msg == 1){
						alert('操作成功')
						location.href = "index.php?m=Admin&c=Luntan&a=show_tiezi_list"
					}else{
						alert(msg)
						return false
					}
			}
		})
	}	
}

//编辑
function del_tiezi(id){
	if(confirm("确定此操作吗?")){
		$.ajax({
			url:'index.php?m=Admin&c=Luntan&a=del_luntan',
			data:'id='+id,
			type:'post',
			success:function(msg){
				if(msg == 1){
						alert('操作成功')
						location.href = "index.php?m=Admin&c=Luntan&a=show_tiezi_list"
					}else{
						alert(msg)
						return false
					}
			}
		})
	}	
}

function pinbi_tiezi(id){
	if(confirm("确定此操作吗?")){
		$.ajax({
			url:'index.php?m=Admin&c=Luntan&a=pinbi_tiezi',
			data:'id='+id,
			type:'post',
			success:function(msg){
				if(msg == 1){
						alert('操作成功')
						location.href = "index.php?m=Admin&c=Luntan&a=show_tiezi_list"
					}else{
						alert(msg)
						return false
					}
			}
		})
	}	
}

function showStart(){
    return true;
}
function showSuccess(data){
    	if(data == 1){
    		alert('操作成功')
    		location.href="<?php echo U('Admin/Conf/admin_list');?>"
    	}else{
    		alert(data)
    		$('.modal').css('overflow','')
    		return
    	}

}
$(function(){
	var options = {
		        beforeSubmit:showStart,
		        success:showSuccess,

		 };
	$('#submit-ed').click(function(){	
		//alert('a')
		//return false
		$('#room_add').ajaxSubmit(options);
	})
	
})
</script>
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
			机构审核
			<small> <i class="icon-double-angle-right"></i>
				分销商审核列表
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
						
								
								
										<style type='text/css'>
								.anniu{width:100%; height:40px; position:relative;}
								 .anniu ul{width:auto; height:30px; border:1px solid #ccc; overflow:hidden; position:absolute; top:0; left:0; list-style:none; color:#333; box-sizing:border-box; font-size:13px; cursor: pointer;}	    
								 .anniu ul li.current{background:#2679b5; color:#fff;width:100px; height:30px; float:left; border-right:1px solid #ccc;  line-height:30px; text-align:center; box-sizing:border-box;}
								.anniu ul li{width:100px; height:30px; float:left; border-right:1px solid #ccc;  line-height:30px; text-align:center; box-sizing:border-box;}
							</style>

							<div class='anniu'>
								<?php if($status==1){?>
									<ul>
										<li class="current" onclick="send1()" >全部</li>
										<li onclick="send2()" >待审核</li>
										
										<li onclick="send4()">未通过</li>
									</ul>
								<?php }elseif($status==2){?>
									<ul>
										<li  onclick="send1()" >全部</li>
										<li  class="current" onclick="send2()" >待审核</li>
										
										<li  onclick="send4()">未通过</li>
									</ul>
								
								<?php }else{?>
									<ul>
										<li  onclick="send1()" >全部</li>
										<li  onclick="send2()" >待审核</li>
										
										<li  class="current"  onclick="send4()">未通过</li>
									</ul>
								<?php }?>
							</div>
								<!-- 按钮样式 -->
								</div>
							</div>
						</div>
			<div class="row">
				<div class="col-xs-12">
					<div class="table-responsive">
						<table id="sample-table-1" class="table table-striped table-bordered table-hover" style="margin-bottom: 0px;font-size:13px;">
							<thead>
								<tr style=' font-size: 13px;'>
								 <!--    <th><input type='checkbox' name='' value=''></th>  -->
									<th>ID</th>
									<th>所属代理商</th>
									<th>分销商名称</th>
									<th>账号</th>
									<th>负责人</th>
									<th>联系电话</th>			
									<th>角色</th>								
									<th>代理区域</th>
									<th>详细地址</th>		
									<th>身份证号</th>
									<th>新增时间</th>	
									<th>状态</th>
									<th>操作</th>
								</tr>
							</thead>

							<tbody>
							<?php foreach($data as $k=>$v){?>
								<tr>
								    <!-- <td><input type='checkbox' name='' value=''></td> -->
									<td><?php echo $v['jxid'];?></td>
									<td><?php echo $v['parent_name'];?></td>
									<td><?php echo $v['jx_name'];?></td>
									<td><?php echo $v['username']?></td>
									<td><?php echo $v['fzr_name']?></td>
									<td><?php echo $v['mobile']?></td>
									<td><?php if($v['juese']==1){echo '超级管理员';}else{echo '普通管理员';}?></td>
									<td><?php echo $v['jx_pro'].$v['jx_city'].$v['jx_area']?></td>
									<td><?php echo $v['jx_address']?></td>
									<td><?php echo $v['card']?></td>
									<td><?php echo $v['jx_addtime']?></td>
									<td><?php if($v['jx_status'] == '0'){echo '待审核';}else if($v['jx_status'] == '2'){echo '不通过';}else{echo '通过';}?></td>
									 <td>
									 <?php if($_SESSION['piano_user']['role'] == 1){?>
										<div class="visible-md visible-lg hidden-sm hidden-xs btn-group">
										
											<a href="#" class="btn btn-xs btn-success" onclick="shenhe(<?php echo $v['jxid']?>,1)" style="margin-top:5px;">通过</a>	
										<?php if($v['jx_status'] == '0'){?>
											<a href="#" class="btn btn-xs btn-success" onclick="shenhe(<?php echo $v['jxid']?>,2)" style="margin-top:5px;">不通过</a>
										<?php }?>
										</div>
									<?php }?>
									</td> 
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
<script language="javascript">
	<!--
	function linkok(url){
	  question = confirm("你确认要删除吗？");
	  if (question){
	   window.location.href = url;
	  }
	}
	//-->
	</script>
<script type="text/javascript">
	
$('.date-picker').datepicker({autoclose:true}).next().on(ace.click_event, function(){
	$(this).prev().focus();
});
</script>


<script>
function send1(){
	location.href = "index.php?m=Admin&c=Jinxiao&a=fenxiao_shenhe_list&status=1";
}
function send2(){
	location.href = "index.php?m=Admin&c=Jinxiao&a=fenxiao_shenhe_list&status=2";
}

function send4(){
	location.href = "index.php?m=Admin&c=Jinxiao&a=fenxiao_shenhe_list&status=3";
}

function shenhe(jxid,status){
	if(confirm("确定执行此操作吗?")){
		$.ajax({
			url:'index.php?m=Admin&c=Jinxiao&a=fenxiao_shenhe',
			data:'jxid='+jxid+'&status='+status,
			type:'post',
			success:function(msg){
				if(msg == 1){

					if(status == 1){
						alert('审核通过')
						location.href = "index.php?m=Admin&c=Jinxiao&a=fenxiao_list"
					}else{
						alert('审核拒绝')
						location.href = "index.php?m=Admin&c=Jinxiao&a=fenxiao_shenhe_list"
					}					
				}else{
					alert(msg)
					return false
				}
			}
		})
	}

}
</script>
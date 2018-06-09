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
			用户管理
			<small> <i class="icon-double-angle-right"></i>
				代理商列表
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
									<form class="form-horizontal" action="<?php echo U('Admin/Jinxiao/agent_list_sou');?>" method="POST" role="form" enctype="multipart/form-data">
									
									<input type='hidden' name='button' value='1'/>
									
									 <div class="btn-group" style='margin-top:5px;'>
										<span>代理商机构:</span>
										<input type="text" name="name" value="<?php if($name){echo $name;}?>">
									</div>
									
									<div class="btn-group" style='margin-top:5px;'>
										<span>账号:</span>
										<input type="text" name="username" value="<?php if($username){echo $username;}?>">
									</div>
								
								<!-- 	<div class="btn-group" style="margin-right:10px;margin-top:5px;">											
											<div class="input-group">
											<span>加入时间：</span>
												<input class="form-control date-picker" value="<?php if($stime){echo $stime;}?>" name="stime" id="id-date-picker-1" style="width: 35%" type="text" data-date-format="yyyy-mm-dd" />
												-
												<input class="form-control date-picker" value="<?php if($etime){echo $etime;}?>" name="etime" id="id-date-picker-1" style="width: 35%" type="text" data-date-format="yyyy-mm-dd" /> 
											</div>
									</div> -->
			<!-- 省市级联动 -->
			  <script type="text/javascript" src="/Public/Admin/admin/js/region_select.js"></script>
										<div class="btn-group" style='margin-right:12px;margin-top:5px;'>
											<span style='margin-left:12px;'>代理区域：</span>
																	
								            <select name="location_p" id="location_p" class="tongselect"></select>
								           <select name="location_c" id="location_c" class="tongselect" ></select>
								         <select name="location_a" id="location_a" class="tongselect" ></select> 
								                <script src="js/region_select.js"></script>
								                <script type="text/javascript">
								                    new PCAS('location_p', 'location_c', 'location_a', '<?php if($p){echo $p;}?>', '<?php if($c){echo $c;}?>', '<?php if($a){echo $a;}?>');
								                </script>
        
										</div>
	
										<div class="btn-group" style='margin-top:5px;'>
												<span class="input-group-btn">
													<button type="submit" style="padding:0" class="btn btn-purple btn-sm">
														搜索<i class="icon-search icon-on-right bigger-110"></i>
													</button>
												</span>
											
										</div>
								
									</form>
									
							<!-- 按钮样式 -->		
							<style type='text/css'>
								.anniu{width:100%; height:40px; position:relative;}
								 .anniu ul{width:202px; height:30px; border:1px solid #ccc; overflow:hidden; position:absolute; top:0; left:0; list-style:none; color:#333; box-sizing:border-box; font-size:13px; cursor: pointer;}	    
								 .anniu ul li.current{background:#87b87f; color:#fff;width:100px; height:30px; float:left; border-right:1px solid #ccc;  line-height:30px; text-align:center; box-sizing:border-box;}
								.anniu ul li{width:100px; height:30px; float:left; border-right:1px solid #ccc;  line-height:30px; text-align:center; box-sizing:border-box;}
							</style>
								<div class='anniu'>
								 
								   <a onClick="daochu()" target="rightFrame"><span style=' width:100px; height:34px; background:#87b87f; color:#fff; margin-right:10px; display:inline-block; line-height:34px;text-align:center; borde-radius:4px;position:absolute; top:0; right:130px;' id='daochu'>导出excel</span></a>
	
								   <a href="<?php echo U('Admin/Jinxiao/agent_add');?>" target="rightFrame"><span style=' width:100px; height:34px; background:#2679b5; color:#fff; margin-right:10px; display:inline-block; line-height:34px;text-align:center; borde-radius:4px;'>添加代理商</span></a>
									
								</div>
								</div>
							</div>
						</div>
			<div class="row">
				<div class="col-xs-12">
					<div class="table-responsive">
						<table id="sample-table-1" class="table table-striped table-bordered table-hover" style="margin-bottom: 0px;font-size:13px;">
							<thead>
								<tr style=' font-size: 13px;'>
								    <th><input type='checkbox' name='box'></th> 
									<th>ID</th>
									<th>代理商机构</th>
									<th>账号</th>
									<th>负责人</th>
									<th>联系电话</th>			
									<th>角色</th>								
									<th>代理区域</th>	
									<th>地址</th>
									<th>身份证号</th>
									<th>新增时间</th>	
							        <th>选择教程</th>
							        <th>封面</th>
									<th>操作</th>
								</tr>
							</thead>

							<tbody>
							<?php foreach($list as $k=>$v){?>
								<tr>
								    <td><input type='checkbox' name='ids' value="<?php echo $v['jxid'];?>"></td>
									<td><?php echo $v['jxid'];?></td>
									<td><?php echo $v['jx_name'];?></td>
									<td><?php echo $v['username']?></td>
								   <td><?php echo $v['fzr_name']?></td>
									<td><?php echo $v['mobile']?></td>
									<td><?php if($v['juese']==1){echo '超级管理员';}else{echo '普通管理员';}?></td>
									<td><?php echo $v['jx_pro'].$v['jx_city'].$v['jx_area']?></td>
									<td><?php echo $v['jx_address']?></td>
									<td><?php echo $v['card']?></td>
									<td><?php echo $v['jx_addtime']?></td>
									<td>
									 <div class="col-sm-9">
									 <input type='hidden' value="<?php echo $v['jxid'];?>"/>
										<select name="lianxi" style="width:135px;" class="xuan_songs">	
										      <option value="">请选择</option>	
										    <?php foreach($cat as $val){?>  					
											  <option value="<?php echo $val['cid']?>" <?php if($v['jx_catid']==$val['cid']){echo 'selected';}?>><?php echo $val['c_name']?></option>
											<?php }?>
										</select>
										  </div> 
									</td>
									<td><img src="<?php echo $v['jx_img']?>" style="width: 100px;height: 100px;" class="license"></td>
									<td>
										<div class="visible-md visible-lg hidden-sm hidden-xs btn-group">
											<a href="index.php?m=Admin&c=Jinxiao&a=agent_xiang&jxid=<?php echo $v['jxid']?>" class="btn btn-xs btn-success" style="margin-top:5px;">详情</a>	
										    <a href="index.php?m=Admin&c=Jinxiao&a=agent_edit&jxid=<?php echo $v['jxid']?>" class="btn btn-xs btn-success" style="margin-top:5px;">编辑</a>	
										    <a href="index.php?m=Admin&c=Jinxiao&a=show_pwd&jxid=<?php echo $v['jxid']?>" class="btn btn-xs btn-success" style="margin-top:5px;">重置密码</a>	
										
										</div>
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
<div class="public_img" style="width:100% ;height: 100%;position:fixed; left: 0;top:0;z-index:20;
background:rgba(0,0,0,0.5); display: none;"><img src="" style="width:300px;height: auto;position: absolute;left: 50%;top: 50%;margin-left: -150px;"></div>
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




<!-- ajax 提交表单 -->

<script type="text/javascript" language="javascript" src="/Public/Admin/admin/js/jquery.tan.js"></script>
<script type="text/javascript" language="javascript" src="/Public/Admin/admin/js/jquery.form.js"></script>
<script src="/Public/Admin/admin/js/jquery.js" type="text/javascript"></script>

<script>
$(".license").click(function() {
	  	var url = $(this).attr("src");
	  	$(".public_img img").attr("src", url);
	
	  
		$('html,body').css({'height':'auto','overflow':'hidden'})
	   	$('.public_img').css({'display':'block'})
	  

	   	var imgw=$('.public_img img').height()
	   	$('.public_img img').css({'margin-top': -imgw / 2 + 'px'})
	   		
	   	$(".public_img").click(function() {

		   	$(this).css({'display':'none'})
		   	$('html,body').css({'height':'auto','overflow':''})
	 	})  	
	 })  	
function showStart(){
    return true;
}
function showSuccess(data){
    	if(data == 1){
    		alert('导入成功')
    		location.href="<?php echo U('Daili/Index/student_list');?>"
    	}else{
    		alert(data)
    		return
    	}

}
$(function(){
	var options = {
		        beforeSubmit:showStart,
		        success:showSuccess,

		 };
	$('#daoru').click(function(){	
		//alert('a')
		//return false
		$('.daoru').ajaxSubmit(options);
	})
	
	//选择教材 
	$(".xuan_songs").change(function(){
	    var jxid = $(this).prev().val() 
	    var catid = $(this).val()
		$.ajax({
			url:'index.php?m=Admin&c=Jinxiao&a=xuan_songs',
			data:'jxid='+jxid+'&catid='+catid+'&type=1',
			type:'post',
			success:function(msg){
				
				return false
			}
		})
	})

		//点击全选
	 	//获取所有checkbox对象
        var box = document.getElementsByName("box");
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
	   }) 
	
	
})

function daochu(){
	var ids = '';
	$("input[name='ids']:checked").each(function(){
		ids += $(this).val()+','
	})

	location.href = "index.php?m=Admin&c=Jinxiao&a=jx_daochu&jxid="+ids


}

</script>
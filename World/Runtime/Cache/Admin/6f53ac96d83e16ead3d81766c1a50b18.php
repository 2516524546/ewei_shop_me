<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>快乐琴行后台管理系统</title>
		<meta name="keywords" content="快乐琴行后台管理系统" />
		<meta name="description" content="快乐琴行后台管理系统" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<!-- basic styles -->
		<link href="/Public/Admin/admin/css/bootstrap.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="/Public/Admin/admin/css/font-awesome.min.css" />

		
		<link rel="stylesheet" href="/Public/Admin/admin/css/jquery-ui-1.10.3.custom.min.css" />
		<link rel="stylesheet" href="/Public/Admin/admin/css/chosen.css" />
		<link rel="stylesheet" href="/Public/Admin/admin/css/datepicker.css" />
		<link rel="stylesheet" href="/Public/Admin/admin/css/bootstrap-timepicker.css" />
		<link rel="stylesheet" href="/Public/Admin/admin/css/daterangepicker.css" />
		<link rel="stylesheet" href="/Public/Admin/admin/css/colorpicker.css" />
		<link rel="stylesheet" href="/Public/Admin/admin/css/colorbox.css" />
	

		<link rel="stylesheet" href="/Public/Admin/admin/css/ace.min.css" />
		<link rel="stylesheet" href="/Public/Admin/admin/css/ace-rtl.min.css" />
		<link rel="stylesheet" href="/Public/Admin/admin/css/ace-skins.min.css" />

<!-- 
		<script src="/Public/Admin/admin/js/jquery-2.0.3.min.js"></script>

		<script src="/Public/Admin/admin/js/ace-extra.min.js"></script> -->

		<style type='text/css'>
		
		.main-container::after{background-color: #f5f5f5;}
		</style>
	</head>

	<body >
		

		<div class="main-container" id="main-container" style="margin-right:10px;" >
			<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>

			<div class="main-container-inner">
					<ul class="nav nav-list">
					 <?php foreach($menus as $val){?>
						<li class="active" >
							<a href="###" class="dropdown-toggle">
								<i class="icon-shopping-cart"></i>
								<span class="menu-text"><?php echo $val['m_name'];?> </span>
								<b class="arrow icon-angle-up"></b>
							</a>
							<ul class="submenu">
							 <?php foreach($val['child'] as $v){?>	
								<li>
									<a href="<?php echo $v['m_url']?>" target="rightFrame">
										<i class="icon-double-angle-right"></i>
										<?php echo $v['m_name']?>
									</a>
								</li>
							<?php }?>							
							</ul>
						</li>
					<?php }?>	
				</ul>
		</div>
	

	

</body>
</html>
<script src="/Public/Admin/admin/js/jquery.js" type="text/javascript"></script>
<script>
$(function(){
	 $('.submenu').css('display','none')	
	 $('.dropdown-toggle').click(function(){		
			if($(this).parent().attr('class')=='active aaa'){
				  $(this).siblings('ul').css('display','block')
				  $(this).parent().attr('class','active')	
				  $(this).find('b').attr('class','arrow icon-angle-down');
				 		
			}else if($(this).parent().attr('class')=='active'){
				 $(this).siblings('ul').css('display','none');
				 $(this).parent().attr('class','active aaa')
				 $(this).find('b').attr('class','arrow icon-angle-up')
			}	     
		
	})
	
})

	$('.active').each(function(){
		if($(this).children('ul').length == 0){
			$(this).css('display','block');
		}
	})

	$('#index_list').css('display','block');



</script>
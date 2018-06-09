<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>快乐琴行后台管理系统</title>
		<meta name="keywords" content="快乐琴行后台管理系统" />
		<meta name="description" content="快乐琴行后台管理系统" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<!-- basic styles -->
		<link href="/Public/Admin/admin/css/bootstrap.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="/Public/Admin/admin/css/font-awesome.min.css" />

		<!--[if IE 7]>
		  <link rel="stylesheet" href="/Public/Admin/admin/css/font-awesome-ie7.min.css" />
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

	</head>
<body>
<div class="navbar navbar-default" id="navbar">
			<script type="text/javascript">
				try{ace.settings.check('navbar' , 'fixed')}catch(e){}
			</script>

			<div class="navbar-container" id="navbar-container">
				<div class="navbar-header pull-left" >
					<a href="#" class="navbar-brand">
						<small>
							<i class="icon-leaf"></i>
							快乐琴行后台管理系统
						</small>
					</a><!-- /.brand -->
				</div><!-- /.navbar-header -->

				<div class="navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav" >
						<li class="light-blue" >
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<img class="nav-user-photo" src="/Public/Admin/admin/avatars/user.jpg" alt="Jason's Photo" />
								<span class="user-info">
									<small>欢迎光临,</small>
									<?php echo $_SESSION['piano_user']['username']?>
								</span>

								<!-- <i class="icon-caret-down"></i> -->
							</a>

							
						</li>
					
						<li class="light-blue">
						   <a id='log_out' href="<?php echo U('Admin/Index/log_out');?>" class="dropdown-toggle" target="Frame">退出</a>
						</li>
					</ul><!-- /.ace-nav -->
				</div><!-- /.navbar-header -->
				、
			</div><!-- /.container -->
		</div>
</body>
</html>
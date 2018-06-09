<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"'>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="renderer" content="webkit" /><!-- 兼容360使用ip访问 -->
<title>快乐琴行后台管理系统</title>

</head>
<frameset rows="40,*" cols="*" frameborder="no" border="0" framespacing="0" name='Frame'>
  <frame src="<?php echo U('Index/top');?>" name="topFrame" noresize="noresize" scrolling="NO" id="topFrame" title="topFrame" />
  <frameset cols="186,*" frameborder="no" border="1" framespacing="0">
  <frame src="<?php echo U('Index/left');?>" name="leftFrame" scrolling="YES"  id="leftFrame" title="leftFrame" />
    <frame src="<?php echo U('Index/shouye');?>" name="rightFrame" id="rightFrame" title="rightFrame" />
   
  </frameset>
  
</frameset>
<noframes><body>
</body></noframes>
</html>
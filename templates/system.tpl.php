<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Main</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css"/>
<script type="text/javascript" src="../js/admin_level.js"></script>
</head>
<body id="main">
<div class="map">
	管理首页&gt;&gt;系统配置&gt;&gt;<strong id="title">系统配置文件</strong>
</div>

<form method="post">
<table cellspacing="0" >
	<tr><th style="text-align:center"><strong>系统配置信息</strong></th></tr>
	<tr><td >网站名称:　　 <input type="text" name="webname" value="{$twebname}" class="text"></td></tr>
	<tr><td >常规分页:　　 <input type="text" name="page_size" value="{$page_size}" class="text"></td></tr>
	<tr><td >文档分页:　　 <input type="text" name="article_size" value="{$article_size}" class="text"></td></tr>
	<tr><td >导航个数:　　 <input type="text" name="nav_size" value="{$nav_size}" class="text"></td></tr>
	<tr><td >轮播个数:　　 <input type="text" name="ro_num" value="{$ro_num}" class="text"></td></tr>
	<tr><td >图片上传目录: <input type="text" name="updir" value="{$updir}" class="text"></td></tr>
	<tr><td >文字广告个数: <input type="text" name="adver_text_num" value="{$adver_text_num}" class="text"></td></tr>
	<tr><td >图片广告个数: <input type="text" name="adver_pic_num" value="{$adver_pic_num}" class="text"></td></tr>
	<tr><td><p ><input type="submit" name="send" value="修改配置文件 "></p></td></tr>
</table>
</form>
</body>
</html>

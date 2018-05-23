<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>TOP</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css"/>
<script type="text/javascript" src="../js/admin_top_nav.js"></script>
</head>
<body id="top">
<h1>LOGO</h1>
<ul>
	<li><a href="../templates/sidebar.html" target="sidebar" id="nav1" class="selected" onclick="admin_top_nav(1)">首页</a></li>
	<li><a href="../templates/sidebarn.html" target="sidebar" id="nav2" onclick="admin_top_nav(2)">内容</a></li>
	<li><a href="../templates/sidebaru.html" target="sidebar" id="nav3" onclick="admin_top_nav(3)">会员</a></li>
	<li><a href="../templates/sidebars.html" target="sidebar" id="nav4" onclick="admin_top_nav(4)">系统</a></li>
</ul>
<p>你好,<strong><?php echo $this->_vars['admin_user']?></strong>
[<?php echo $this->_vars['level_name']?>] [<a href="../" target="_blank">去首页</a>] [<a href="admin_login.php?action=logout" target="_parent">退出</a>]</p>
</body>
</html>

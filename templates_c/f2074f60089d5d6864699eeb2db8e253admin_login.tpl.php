<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>登陆CMS后台管理系统</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css"/>
<script type="text/javascript" src="../js/admin_login.js"></script>
</head>
<body>
<form id="adminLogin" method="post" name="login" action="?action=login">
	<fieldset>
		<legend>登陆CMS后台管理系统</legend> 
		<label>账　号:<input type="text" name="admin_user" class="text"></label>
		<label>密　码:<input type="password" name="admin_pass" class="text"></label>
		<label>验证码:<input type="text" name="code" class="text"></label>
		<label class="t">请输入下图字符，不区分大小写</label>
		<label><img src="../config/code.php" onclick="javascript:this.src='../config/code.php?tm='+Math.random();"></label>
		<input type="submit" value="登陆" class="submit" name="send" onclick="return checkLogin();"/>
	</fieldset>
</form>

</body>
</html>


<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="style/basic.css"/>
<link rel="stylesheet" type="text/css" href="style/reg.css"/>
<script type="text/javascript" src="js/reg.js"></script>
</head>
<body>
{include file="header.tpl"}
{if $reg}
<div id="reg">
	<h2>会员注册</h2>
	<form method="post" name="reg" action="?action=reg"> 
		<dl>
			<dd>用户名　　<input type="text" class="text" name="user"><span class="red">*</span>(用户名2~20个字符　<span class="red">*</span>为必填 )</dd>
			<dd>密　码　　<input type="password" class="text" name="pass"><span class="red">*</span>(密码6~20个字符)</dd>
			<dd>密码确认　<input type="password" class="text" name="repass"><span class="red">*</span>(请输入与密码相同字符)</dd>
			<dd>电子邮件　<input type="text" class="text" name="email"><span class="red">*</span>(每个电子邮件只能注册一个ID)</dd>
			<dd>选择头像　<select name="face" onchange="sface();">
                            {foreach $OptionFace(key,value)}
                            <option value="{@value}.png">
                            {@value}.png</option>
                            {/foreach} 
                            </select>
			</dd>
			<dd><img src="images/face/1.png" name="faceimg" alt="1.png" class="face" ></dd>
			<dd>安全问题　<select name="question">
							<option value="">没有安全问题</option>
							<option>您父亲的姓名?</option>
							<option>您母亲的职业?</option>
							<option>您的故乡在哪?</option>
					  </select>
			</dd>
			<dd>问题答案　<input type="text" class="text" name="answer"></dd>
			<dd>验证码　　<input type="text" class="text" name="code"><span class="red">*</span></dd>
			<dd><img src="config/code.php" onclick="javascript:this.src='config/code.php?tm='+Math.random();" class="code"></dd>
			<dd><input type="submit"  name="send" value="注册会员" class="submit" onclick="return checkReg();"></dd>
		</dl>
	</form>
	
</div>
{/if}
{if $login}
<div id="reg">
	<h2>会员登陆</h2>
	<form method="post" name="login" action="?action=login"> 
		<dl>
			<dd>用户名　<input type="text" class="text" name="user"></dd>
			<dd>密　码　<input type="password" class="text" name="pass"></dd>
			<dd>验证码　<input type="text" class="text" name="code"></dd>
			<dd><img src="config/code.php" onclick="javascript:this.src='config/code.php?tm='+Math.random();" class="code"></dd>
			<dd>登陆保留:<input type="radio" name="time" checked="checked" value="0">不保留
					  <input type="radio" name="time"  value="86400">一天
					  <input type="radio" name="time"  value="604800">一周
					  <input type="radio" name="time"  value="2592000">一月
			</dd>
			<dd><input type="submit"  name="send" value="会员登陆" class="submit" onclick="return checkLogin();"></dd>
		</dl>
	</form>
</div>
{/if}
{include file='footer.tpl'} 
</body>
</html>
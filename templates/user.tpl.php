<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Main</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css"/>
<script type="text/javascript" src="../js/admin_user.js"></script>
</head>
<body id="main">
<div class="map">
	管理首页&gt;&gt;会员管理&gt;&gt;<strong id="title">{$title}</strong>
</div>
<ol>
	<li><a href="user.php?action=show" class="selected">会员列表</a></li>
	<li><a href="user.php?action=add">新增会员</a></li>
	{if $update}
	<li><a href="user.php?action=update&id={$id}">更新会员信息</a></li>
	{/if}

</ol>
{if $show}
<table cellspacing="0">
	<tr><th>会员编号</th><th>会员名称</th><th>会员邮箱</th><th>状态</th><th>操作</th></tr>
	{if $AllUser}
	{foreach $AllUser(key,value)}
	<tr>
	<td><script type="text/javascript">document.write({@key+1}
	+
	{$num});</script> </td>
	<td>{@value->user}</td>
	<td>{@value->email}</td>
	<td>{@value->state}</td>
	<td><a href="user.php?action=update&id={@value->id}">修改</a>|
	<a href="user.php?action=delete&id={@value->id}" onclick="return confirm('吾日三省吾身,你真的要删除么?')?true:false">删除</a></td>
	</tr>
	{/foreach}
	{else}
	<tr><td colspan="5">没有任何数据,请添加数据</td></tr>
	{/if}
</table>
<div id=page>{$page}</div>
{/if}

{if $add}
<form method="post" name="reg" action="?action=add">
	<table cellspacing="0" class="user">
			<tr><td>用户名　　<input type="text" class="text" name="user"><span class="red">*</span>(用户名2~20个字符　<span class="red">*</span>为必填 )</td></tr>
			<tr><td>密　码　　<input type="password" class="text" name="pass"><span class="red">*</span>(密码6~20个字符)</td></tr>
			<tr><td>密码确认　<input type="password" class="text" name="repass"><span class="red">*</span>(请输入与密码相同字符)</td></tr>
			<tr><td>电子邮件　<input type="text" class="text" name="email"><span class="red">*</span>(每个电子邮件只能注册一个ID)</td></tr>
			<tr><td>选择头像　<select name="face" onchange="sface();">
                            {foreach $OptionFace(key,value)}
                            <option value="{@value}.png">
                            {@value}.png</option>
                            {/foreach} 
                            </select>
			</td></tr>
			<tr><td><img src="../images/face/1.png" name="faceimg" alt="1.png" class="face" ></td></tr>
			<tr><td>安全问题　<select name="question">
							<option value="">没有安全问题</option>
							<option>您父亲的姓名?</option>
							<option>您母亲的职业?</option>
							<option>您的故乡在哪?</option>
					  </select>
			</td></tr>
			<tr><td>问题答案　<input type="text" class="text" name="answer"></td></tr>
			<tr><td>设置等级　<input type="radio" name="state" value="0">禁止登陆
                		    <input type="radio" name="state" value="1">待审核会员
                			<input type="radio" name="state" value="2" checked="checked">初级会员
                			<input type="radio" name="state" value="3">中级会员
                			<input type="radio" name="state" value="4">高级会员
                			<input type="radio" name="state" value="5">VIP会员
			</td></tr>
			<tr><td><input type="submit"  name="send" value="注册会员" class="submit" onclick="return checkReg();"></td></tr>
	</table>
</form>
{/if}
{if $update}
<form method="post" name="reg">
	<input type="hidden" name="id" value="{$id}"> 
	<input type="hidden" name="ppass" value="{$pass}"> 
	<input type="hidden"  value="{$prev_url}" name="prev_url" > 
	<input type="hidden"  value="{$email}" name="eemail"> 
	<table cellspacing="0" class="user">
			<tr><td>用户名　　{$user}</td></tr>
			<tr><td>密　码　　<input type="password" class="text" name="pass"><span class="red">*</span>(密码6~20个字符 留空不修改)</td></tr>
			<tr><td>电子邮件　<input type="text" class="text" value={$email} name="email"><span class="red">*</span>(每个电子邮件只能注册一个ID)</td></tr>
			<tr><td>选择头像　<select name="face" onchange="sface();">
                            {$face}
                            </select>
			</td></tr>
			<tr><td><img src="../images/face/{$facesrc}" name="faceimg" 
			alt="{$facesrc}" class="face" ></td></tr>
			<tr><td>安全问题　<select name="question">
							<option value="">没有安全问题</option>
							{$question}
					  </select>
			</td></tr>
			<tr><td>问题答案　<input type="text" class="text" value="{$answer}" name="answer"></td></tr>
			<tr><td>设置等级　{$state}
			</td></tr>
			<tr><td><input type="submit"  name="send" value="修改" class="submit" onclick="return checkUpdate();"></td></tr>
	</table>
</form>
{/if}
</body>
</html>

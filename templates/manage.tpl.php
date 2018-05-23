<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Main</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css"/>
<script type="text/javascript" src="../js/admin_manage.js"></script>
</head>
<body id="main">
<div class="map">
	管理首页&gt;&gt;管理员管理&gt;&gt;<strong id="title">{$title}</strong>
</div>
<ol>
	<li><a href="manage.php?action=show" class="selected">管理员列表</a></li>
	<li><a href="manage.php?action=add">新增管理员</a></li>
	{if $update}
	<li><a href="manage.php?action=update&id={$id}">更新管理员信息</a></li>
	{/if}

</ol>
{if $show}
<table cellspacing="0">
	<tr><th>编号</th><th>用户名</th><th>等级</th><th>登陆次数</th><th>最近登陆IP</th><th>最近登陆时间</th><th>操作</th></tr>
	{if $AllManage}
	{foreach $AllManage(key,value)}
	<tr>
	<td><script type="text/javascript">document.write({@key+1}
	+
	{$num});</script> </td>
	<td>{@value->admin_user}</td>
	<td>{@value->level_name}</td> 
	<td>{@value->login_count}</td>
	<td>{@value->last_ip}</td>
	<td>{@value->last_time}</td> 
	<td><a href=" manage.php?action=update&id={@value->mid}">修改</a>|
	<a href=" manage.php?action=delete&id={@value->mid}" onclick="return confirm('吾日三省吾身,你真的要删除么?')?true:false">删除</a></td>
	</tr>
	{/foreach}
	{else}
	<tr><td colspan="7">没有任何数据,请添加数据</td></tr>
	{/if}
</table>
<div id="page">{$page}</div>

{/if}

{if $add}
<form method="post" name="add">
	<table cellspacing="0" class="left">
		<tr><td>用户名　:<input type="text" name="admin_user" class="text"> (*2~20)</td></tr>
		<tr><td>密码　　:<input type="password" name="admin_pass" class="text"> (*6~20)</td></tr>
		<tr><td>密码确认:<input type="password" name="readmin_pass" class="text"> (*6~20)</td></tr>
		<tr><td>等级　　:<select name="level">
						{foreach $AllLevel(key,value)}
						<option value="{@value->id}">
						{@value->level_name}
						</option>
						{/foreach}
					 </select>
		</td></tr>
		<tr><td><input type="submit" name="send" onclick="return checkAddForm();" value="新增管理员" class="submit">[<a href="{$prev_url}">返回列表</a>]</td></tr>
	</table>
</form>
{/if}
{if $update}
<form method="post" name="update">
	<input type="hidden" name="id" value="{$id}" class="text"> 
	<input type="hidden"  value="{$level}" id="level" class="text"> 
	<input type="hidden"  value="{$prev_url}" name="prev_url" class="text"> 
	<table cellspacing="0" class="left">
		<tr><td>用户名:<input type="text" name="admin_user" value="{$admin_user}" class="text" readonly="readonly"> (*2~20)</td></tr>
		<tr><td>密　码:<input type="password" value="" name="admin_pass" class="text"> (*6~20不输入默认不修改)</td></tr>
		<tr><td>等　级:<select name="level">
						{foreach $AllLevel(key,value)}
						<option value="{@value->id}">
						{@value->level_name}
						</option>
						{/foreach}
					 </select>
		</td></tr>
		<tr><td><input type="submit" name="send" value="修改信息" onclick="return checkUpadateForm();" class="submit">[<a href="{$prev_url}">返回列表</a>]</td></tr>
	</table>
</form>
{/if}
</body>
</html>

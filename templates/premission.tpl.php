<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Main</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css"/>
<script type="text/javascript" src="../js/admin_premission.js"></script>
</head>
<body id="main">
<div class="map">
	管理首页&gt;&gt;权限管理&gt;&gt;<strong id="title">{$title}</strong>
</div>
<ol>
	<li><a href="premission.php?action=show" class="selected">权限列表</a></li>
	<li><a href="premission.php?action=add">新增权限</a></li>
	{if $update}
	<li><a href="premission.php?action=update&id={$id}">更新权限信息</a></li>
	{/if}

</ol>
{if $show}
<table cellspacing="0">
	<tr><th>权限编号</th><th>权限名称</th><th>标识</th><th>操作</th></tr>
	{if $AllPremission}
	{foreach $AllPremission(key,value)}
	<tr>
	<td><script type="text/javascript">document.write({@key+1}
	+
	{$num});</script> </td>
	<td>{@value->name}</td>
	<td>{@value->id}</td>
	<td><a href="premission.php?action=update&id={@value->id}">修改</a>|
	<a href="premission.php?action=delete&id={@value->id}" onclick="return confirm('吾日三省吾身,你真的要删除么?')?true:false">删除</a></td>
	</tr>
	{/foreach}
	{else}
	<tr><td colspan="4">没有任何数据,请添加数据</td></tr>
	{/if}
</table>
<div id=page>{$page}</div>
{/if}

{if $add}
<form method="post" name="add">
	<table cellspacing="0" class="left">
		<tr><td>权限名称:<input type="text" name="name" class="text"> (*2~100)</td></tr>
		<tr><td>权限信息:<textarea name="info"></textarea> (*&lt;200)</td></tr>
		<tr><td><input type="submit" name="send" value="新增权限" onclick="return checkAddForm();" class="submit">[<a href="{$prev_url}">返回列表</a>]</td></tr>
	</table>
</form>
{/if}
{if $update}
<form method="post" name="update">
	<input type="hidden" name="id" value="{$id}" class="text"> 
	<input type="hidden"  value="{$prev_url}" name="prev_url" class="text"> 
	<table cellspacing="0" class="left">
		<tr><td>权限名称:<input type="text" name="name" value="{$name}" class="text" > (*2~20)</td></tr>
		<tr><td>权限信息:<textarea name="info">{$info}</textarea> (*&lt;200)</td></tr>
		<tr><td><input type="submit" name="send" value="修改信息" onclick="return checkUpadateForm();" class="submit" >[<a href="{$prev_url}">返回列表</a>]</td></tr>
	</table>
</form>
{/if}
</body>
</html>

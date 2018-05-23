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
	管理首页&gt;&gt;等级管理&gt;&gt;<strong id="title">{$title}</strong>
</div>
<ol>
	<li><a href="Level.php?action=show" class="selected">等级列表</a></li>
	<li><a href="Level.php?action=add">新增等级</a></li>
	{if $update}
	<li><a href="Level.php?action=update&id={$id}">更新等级信息</a></li>
	{/if}

</ol>
{if $show}
<table cellspacing="0">
	<tr><th>等级编号</th><th>等级名称</th><th>等级信息</th><th>权限标识</th><th>操作</th></tr>
	{if $AllLevel}
	{foreach $AllLevel(key,value)}
	<tr>
	<td><script type="text/javascript">document.write({@key+1}
	+
	{$num});</script> </td>
	<td>{@value->level_name}</td>
	<td>{@value->level_info}</td>
	<td>{@value->premission}</td>
	<td><a href=" Level.php?action=update&id={@value->id}">修改</a>|
	<a href=" Level.php?action=delete&id={@value->id}" onclick="return confirm('吾日三省吾身,你真的要删除么?')?true:false">删除</a></td>
	</tr>
	{/foreach}
	{else}
	<tr><td colspan="5">没有任何数据,请添加数据</td></tr>
	{/if}
</table>
<div id=page>{$page}</div>
{/if}

{if $add}
<form method="post" name="add">
	<table cellspacing="0" class="left">
		<tr><td>等级名称:<input type="text" name="level_name" class="text"> (*2~20)</td></tr>
		<tr><td>等级信息:<textarea name="level_info"></textarea> (*&lt;200)</td></tr>
		<tr><td style="padding-left:60px;padding-right:31%">
		{if $AllPremission}
		{foreach $AllPremission(key,value)}
			<input type="checkbox" name="premission[]"  value="{@value->id}" style="display: inline-block;">
			{@value->name}
		{/foreach}
		{/if}
		</td></tr>
		<tr><td><input type="submit" name="send" value="新增等级" onclick="return checkAddForm();" class="submit">[<a href="{$prev_url}">返回列表</a>]</td></tr>
	</table>
</form>
{/if}
{if $update}
<form method="post" name="update">
	<input type="hidden" name="id" value="{$id}" class="text"> 
	<input type="hidden"  value="{$prev_url}" name="prev_url" class="text"> 
	<table cellspacing="0" class="left">
		<tr><td>等级名称:<input type="text" name="level_name" value="{$level_name}" class="text" > (*2~20)</td></tr>
		<tr><td>等级信息:<textarea name="level_info">{$level_info}</textarea> (*&lt;200)</td></tr>
		<tr><td style="padding-left:60px;padding-right:31%">
		{$AllPremission}
		</td></tr>
		<tr><td><input type="submit" name="send" value="修改信息" onclick="return checkUpadateForm();" class="submit" >[<a href="{$prev_url}">返回列表</a>]</td></tr>
	</table>
</form>
{/if}
</body>
</html>

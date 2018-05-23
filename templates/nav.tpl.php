<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Main</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css"/>
<script type="text/javascript" src="../js/admin_nav.js"></script>
</head>
<body id="main">
<div class="map">
	内容管理&gt;&gt;设置网站导航&gt;&gt;<strong id="title">{$title}</strong>
</div>
<ol>
	<li><a href="nav.php?action=show" class="selected">导航列表</a></li>
	<li><a href="nav.php?action=add">新增导航</a></li>
	{if $update}
	<li><a href="nav.php?action=update&id={$id}">更新导航信息</a></li>
	{/if}
	{if $addchild}
	<li><a href="nav.php?action=addchild&id={$id}">新增子导航</a></li>
	{/if}
	{if $showchild}
	<li><a href="nav.php?action=showchild&id={$id}">子导航列表</a></li> 
	{/if}
</ol>
{if $show}
<form method="post" action="nav.php?action=sort">
<table cellspacing="0">
	<tr><th>编号</th><th>导航名称</th><th>描述</th><th>子导航</th><th>操作</th><th>导航优先级</th></tr>
	{if $AllNav}
	{foreach $AllNav(key,value)}
	<tr>
	<td><script type="text/javascript">document.write({@key+1}
	+
	{$num});</script> </td>
	<td>{@value->nav_name}</td>
	<td>{@value->nav_info}</td>
	<td><a href="nav.php?action=showchild&id={@value->id}">查看</a>|
	<a href="nav.php?action=addchild&id={@value->id}">增加子导航</a></td>
	<td><a href=" nav.php?action=update&id={@value->id}">修改</a>|
	<a href=" nav.php?action=delete&id={@value->id}" onclick="return confirm('吾日三省吾身,你真的要删除么?')?true:false">删除</a></td>
	<td><input type="text" name="sort[{@value->id}]" 
	value="{@value->sort}" class="text sort"></td>
	</tr>
	{/foreach}
	<tr><td></td><td></td><td></td><td></td><td></td><td><input type="submit" name="send" value="更新优先级" style="cursor:pointer;"></td></tr>
	{else}
	<tr><td colspan="6">没有任何数据,请添加数据</td></tr>
	{/if}
	
</table>
</form>
<div id=page>{$page}</div>
{/if}
{if $add}
<form method="post" name="add">
	<table cellspacing="0" class="left">
		<tr><td>导航名称:<input type="text" name="nav_name" class="text"> (*2~20)</td></tr>
		<tr><td>导航信息:<textarea name="nav_info"></textarea> (*&lt;200)</td></tr>
		<tr><td><input type="submit" name="send" value="新增导航" onclick="return checkAddForm();" class="submit">[<a href="{$prev_url}">返回列表</a>]</td></tr>
	</table>
</form>
{/if}

{if $addchild}
<form method="post" name="add">
<input type="hidden" name="pid" value="{$pid}">
	<table cellspacing="0" class="left">
		<tr><td>上级导航:<strong>{$prev_name}</strong></td></tr>
		<tr><td>导航名称:<input type="text" name="nav_name" class="text"> (*2~20)</td></tr>
		<tr><td>导航信息:<textarea name="nav_info"></textarea> (*&lt;200)</td></tr>
		<tr><td><input type="submit" name="send" value="新增子导航" onclick="return checkAddForm();" class="submit">[<a href="{$prev_url}">返回列表</a>]</td></tr>
	</table>
</form>
{/if}

{if $update}
<form method="post" name="update">
	<input type="hidden" name="id" value="{$id}" class="text"> 
	<input type="hidden"  value="{$prev_url}" name="prev_url" class="text"> 
	<table cellspacing="0" class="left">
		<tr><td>导航名称:<input type="text" name="nav_name" value="{$nav_name}" class="text" > (*2~20)</td></tr>
		<tr><td>导航信息:<textarea name="nav_info">{$nav_info}</textarea> (*&lt;200)</td></tr>
		<tr><td><input type="submit" name="send" value="修改信息" onclick="return checkUpadateForm();" class="submit" >[<a href="{$prev_url}">返回列表</a>]</td></tr>
	</table>
</form>
{/if}
{if $showchild}
<form method="post" action="nav.php?action=sort">
<table cellspacing="0">
	<tr><th>编号</th><th>导航名称</th><th>描述</th><th>操作</th><th>导航优先级</th></tr>
	{if $AllChildNav}
	{foreach $AllChildNav(key,value)}
	<tr>
	<td><script type="text/javascript">document.write({@key+1}
	+
	{$num});</script> </td>
	<td>{@value->nav_name}</td>
	<td>{@value->nav_info}</td>
	<td><a href=" nav.php?action=update&id={@value->id}">修改</a>|
	<a href=" nav.php?action=delete&id={@value->id}" onclick="return confirm('吾日三省吾身,你真的要删除么?')?true:false">删除</a></td>
	
	<td><input type="text" name="sort[{@value->id}]" 
	value="{@value->sort}" class="text sort"></td></tr>
	{/foreach}
	<tr><td></td><td></td><td></td><td></td><td><input type="submit" name="send" value="更新优先级" style="cursor:pointer;"></td></tr>
	{else}
	<tr><td colspan="5">没有任何数据,请添加数据</td></tr>
	{/if}
	<tr><td colspan="5">上级导航:<strong>{$prev_name}</strong>[<a href="nav.php?action=addchild&id={$id}">添加子类</a>]
	[<a href="nav.php?action=show">上级列表</a>]</td></tr>
</table>
</form>
<div id=page>{$page}</div>
{/if}
</body>
</html>
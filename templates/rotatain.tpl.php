<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Main</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css"/>
<script type="text/javascript" src="../js/admin_rotatain.js"></script>
</head>
<body id="main">
<div class="map">
	管理首页&gt;&gt;内容管理&gt;&gt;<strong id="title">{$title}</strong>
</div>
<ol>
	<li><a href="rotatain.php?action=show" class="selected">轮播器列表</a></li>
	<li><a href="rotatain.php?action=add">新增轮播器</a></li>
	{if $update}
	<li><a href="rotatain.php?action=update&id={$id}">更新轮播器信息</a></li>
	{/if}

</ol>
{if $show}
<table cellspacing="0">
	<tr><th>编号</th><th>标题</th><th>链接</th><th>是否轮播</th><th>操作</th></tr>
	{if $AllRotatain}
	{foreach $AllRotatain(key,value)}
	<tr>
	<td><script type="text/javascript">document.write({@key+1}
	+
	{$num});</script> </td>
	<td>{@value->title}</td>
	<td><a href="{@value->linkall}">
	{@value->link}</a></td> 
	<td>{@value->state}
	{iff @value->ok}
	(<a href="rotatain.php?action=state&type=notok&id={@value->id}">取消</a>)
	{else}
	(<a href="rotatain.php?action=state&type=ok&id={@value->id}">设置</a>)
	{/iff}
	</td> 
	<td>
	<a href=" rotatain.php?action=update&id={@value->id}">修改</a>|
	<a href=" rotatain.php?action=delete&id={@value->id}" onclick="return confirm('吾日三省吾身,你真的要删除么?')?true:false">删除</a></td>
	</tr>
	{/foreach}
	{else}
	<tr><td colspan="7">没有任何数据,请添加数据</td></tr>
	{/if}
</table>
<div id="page">{$page}</div>

{/if}

{if $add}
<form method="post" name="content" action="?action=add">
	<table cellspacing="0" class="left">
		<tr><td>轮播图上传:<input type="text" name="thumbnail" class="text" readonly="readonly">
					   <input type="button" value="上传缩略图" onclick="centerWindow('../config/upfile.php?type=rotatain','upfile','500','100');">
					   <img name="pic" style="display:none;">(请选择200KB以下的jpg,png,gif图片 268X193比例最佳)
		</td></tr>
		<tr><td>轮播器标题:<input type="text" name="title" class="text"> (*&lt;20)</td></tr>
		<tr><td>轮播器链接:<input type="text" name="link" class="text"> (*)</td></tr>
		<tr><td>轮播器信息:<textarea name="info"></textarea> (*&lt;200)</td></tr>
		<tr><td><input type="submit" name="send" value="新增轮播器" onclick="return checkAddRotatain();" class="submit">[<a href="{$prev_url}">返回列表</a>]</td></tr>
	</table>
</form>
{/if}
{if $update}
<form method="post" name="content" action="?action=update">
<input type="hidden" value="{$id}" name="id">
	<table cellspacing="0" class="left">
		<tr><td>轮播图上传:<input type="text" name="thumbnail" value="{$thumbnail}" class="text" readonly="readonly">
					   <input type="button" value="上传缩略图" onclick="centerWindow('../config/upfile.php?type=rotatain','upfile','500','100');">
					   <img name="pic" src="{$thumbnail}" style="display:block;">(请选择200KB以下的jpg,png,gif图片 268X193比例最佳)
		</td></tr>
		<tr><td>轮播器标题:<input type="text" name="title" value="{$titlec}" class="text"> (*&lt;20)</td></tr>
		<tr><td>轮播器链接:<input type="text" name="link" value="{$link}" class="text"> (*)</td></tr>
		<tr><td>轮播器信息:<textarea name="info">{$info}</textarea> (*&lt;200)</td></tr>
		<tr><td><input type="submit" name="send" value="更新信息" onclick="return checkAddRotatain();" class="submit">[<a href="{$prev_url}">返回列表</a>]</td></tr>
	</table>
</form>
{/if}
</body>
</html>

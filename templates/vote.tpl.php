<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Main</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css"/>
<script type="text/javascript" src="../js/admin_vote.js"></script>
</head>
<body id="main">
<div class="map">
	管理首页&gt;&gt;调查投票管理&gt;&gt;<strong id="title">{$title}</strong>
</div>
<ol>
	<li><a href="vote.php?action=show" class="selected">投票主题列表</a></li>
	<li><a href="vote.php?action=add">新增投票主题</a></li>
	{if $update}
	<li><a href="vote.php?action=update&id={$id}">修改投票主题</a></li>
	{/if}
	{if $addchild}
	<li><a href="vote.php?action=addchild&id={$id}">新增投票项目</a></li>
	{/if}
	{if $showchild}
	<li><a href="vote.php?action=showchild&id={$id}">投票项目列表</a></li>
	{/if}
</ol>
{if $show}
<table cellspacing="0">
	<tr><th>投票编号</th><th>投票主题</th><th>投票项目</th><th>是否显示</th><th>参与人数</th><th>操作</th></tr>
	{if $AllVote}
	{foreach $AllVote(key,value)}
	<tr>
	<td><script type="text/javascript">document.write({@key+1}
	+
	{$num});</script> </td>
	<td>{@value->title}</td>
	<td><a href="vote.php?action=showchild&id={@value->id}">查看</a> | 
	<a href="vote.php?action=addchild&id={@value->id}">增加项目</a></td>
	<td>{iff @value->state}
	<span class="green">是</span>
	{else}
	<span class="red">否</span>(<a href="vote.php?action=state&id={@value->id}">显示</a>)
	{/iff}
	</td>
	<td>{@value->pcount}</td>
	<td><a href=" vote.php?action=update&id={@value->id}">修改</a>|
	<a href=" vote.php?action=delete&id={@value->id}" onclick="return confirm('吾日三省吾身,你真的要删除么?')?true:false">删除</a></td>
	</tr>
	{/foreach}
	{else}
	<tr><td colspan="5">没有任何数据,请添加数据</td></tr>
	{/if}
</table>
<div id=page>{$page}</div>
{/if}
{if $showchild}
<table cellspacing="0">
	<tr><th>项目编号</th><th>项目名称</th><th>得票数</th><th>操作</th></tr>
	{if $AllChildeVote}
	{foreach $AllChildeVote(key,value)}
	<tr>
	<td><script type="text/javascript">document.write({@key+1}
	+
	{$num});</script> </td>
	<td>{@value->title}</td>
	<td>{@value->count}</td>
	<td><a href=" vote.php?action=update&id={@value->id}">修改</a>|
	<a href=" vote.php?action=delete&id={@value->id}" onclick="return confirm('吾日三省吾身,你真的要删除么?')?true:false">删除</a></td>
	</tr>
	{/foreach}
	{else}
	<tr><td colspan="4">没有任何数据,请添加数据</td></tr>
	{/if}
	<tr><td colspan="4">所属主题:<span class="green">{$titlec}</span>
	<a href="vote.php?action=addchild&id={$id}">[增加项目]</a>
	<a href="vote.php?action=show">[返回主题列表]</a>
	</td></tr>
</table>
<div id=page>{$page}</div>
{/if}
{if $add}
<form method="post" name="add">
	<table cellspacing="0" class="left">
		<tr><td>投票主题:<input type="text" name="title" class="text"> (*2~20)</td></tr>
		<tr><td>主题信息:<textarea name="info"></textarea> (*&lt;200)</td></tr>
		<tr><td><input type="submit" name="send" value="新增投票主题" onclick="return checkAddForm();" class="submit">[<a href="vote.php?action=show">返回列表</a>]</td></tr>
	</table>
</form>
{/if}
{if $addchild}
<form method="post" name="add">
<input type="hidden" name="id" value="{$id}" class="text"> 
	<table cellspacing="0" class="left">
		<tr><td>投票主题:<span class="green">{$titlec}</span></td></tr>
		<tr><td>投票项目:<input type="text" name="title" class="text"> (*2~20)</td></tr>
		<tr><td>项目信息:<textarea name="info"></textarea> (*&lt;200)</td></tr>
		<tr><td><input type="submit" name="send" value="新增投票项目" onclick="return checkAddForm();" class="submit">[<a href="vote.php?action=show">返回列表</a>]</td></tr>
	</table>
</form>
{/if}
{if $update}
<form method="post" name="update">
	<input type="hidden" name="id" value="{$id}" class="text"> 
	<input type="hidden"  value="{$prev_url}" name="prev_url" class="text"> 
	<table cellspacing="0" class="left">
		<tr><td>投票{$name}:
		<input type="text" value="{$titlec}" name="title" class="text"> (*2~20)</td></tr>
		<tr><td>{$name}信息:
		<textarea name="info">{$info}</textarea> (*&lt;200)</td></tr>
		<tr><td><input type="submit" name="send" value="新增投票主题" onclick="return checkAddForm();" class="submit">[<a href="{$prev_url}">返回列表</a>]</td></tr>
	</table>
</form>
{/if}
</body>
</html>

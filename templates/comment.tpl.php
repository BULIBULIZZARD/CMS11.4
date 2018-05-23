<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="../style/admin.css"/>
<script type="text/javascript" src="../js/admin_manage.js"></script>
</head>
<body id="main">
<div class="map">
	管理首页&gt;&gt;内容管理&gt;&gt;<strong id="title">{$title}</strong>
</div>
<ol>
	<li><a href="comment.php?action=show" class="selected">评论列表</a></li>
</ol>
{if $show}
<form method="post" action="?action=check">
<table cellspacing="0">
	<tr><th>编号</th><th>评论内容</th><th>用户</th><th>所属文档</th><th>审核状态</th><th>批量审核</th><th>操作</th></tr>
	{if $AllComment}
	{foreach $AllComment(key,value)}
	<tr>
	<td><script type="text/javascript">document.write({@key+1}
	+
	{$num});</script> </td>
	<td title="{@value->full}"
	>{@value->content}</td>
	<td>{@value->user}</td>
	<td><a href="../details.php?id={@value->cid}" target="_blank" 
	title="{@value->title}">查看</a></td>
	<td>{@value->state}</td>
	<td>
	{iff @value->type}
	<input type="checkbox" name="notokid[]" value="{@value->id}">
	{else}
	<input type="checkbox" name="okid[]" value="{@value->id}">
	{/iff}
	</td> 
	<td>
	{iff @value->type}
	<a href="comment.php?action=state&id={@value->id}&type=notok">取消</a>|
	{else}
	<a href="comment.php?action=state&id={@value->id}&type=ok">审核</a>|
	{/iff}
	<a href="comment.php?action=delete&id={@value->id}" onclick="return confirm('吾日三省吾身,你真的要删除么?')?true:false">删除</a></td>
	</tr>
	{/foreach}
	<tr><td></td><td></td><td></td><td></td><td></td><td><input type="submit" name="send" value="批量审核" style="cursor:pointer;"></td><td></td></tr>
	{else}
	<tr><td colspan="7">没有任何数据,请添加数据</td></tr>
	{/if}
</table>
</form>
<div id="page">{$page}</div>
{/if}
</body>
</html>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Main</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css"/>
<script type="text/javascript" src="../js/admin_link.js"></script>
</head>
<body id="main">
<div class="map">
	管理首页&gt;&gt;内容管理&gt;&gt;<strong id="title">{$title}</strong>
</div>
<ol>
	<li><a href="link.php?action=show" class="selected">友情链接列表</a></li>
	<li><a href="link.php?action=add">新增友情链接</a></li>
	{if $update}
	<li><a href="link.php?action=update&id={$id}">修改友情链接</a></li>
	{/if}

</ol>
{if $show}
<table cellspacing="0">
	<tr><th>链接编号</th><th>网站名称</th><th>网站链接</th><th>Logo地址</th><th>站长</th><th>类型</th><th>状态</th><th>操作</th></tr>
	{if $AllLink}
	{foreach $AllLink(key,value)} 
	<tr>
	<td><script type="text/javascript">document.write({@key+1}
	+
	{$num});</script> </td>
	<td>{@value->webname}</td>
	<td><a href="{@value->wu}" target="_blank"
	title="{@value->wu}">
	{@value->weburl}</a>
	</td>
	{iff @value->logourl}
	<td><a href="{@value->lu}" target="_blank"
	title="{@value->lu}">
	{@value->logourl}
	</a></td>
	{else}
	<td>-</td>
	{/iff}
	{iff @value->user}
	<td>{@value->user}</td>
	{else}
	<td>-</td>
	{/iff}
	<td>{@value->ttype}</td>
	{iff @value->state}
	<td><span class="green">[已审核]</span><a href="link.php?action=state&type=notok&id={@value->id}">(取消)</a></td>
	{else}
	<td><span class="red">[未审核]</span><a href="link.php?action=state&type=ok&id={@value->id}" >(审核)</a></td>
	{/iff}
	<td><a href=" link.php?action=update&id={@value->id}">修改</a>|
	<a href=" link.php?action=delete&id={@value->id}" onclick="return confirm('吾日三省吾身,你真的要删除么?')?true:false">删除</a></td>
	</tr>
	{/foreach}
	{else}
	<tr><td colspan="6">没有任何数据,请添加数据</td></tr>
	{/if}
</table>
<div id=page>{$page}</div>
{/if}

{if $add}
<form method="post" name="friendlink" action="link.php?action=add">
<input type="hidden" value="1" name="state">
	<table cellspacing="0" class="left">
		<tr><td>网站类型 :<input type="radio" name="type" value="1"  onclick="_link(1)" checked="checked">文字链接
						<input type="radio" name="type" value="2"  onclick="_link(2)">图片链接
						</td></tr>
		<tr><td>网站名称 :<input type="text" class="text" name="webname"><span class="red">*</span>(网站名称2~20个字符　<span class="red">*</span>为必填 )</td></tr>
		<tr><td>网站地址 :<input type="text" class="text" name="weburl"><span class="red">*</span>(网站地址最多100个字符)</td></tr>
		<tr id="logo" style="display: none;"><td>Logo地址:<input type="text" class="text" name="logourl"><span class="red">*</span>(Logo地址不能为空)</td></tr>
		<tr><td>站长姓名 :<input type="text" class="text" name="user"></td></tr>
		<tr><td style="padding: 0 0 0 10px;"><input type="submit" name="send" value="新增友情链接" onclick="return checkLink();"  class="submit">[<a href="{$prev_url}">返回列表</a>]</td></tr>
	</table>
</form>
{/if}
{if $update}
<form method="post" name="friendlink">
	<input type="hidden" name="id" value="{$id}" class="text"> 
	<input type="hidden"  value="{$prev_url}" name="prev_url" class="text"> 
	<table cellspacing="0" class="left">
		<tr><td>网站类型 :<input type="radio" name="type" value="1"  onclick="_link(1)" {$type1}>文字链接
						<input type="radio" name="type" value="2"  onclick="_link(2)" {$type2}>图片链接
						</td></tr>
		<tr><td>网站名称 :<input type="text" class="text" value="{$webname}" name="webname"><span class="red">*</span>(网站名称2~20个字符　<span class="red">*</span>为必填 )</td></tr>
		<tr><td>网站地址 :<input type="text" class="text" value="{$weburl}" name="weburl"><span class="red">*</span>(网站地址最多100个字符)</td></tr>
		<tr id="logo" style="display: {$block};"><td>Logo地址:<input type="text" value="{$logourl}" class="text" name="logourl"><span class="red">*</span>(Logo地址不能为空)</td></tr>
		<tr><td>站长姓名 :<input type="text" class="text" value="{$user}" name="user"></td></tr>
		<tr><td style="padding: 0 0 0 10px;"><input type="submit" name="send" value="修改友情链接" onclick="return checkLink();"  class="submit">[<a href="{$prev_url}">返回列表</a>]</td></tr>
	</table>
</form>
{/if}
</body>
</html>

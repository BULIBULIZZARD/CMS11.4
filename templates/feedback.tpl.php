<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="style/basic.css"/>
<link rel="stylesheet" type="text/css" href="style/feedback.css"/>
<script type="text/javascript" src="js/details.js"></script>
</head>
<body>

{include file="header.tpl"}
<div id="feedback">
	<h2>评论列表</h2>
	<h3>{$titlec}</h3>
	<p class="info">{$info}
	<a href="details.php?id={$id}">[详情]</a></p>
	{if $HotComment}
	<h4>热评</h4>
	{foreach $HotComment(key,value)}
	<dl>
		<dt><img src="images/face/{@value->face}" alt="游客"></dt>
		<dd><em>{@value->date} 发表</em>
		<span>[{@value->user}]</span><img src="images/hot.png" alt="hot"></dd>
		<dd class="info">[{@value->manner}]
		{@value->content}</dd>
		<dd class="bottom"><a href="feedback.php?cid={@value->cid}
		&id={@value->id}&type=sustain">赞一个
		[{@value->sustain}]</a> 
		<a href="feedback.php?cid={@value->cid}
		&id={@value->id}&type=oppose">踩一下
		[{@value->oppose}]</a></dd>
	</dl>
	{/foreach}
	{/if}
	{if $AllComment}
	<h4>最新评论</h4>
	{foreach $AllComment(key,value)}
	<dl>
		<dt><img src="images/face/{@value->face}" alt="游客"></dt>
		<dd><em>{@value->date} 发表</em>
		<span>[{@value->user}]</span></dd>
		<dd class="info">[{@value->manner}]
		{@value->content}</dd>
		<dd class="bottom"><a href="feedback.php?cid={@value->cid}
		&id={@value->id}&type=sustain">赞一个
		[{@value->sustain}]</a> 
		<a href="feedback.php?cid={@value->cid}
		&id={@value->id}&type=oppose">踩一下
		[{@value->oppose}]</a></dd>
	</dl>
	{/foreach}
	{else}
	<h4>最新评论</h4>
	<dl>
		<dd></dd>
		<dd></dd>
		<dd style="font-size: 20px;">这有沙发不坐一下么?</dd>
		<dd></dd>
		<dd></dd>
	</dl>
	{/if}
	<div id="page">{$page}</div>
	
</div>
<div id="sidebar">
	<h2>热评文档</h2>
	<ul>
	{foreach $MostComment(key,value)}
		<li><a href="details.php?id={@value->id}" target="_blank">
		{@value->title}</a></li>
	{/foreach}
	</ul>
</div>
<div class="d5">
	<form method="post" action="feedback.php?cid={$cid}" name="comment" >
		<p>你对本文感兴趣么? <input type="radio" name="manner" value="1" checked="checked">赞
						<input type="radio" name="manner"  value="0">踩
		</p>
		<p class="red">请您发表和谐评论,共同创建绿色网络!</p>
		<p><textarea name="content"></textarea></p>
		<p style="position: relative;top:-5px;">验证码:<input type="text" class="text" name="code">
		<img src="config/code.php" onclick="javascript:this.src='config/code.php?tm='+Math.random();" class="code">
		<input type="submit" name="send" class="submit" value="提交评论" onclick="return checkComment();"></p>
		</form>
	</div>
{include file='footer.tpl'} 
</body>
</html>
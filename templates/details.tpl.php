<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="style/basic.css"/>
<link rel="stylesheet" type="text/css" href="style/details.css"/>
<script type="text/javascript" src="js/details.js"></script>
{$sp}
</head>
<body>

{include file="header.tpl"}
<div id="details">
	<h2>当前位置{$father}
	&gt;{$nav}</h2>
	<h3>{$titlec}</h3>
	<div class="d1">时间:{$date}　来源:{$source}　作者:{$author}　点击量:{$count}</div>
	{if $info} 
	<div class="d2">{$info}</div>
	{/if}
	<div class="d3">{$content}</div>
	<div class="d4">TAB标签:{$tag}</div>
	<div class="d6">
		<h2><a href="feedback.php?cid={$id}" target="_blank">已经<span>{$comment}</span>人参与评论</a>最新评论</h2>
		{if $newcomment}
		{foreach $newcomment(key,value)}
		<dl>
    		<dt><img src="images/face/{@value->face}" alt="游客"></dt>
    		<dd><em>{@value->date} 发表</em>
    		<span>[{@value->user}]</span></dd>
    		<dd class="info">[{@value->manner}]
    		{@value->content}</dd>
    		<dd class="bottom"> 
    		<a href="feedback.php?cid={@value->cid}
&id={@value->id}&type=oppose" target="_blank">踩一下
    		[{@value->oppose}]</a>
    		<a href="feedback.php?cid={@value->cid} 
&id={@value->id}&type=sustain" target="_blank">赞一个
    		[{@value->sustain}]</a></dd>
		</dl>
		{/foreach}
		{else}
			<p style="font-size:18px; padding:20px; color:#f60;">还没有评论哦!</p>
		{/if}
	</div>
	<div class="d5">
	<form method="post" action="feedback.php?cid={$id}" name="comment" target="_blank">
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
</div>
<div id="sidebar">
    {if $MonthNavRec}
    <div class="right">
	<h2>当月本类推荐</h2>
	<ul>
	{foreach $MonthNavRec(key,value)}
		<li><em>{@value->date}</em>
		<a href="details.php?id={@value->id}">
		{@value->title}</a></li>
	{/foreach}
	</ul>
	</div>
	{/if}
	{if $MonthNavHot}
	<div class="right">
	<h2>当月本类热点</h2>
	<ul>
	{foreach $MonthNavHot(key,value)}
		<li><em>{@value->date}</em>
		<a href="details.php?id={@value->id}">
		{@value->title}</a></li>
	{/foreach}
	</ul>
	</div>
	{/if}
	{if $MonthNavPic}
	<div class="right">
	<h2>当月本类图文</h2>
	<ul>
	{foreach $MonthNavPic(key,value)}
		<li><em>{@value->date}</em>
		<a href="details.php?id={@value->id}">
		{@value->title}</a></li>
	{/foreach}
	</ul>
	</div>
	{/if}
</div>
{include file='footer.tpl'} 
</body>
</html>
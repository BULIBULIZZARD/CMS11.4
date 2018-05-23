<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="style/basic.css"/>
<link rel="stylesheet" type="text/css" href="style/list.css"/>

</head>
<body>
{include file="header.tpl"}
<div id="list">
	<h2>当前位置
	&gt;{$Search}</h2>
	{if $SearchContent}
	{foreach $SearchContent(key,value)}
	<dl>
		<dt><a href="details.php?id={@value->id}" target="_blank">
		<img src="{@value->thumbnail}"  
		alt="{@value->t}" ></a></dt>
		<dd>[<strong>{@value->nav_name}</strong>]
		<a href="details.php?id={@value->id}" target="_blank">
		{@value->title}</a></dd>
		<dd>日期 :{@value->date}
		点击率:{@value->count}
		关键字:{@value->keyword}
		</dd>
		<dd>{@value->info}</dd>
	</dl>
	{/foreach}
	{else}
	<p class="none">没有搜索到相关文章</p>
	{/if}
	<div id="page">{$page}</div>
</div>
<div id="sidebar">
     {if $MonthNavRec}
    <div class="right">
	<h2>本月推荐</h2>
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
	<h2>本月热点</h2>
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
	<h2>本月图文</h2>
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
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
	<h2>当前位置{$father}
	&gt;{$nav}</h2>
	{if $AllListContent}
	{foreach $AllListContent(key,value)}
	<dl>
		<dt><a href="details.php?id={@value->id}" target="_blank">
		<img src="{@value->thumbnail}"  alt="未找到图片" ></a></dt>
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
	<p class="none">此栏目下没有文章</p>
	{/if}
	<div id="page">{$page}</div>
</div>
<div id="sidebar">
    <div class="nav">
     	<h2>子栏目列表</h2>
     	{if $childNav}
     	{foreach $childNav(key,value)}
         <strong><a href="list.php?id={@value->id}">
         {@value->nav_name}</a></strong>
         {/foreach}
        {else}
         <span>此栏目无子导航</span>
        {/if}
     </div>
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
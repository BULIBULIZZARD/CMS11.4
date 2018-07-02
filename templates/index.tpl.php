<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="style/index.css"/>
<link rel="stylesheet" type="text/css" href="style/basic.css"/>
<script type="text/javascript" src="js/reg.js"></script>
<script type="text/javascript" src="config/static.php?type=index"></script>
<link rel="stylesheet" type="text/css" href="showpic/css/style.css" />
<script src="showpic/js/myjs.js"></script>
<script type="text/javascript" src="showpic/js/common.js"></script>
</head>
<body>

{include file="header.tpl"}
<div id="user">
{if $cache}
{$member}
{else}
	{if $login}
	<h2>会员登陆</h2>
	<form method="post" name="login" action="register.php?action=login">
		<label>用户名:<input type="text" name="user" class="text"></label>
		<label>密　码:<input type="password" name="pass" class="text"></label>
		<label class="yzm">验证码:<input type="text" name="code" class="text code"> <img src="config/code.php" onclick="javascript:this.src='config/code.php?tm='+Math.random();" class="code"></label>
		<p><input type="submit" name="send" value="登陆" class="submit" onclick="return checkLogin();">  <a href="register.php?action=reg">注册会员</a>  <a href="###">忘记密码?</a></p>
	</form>	
	{else}
	<h2>会员信息</h2>
	<div class="a">
	您好,<strong>{$user}</strong>
	</div>
	<div class="b">
		<img src="images/face/{$face}" 
		alt="{$user}">
		<a href="###">个人中心</a>
		<a href="###">我的评论</a>
		<a href="register.php?action=logout">退出登陆</a>
	</div>
	{/if}
{/if}
		<h3><span>----------------</span>最近登陆会员<span>----------------</span></h3>
		{if $AllLaterUser}
		{foreach $AllLaterUser(key,value)}
		<dl>
			<dt><img src="images/face/{@value->face}" alt="头像"></dt>
			<dd>{@value->user}</dd>
		</dl>
		{/foreach}
		{/if}
	
</div>
<div id="news">
	<h3><a href="details.php?id={$NewTopId}" target="_blank">
	{$NewTopTitle}</a></h3>
	<p>{$NewTopInfo}
	<a href="details.php?id={$NewTopId}" target="_blank">[阅读全文]</a></p>   
	<p class="link">
	{if $NewTopList}
	{foreach $NewTopList(key,value)}
        <a href="details.php?id={@value->id}" target="_blank">
       {@value->title}</a>
       {@value->line}
    {/foreach}
	{/if}
	</p>
	<ul>
		{if $NewList}
		{foreach $NewList(key,value)}
		<li><em>{@value->date}</em>
		<a href="details.php?id={@value->id}" target="_blank" style="width:90px;">
		{@value->title}</a></li>
		{/foreach}
		{/if}
	</ul>
</div>
<div id="pic">
<div id="box">
	<ul id="list">
	{foreach $Rotatain(key,value)}
		<li><a href="{@value->link}" 
		alt="{@value->title}"
		>
		<img src="{@value->thumbnail}" /></a></li>
	{/foreach}	
	</ul>
	<ul id="num">
		{foreach $Rotatain(key,value)}
		{@value->li}
		{/foreach}
	</ul>
</div>
<div style="text-align:center;clear:both">
</div>
</div>
<div id="rec">
	<h2>特别推荐</h2>
	<ul>
		{if $NewRecList}
		{foreach $NewRecList(key,value)}
		<li><em>{@value->date}</em>
		<a href="details.php?id={@value->id}" target="_blank">
		{@value->title}</a></li>
		{/foreach}
		{/if}
	</ul>
</div>
<div id="sidebar-right">
	<div class="adver"><script type="text/javascript" src="js/sidebar_adver.js"></script></div>
	<div class="hot"> 
		<h2>本月热点</h2>
    	<ul>
    		{if $MonthHot}
    		{foreach $MonthHot(key,value)}
    		<li><em>{@value->date}</em>
    		<a href="details.php?id={@value->id}" target="_blank">
    		{@value->title}</a></li>
    		{/foreach}
    		{/if}
    	</ul>
	</div>
	<div class="comm">
		<h2>本月评论</h2>
    	<ul>
    		{if $MonthCommentList}
    		{foreach $MonthCommentList(key,value)}
    		<li><em>{@value->date}</em>
    		<a href="details.php?id={@value->id}" target="_blank">
    		{@value->title}</a></li>
    		{/foreach}
    		{/if}
    	</ul>
	</div>
	<div class="vote">
		<h2>调查投票</h2>
		<h3>{$votetitle}</h3> 
		<form method="post" action="cast.php" target="_blank">
			{if $voteChild}
			{foreach $voteChild(key,value)}
			<label><input type="radio" name="vote" value="{@value->id}"
			>{@value->title}</label>
			{/foreach}
			{/if}
			<p><input type="submit" value="投票" name="send"><input type="submit" value="查看"></p>
		</form>
	</div>
</div>
<div id="picnews">
	<h2>图文资讯</h2>
	{if $PicList}
    {foreach $PicList(key,value)}
   		<dl>
		<dt><a href="details.php?id={@value->id}" target="_blank">
		<img alt="{@value->title}" 
		src="{@value->thumbnail}"></a></dt>
		<dd><a href="details.php?id={@value->id}" target="_blank">
		{@value->title}</a></dd>
		</dl>
	{/foreach}
    {/if}
</div>
<div id="newslist">
{foreach $FourNav(key,value)}
	<div class="{@value->class}">
		<h2><a href="list.php?id={@value->id}">更多
		</a>{@value->nav_name}</h2>
    	<ul>
    		{iff @value->list}
    		{for @value->list(key,value)}
    		<li><em>{@value->date}</em>
    		<a href="details.php?id={@value->id}" target="_blank"
    		title="{@value->title}">
    		{@value->title}</a></li>
    		{/for}
    		{else}
    		<p style="text-align: center">此栏目暂无文章哦</p>
    		{/iff}
    	</ul>
	</div>
{/foreach}
</div>
{include file='footer.tpl'} 
</body>
</html>
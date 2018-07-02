<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="style/basic.css"/>
<link rel="stylesheet" type="text/css" href="style/cast.css"/>

</head>
<body>
{include file="header.tpl"}
<div id="cast">
	<h2>调查投票</h2>
	<table cellspacing="1">
	<caption>{$votetitle}</caption>
		<tr><th>投票项目</th><th>图示比例</th><th>百分比</th><th>得票数</th></tr>
			{if $voteChild}
			{foreach $voteChild(key,value)}
			<tr>
			<td>{@value->title}</td>
			<td style="text-align: left ;width:{$width}px;">
			<img src="images/b{@value->picnum}.jpg" 
			style="width:{@value->picwidth}px;height:21px;"/></td>
			<td>{@value->parcent}</td>
			<td>{@value->count}</td></tr>
			{/foreach}
			{/if}
		
	</table>
</div>
{include file='footer.tpl'} 
</body>
</html>
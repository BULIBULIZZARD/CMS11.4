<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="style/basic.css"/>
<link rel="stylesheet" type="text/css" href="style/friendlink.css"/>
<script type="text/javascript" src="js/link.js"></script>
</head>
<body>
{include file="header.tpl"}
{if $frontadd}
<div id="friendlink">
	<h2>申请加入</h2>
	<form method="post" name="friendlink" action="friendlink.php?action=frontadd"> 
	<input type="hidden" value="0" name="state">
		<dl>
			<dd>网站类型 :<input type="radio" name="type" value="1"  onclick="_link(1)" checked="checked">文字链接
						<input type="radio" name="type" value="2"  onclick="_link(2)">图片链接
			</dd>
			<dd>网站名称 :<input type="text" class="text" name="webname"><span class="red">*</span>(网站名称2~20个字符　<span class="red">*</span>为必填 )</dd>
			<dd>网站地址 :<input type="text" class="text" name="weburl"><span class="red">*</span>(网站地址最多100个字符)</dd>
			<dd id="logo" style="display: none;">Logo地址:<input type="text" id="logourl" class="text" name="logourl"><span class="red">*</span>(Logo地址不能为空)</dd>
			<dd>站长姓名 :<input type="text" class="text" name="user">
			<dd>验证码　 :<input type="text" class="text" name="code"><span class="red">*</span></dd>
			<dd><img src="config/code.php" onclick="javascript:this.src='config/code.php?tm='+Math.random();" class="code"></dd>
			<dd><input type="submit"  name="send" value="申请友情链接" class="submit" onclick="return checkLink();"></dd>
		</dl>
	</form>
</div>
{/if}
{if $frontshow}
<div id="friendlink">
	<h2>所有连接</h2>
	<h3>文字连接</h3>
	<div>
	{if $alltextlink}
	{foreach $alltextlink(key,value)}
		<a href="{@value->weburl}"
		title="{@value->weburl}" target="_blank">
		{@value->webname}</a>
	{/foreach}
	{else}
	暂无友情链接
	{/if}
	</div>
	<h3>图片连接</h3>
	<div>
	{if $alllogolink}
	{foreach $alllogolink(key,value)}
		<a href="{@value->weburl}" target="_blank">
		<img src="{@value->logourl}" 
		alt="{@value->webname}"></a>
	{/foreach}
	{/if}
	</div>
</div>
{/if}
{include file='footer.tpl'} 
</body>
</html>
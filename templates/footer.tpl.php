<div id="link">
	<h2><span><a href="friendlink.php?action=frontshow" target="_blank">所有连接</a>|<a href="friendlink.php?action=frontadd" target="_blank">申请加入</a></span>友情连接</h2>
	<ul>
	{if $textlink}
	{foreach $textlink(key,value)}
		<li><a href="{@value->weburl}"
		title="{@value->weburl}" target="_blank">
		{@value->webname}</a></li>
	{/foreach}
	{else}
	暂无友情链接
	{/if}	
	</ul>
	<dl>
	{if $logolink}
	{foreach $logolink(key,value)}
		<dd><a href="{@value->weburl}" target="_blank">
		<img src="{@value->logourl}" 
		alt="{@value->webname}"></a></dd>
	{/foreach}
	{/if}
	</dl>
</div>
<div id="footer">
	<p>DEMO完成于  <span>1526304762</span></p>
</div>
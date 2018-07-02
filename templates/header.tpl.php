<script type="text/javascript" src="config/static.php?type=header"></script>
<div id="top">
{$header}
<script type="text/javascript" src="js/text_adver.js"></script>
</div>
<title>{$webname}</title>
<div id="header">
<h1><a href="index.php">CMS项目DEOM</a></h1>
<div class="adver"><script type="text/javascript" src="js/header_adver.js"></script></div>
</div>
<div id="nav">
<ul>
<li><a href="./">首页</a></li>
{if $FrontNav}
{foreach $FrontNav(key,value)} 
<li><a href="list.php?id={@value->id}">
{@value->nav_name}</a></li>
{/foreach}
{/if}
</ul>
</div>
<div id="search">
<form method="get" action="search.php">
<select name="type">
<option selected="selected" value="1">按标题</option>
<option value="2">按关键字</option>
</select>
<input type="text" name="key" class="text">
<input type="submit" class="submit" value="查询">
</form>
<strong>TAG标签:</strong>
<ul>
{if $fivetag}
{foreach $fivetag(key,value)} 
<li><a href="search.php?type=3&key={@value->name}">
{@value->name}
({@value->count})</a></li>
{/foreach}
{/if}
</ul>
</div>
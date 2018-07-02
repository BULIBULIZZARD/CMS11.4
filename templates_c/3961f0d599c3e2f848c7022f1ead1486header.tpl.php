<script type="text/javascript" src="config/static.php?type=header"></script>
<div id="top">
<?php echo $this->_vars['header']?>
<script type="text/javascript" src="js/text_adver.js"></script>
</div>
<title><?php echo $this->_vars['webname']?></title>
<div id="header">
<h1><a href="index.php">CMS项目DEOM</a></h1>
<div class="adver"><script type="text/javascript" src="js/header_adver.js"></script></div>
</div>
<div id="nav">
<ul>
<li><a href="./">首页</a></li>
<?php if($this->_vars['FrontNav']){?>
<?php foreach($this->_vars['FrontNav'] as $key=>$value){?> 
<li><a href="list.php?id=<?php echo $value->id?>">
<?php echo $value->nav_name?></a></li>
<?php }?>
<?php }?>
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
<?php if($this->_vars['fivetag']){?>
<?php foreach($this->_vars['fivetag'] as $key=>$value){?> 
<li><a href="search.php?type=3&key=<?php echo $value->name?>">
<?php echo $value->name?>
(<?php echo $value->count?>)</a></li>
<?php }?>
<?php }?>
</ul>
</div>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="style/basic.css"/>
<link rel="stylesheet" type="text/css" href="style/list.css"/>

</head>
<body>
<?php $_tpl->create('header.tpl')?>
<div id="list">
	<h2>当前位置<?php echo $this->_vars['father']?>
	&gt;<?php echo $this->_vars['nav']?></h2>
	<?php if($this->_vars['AllListContent']){?>
	<?php foreach($this->_vars['AllListContent'] as $key=>$value){?>
	<dl>
		<dt><a href="details.php?id=<?php echo $value->id?>" target="_blank">
		<img src="<?php echo $value->thumbnail?>"  alt="未找到图片" ></a></dt>
		<dd>[<strong><?php echo $value->nav_name?></strong>]
		<a href="details.php?id=<?php echo $value->id?>" target="_blank">
		<?php echo $value->title?></a></dd>
		<dd>日期 :<?php echo $value->date?>
		点击率:<?php echo $value->count?>
		关键字:<?php echo $value->keyword?>
		</dd>
		<dd><?php echo $value->info?></dd>
	</dl>
	<?php }?>
	<?php }else{?>
	<p class="none">此栏目下没有文章</p>
	<?php }?>
	<div id="page"><?php echo $this->_vars['page']?></div>
</div>
<div id="sidebar">
    <div class="nav">
     	<h2>子栏目列表</h2>
     	<?php if($this->_vars['childNav']){?>
     	<?php foreach($this->_vars['childNav'] as $key=>$value){?>
         <strong><a href="list.php?id=<?php echo $value->id?>">
         <?php echo $value->nav_name?></a></strong>
         <?php }?>
        <?php }else{?>
         <span>此栏目无子导航</span>
        <?php }?>
     </div>
     <?php if($this->_vars['MonthNavRec']){?>
    <div class="right">
	<h2>当月本类推荐</h2>
	<ul>
	<?php foreach($this->_vars['MonthNavRec'] as $key=>$value){?>
		<li><em><?php echo $value->date?></em>
		<a href="details.php?id=<?php echo $value->id?>">
		<?php echo $value->title?></a></li>
	<?php }?>
	</ul>
	</div>
	<?php }?>
	<?php if($this->_vars['MonthNavHot']){?>
	<div class="right">
	<h2>当月本类热点</h2>
	<ul>
	<?php foreach($this->_vars['MonthNavHot'] as $key=>$value){?>
		<li><em><?php echo $value->date?></em>
		<a href="details.php?id=<?php echo $value->id?>">
		<?php echo $value->title?></a></li>
	<?php }?>
	</ul>
	</div>
	<?php }?>
	<?php if($this->_vars['MonthNavPic']){?>
	<div class="right">
	<h2>当月本类图文</h2>
	<ul>
	<?php foreach($this->_vars['MonthNavPic'] as $key=>$value){?>
		<li><em><?php echo $value->date?></em>
		<a href="details.php?id=<?php echo $value->id?>">
		<?php echo $value->title?></a></li>
	<?php }?>
	</ul>
	</div>
	<?php }?>
</div>
<?php $_tpl->create('footer.tpl')?> 
</body>
</html>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="style/basic.css"/>
<link rel="stylesheet" type="text/css" href="style/feedback.css"/>
<script type="text/javascript" src="js/details.js"></script>
</head>
<body>

<?php $_tpl->create('header.tpl')?>
<div id="feedback">
	<h2>评论列表</h2>
	<h3><?php echo $this->_vars['titlec']?></h3>
	<p class="info"><?php echo $this->_vars['info']?>
	<a href="details.php?id=<?php echo $this->_vars['id']?>">[详情]</a></p>
	<?php if($this->_vars['HotComment']){?>
	<h4>热评</h4>
	<?php foreach($this->_vars['HotComment'] as $key=>$value){?>
	<dl>
		<dt><img src="images/face/<?php echo $value->face?>" alt="游客"></dt>
		<dd><em><?php echo $value->date?> 发表</em>
		<span>[<?php echo $value->user?>]</span><img src="images/hot.png" alt="hot"></dd>
		<dd class="info">[<?php echo $value->manner?>]
		<?php echo $value->content?></dd>
		<dd class="bottom"><a href="feedback.php?cid=<?php echo $value->cid?>
		&id=<?php echo $value->id?>&type=sustain">赞一个
		[<?php echo $value->sustain?>]</a> 
		<a href="feedback.php?cid=<?php echo $value->cid?>
		&id=<?php echo $value->id?>&type=oppose">踩一下
		[<?php echo $value->oppose?>]</a></dd>
	</dl>
	<?php }?>
	<?php }?>
	<?php if($this->_vars['AllComment']){?>
	<h4>最新评论</h4>
	<?php foreach($this->_vars['AllComment'] as $key=>$value){?>
	<dl>
		<dt><img src="images/face/<?php echo $value->face?>" alt="游客"></dt>
		<dd><em><?php echo $value->date?> 发表</em>
		<span>[<?php echo $value->user?>]</span></dd>
		<dd class="info">[<?php echo $value->manner?>]
		<?php echo $value->content?></dd>
		<dd class="bottom"><a href="feedback.php?cid=<?php echo $value->cid?>
		&id=<?php echo $value->id?>&type=sustain">赞一个
		[<?php echo $value->sustain?>]</a> 
		<a href="feedback.php?cid=<?php echo $value->cid?>
		&id=<?php echo $value->id?>&type=oppose">踩一下
		[<?php echo $value->oppose?>]</a></dd>
	</dl>
	<?php }?>
	<?php }else{?>
	<h4>最新评论</h4>
	<dl>
		<dd></dd>
		<dd></dd>
		<dd style="font-size: 20px;">这有沙发不坐一下么?</dd>
		<dd></dd>
		<dd></dd>
	</dl>
	<?php }?>
	<div id="page"><?php echo $this->_vars['page']?></div>
	
</div>
<div id="sidebar">
	<h2>热评文档</h2>
	<ul>
	<?php foreach($this->_vars['MostComment'] as $key=>$value){?>
		<li><a href="details.php?id=<?php echo $value->id?>" target="_blank">
		<?php echo $value->title?></a></li>
	<?php }?>
	</ul>
</div>
<div class="d5">
	<form method="post" action="feedback.php?cid=<?php echo $this->_vars['cid']?>" name="comment" >
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
<?php $_tpl->create('footer.tpl')?> 
</body>
</html>
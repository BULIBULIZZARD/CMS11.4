<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="style/basic.css"/>
<link rel="stylesheet" type="text/css" href="style/details.css"/>
<script type="text/javascript" src="js/details.js"></script>
<?php echo $this->_vars['sp']?>
</head>
<body>

<?php $_tpl->create('header.tpl')?>
<div id="details">
	<h2>当前位置<?php echo $this->_vars['father']?>
	&gt;<?php echo $this->_vars['nav']?></h2>
	<h3><?php echo $this->_vars['titlec']?></h3>
	<div class="d1">时间:<?php echo $this->_vars['date']?>　来源:<?php echo $this->_vars['source']?>　作者:<?php echo $this->_vars['author']?>　点击量:<?php echo $this->_vars['count']?></div>
	<?php if($this->_vars['info']){?> 
	<div class="d2"><?php echo $this->_vars['info']?></div>
	<?php }?>
	<div class="d3"><?php echo $this->_vars['content']?></div>
	<div class="d4">TAB标签:<?php echo $this->_vars['tag']?></div>
	<div class="d6">
		<h2><a href="feedback.php?cid=<?php echo $this->_vars['id']?>" target="_blank">已经<span><?php echo $this->_vars['comment']?></span>人参与评论</a>最新评论</h2>
		<?php if($this->_vars['newcomment']){?>
		<?php foreach($this->_vars['newcomment'] as $key=>$value){?>
		<dl>
    		<dt><img src="images/face/<?php echo $value->face?>" alt="游客"></dt>
    		<dd><em><?php echo $value->date?> 发表</em>
    		<span>[<?php echo $value->user?>]</span></dd>
    		<dd class="info">[<?php echo $value->manner?>]
    		<?php echo $value->content?></dd>
    		<dd class="bottom"> 
    		<a href="feedback.php?cid=<?php echo $value->cid?>
&id=<?php echo $value->id?>&type=oppose" target="_blank">踩一下
    		[<?php echo $value->oppose?>]</a>
    		<a href="feedback.php?cid=<?php echo $value->cid?> 
&id=<?php echo $value->id?>&type=sustain" target="_blank">赞一个
    		[<?php echo $value->sustain?>]</a></dd>
		</dl>
		<?php }?>
		<?php }else{?>
			<p style="font-size:18px; padding:20px; color:#f60;">还没有评论哦!</p>
		<?php }?>
	</div>
	<div class="d5">
	<form method="post" action="feedback.php?cid=<?php echo $this->_vars['id']?>" name="comment" target="_blank">
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
</div>
<div id="sidebar">
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
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

<?php $_tpl->create('header.tpl')?>
<div id="user">
<?php if($this->_vars['cache']){?>
<?php echo $this->_vars['member']?>
<?php }else{?>
	<?php if($this->_vars['login']){?>
	<h2>会员登陆</h2>
	<form method="post" name="login" action="register.php?action=login">
		<label>用户名:<input type="text" name="user" class="text"></label>
		<label>密　码:<input type="password" name="pass" class="text"></label>
		<label class="yzm">验证码:<input type="text" name="code" class="text code"> <img src="config/code.php" onclick="javascript:this.src='config/code.php?tm='+Math.random();" class="code"></label>
		<p><input type="submit" name="send" value="登陆" class="submit" onclick="return checkLogin();">  <a href="register.php?action=reg">注册会员</a>  <a href="###">忘记密码?</a></p>
	</form>	
	<?php }else{?>
	<h2>会员信息</h2>
	<div class="a">
	您好,<strong><?php echo $this->_vars['user']?></strong>
	</div>
	<div class="b">
		<img src="images/face/<?php echo $this->_vars['face']?>" 
		alt="<?php echo $this->_vars['user']?>">
		<a href="###">个人中心</a>
		<a href="###">我的评论</a>
		<a href="register.php?action=logout">退出登陆</a>
	</div>
	<?php }?>
<?php }?>
		<h3><span>----------------</span>最近登陆会员<span>----------------</span></h3>
		<?php if($this->_vars['AllLaterUser']){?>
		<?php foreach($this->_vars['AllLaterUser'] as $key=>$value){?>
		<dl>
			<dt><img src="images/face/<?php echo $value->face?>" alt="头像"></dt>
			<dd><?php echo $value->user?></dd>
		</dl>
		<?php }?>
		<?php }?>
	
</div>
<div id="news">
	<h3><a href="details.php?id=<?php echo $this->_vars['NewTopId']?>" target="_blank">
	<?php echo $this->_vars['NewTopTitle']?></a></h3>
	<p><?php echo $this->_vars['NewTopInfo']?>
	<a href="details.php?id=<?php echo $this->_vars['NewTopId']?>" target="_blank">[阅读全文]</a></p>   
	<p class="link">
	<?php if($this->_vars['NewTopList']){?>
	<?php foreach($this->_vars['NewTopList'] as $key=>$value){?>
        <a href="details.php?id=<?php echo $value->id?>" target="_blank">
       <?php echo $value->title?></a>
       <?php echo $value->line?>
    <?php }?>
	<?php }?>
	</p>
	<ul>
		<?php if($this->_vars['NewList']){?>
		<?php foreach($this->_vars['NewList'] as $key=>$value){?>
		<li><em><?php echo $value->date?></em>
		<a href="details.php?id=<?php echo $value->id?>" target="_blank" style="width:90px;">
		<?php echo $value->title?></a></li>
		<?php }?>
		<?php }?>
	</ul>
</div>
<div id="pic">
<div id="box">
	<ul id="list">
	<?php foreach($this->_vars['Rotatain'] as $key=>$value){?>
		<li><a href="<?php echo $value->link?>" 
		alt="<?php echo $value->title?>"
		>
		<img src="<?php echo $value->thumbnail?>" /></a></li>
	<?php }?>	
	</ul>
	<ul id="num">
		<?php foreach($this->_vars['Rotatain'] as $key=>$value){?>
		<?php echo $value->li?>
		<?php }?>
	</ul>
</div>
<div style="text-align:center;clear:both">
</div>
</div>
<div id="rec">
	<h2>特别推荐</h2>
	<ul>
		<?php if($this->_vars['NewRecList']){?>
		<?php foreach($this->_vars['NewRecList'] as $key=>$value){?>
		<li><em><?php echo $value->date?></em>
		<a href="details.php?id=<?php echo $value->id?>" target="_blank">
		<?php echo $value->title?></a></li>
		<?php }?>
		<?php }?>
	</ul>
</div>
<div id="sidebar-right">
	<div class="adver"><script type="text/javascript" src="js/sidebar_adver.js"></script></div>
	<div class="hot"> 
		<h2>本月热点</h2>
    	<ul>
    		<?php if($this->_vars['MonthHot']){?>
    		<?php foreach($this->_vars['MonthHot'] as $key=>$value){?>
    		<li><em><?php echo $value->date?></em>
    		<a href="details.php?id=<?php echo $value->id?>" target="_blank">
    		<?php echo $value->title?></a></li>
    		<?php }?>
    		<?php }?>
    	</ul>
	</div>
	<div class="comm">
		<h2>本月评论</h2>
    	<ul>
    		<?php if($this->_vars['MonthCommentList']){?>
    		<?php foreach($this->_vars['MonthCommentList'] as $key=>$value){?>
    		<li><em><?php echo $value->date?></em>
    		<a href="details.php?id=<?php echo $value->id?>" target="_blank">
    		<?php echo $value->title?></a></li>
    		<?php }?>
    		<?php }?>
    	</ul>
	</div>
	<div class="vote">
		<h2>调查投票</h2>
		<h3><?php echo $this->_vars['votetitle']?></h3> 
		<form method="post" action="cast.php" target="_blank">
			<?php if($this->_vars['voteChild']){?>
			<?php foreach($this->_vars['voteChild'] as $key=>$value){?>
			<label><input type="radio" name="vote" value="<?php echo $value->id?>"
			><?php echo $value->title?></label>
			<?php }?>
			<?php }?>
			<p><input type="submit" value="投票" name="send"><input type="submit" value="查看"></p>
		</form>
	</div>
</div>
<div id="picnews">
	<h2>图文资讯</h2>
	<?php if($this->_vars['PicList']){?>
    <?php foreach($this->_vars['PicList'] as $key=>$value){?>
   		<dl>
		<dt><a href="details.php?id=<?php echo $value->id?>" target="_blank">
		<img alt="<?php echo $value->title?>" 
		src="<?php echo $value->thumbnail?>"></a></dt>
		<dd><a href="details.php?id=<?php echo $value->id?>" target="_blank">
		<?php echo $value->title?></a></dd>
		</dl>
	<?php }?>
    <?php }?>
</div>
<div id="newslist">
<?php foreach($this->_vars['FourNav'] as $key=>$value){?>
	<div class="<?php echo $value->class?>">
		<h2><a href="list.php?id=<?php echo $value->id?>">更多
		</a><?php echo $value->nav_name?></h2>
    	<ul>
    		<?php if($value->list){?>
    		<?php foreach($value->list as $key=>$value){?>
    		<li><em><?php echo $value->date?></em>
    		<a href="details.php?id=<?php echo $value->id?>" target="_blank"
    		title="<?php echo $value->title?>">
    		<?php echo $value->title?></a></li>
    		<?php }?>
    		<?php }else{?>
    		<p style="text-align: center">此栏目暂无文章哦</p>
    		<?php }?>
    	</ul>
	</div>
<?php }?>
</div>
<?php $_tpl->create('footer.tpl')?> 
</body>
</html>
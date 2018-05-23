<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Main</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css"/>
<script type="text/javascript" src="../js/admin_nav.js"></script>
</head>
<body id="main">
<div class="map">
	内容管理&gt;&gt;设置网站导航&gt;&gt;<strong id="title"><?php echo $this->_vars['title']?></strong>
</div>
<ol>
	<li><a href="nav.php?action=show" class="selected">导航列表</a></li>
	<li><a href="nav.php?action=add">新增导航</a></li>
	<?php if($this->_vars['update']){?>
	<li><a href="nav.php?action=update&id=<?php echo $this->_vars['id']?>">更新导航信息</a></li>
	<?php }?>
	<?php if($this->_vars['addchild']){?>
	<li><a href="nav.php?action=addchild&id=<?php echo $this->_vars['id']?>">新增子导航</a></li>
	<?php }?>
	<?php if($this->_vars['showchild']){?>
	<li><a href="nav.php?action=showchild&id=<?php echo $this->_vars['id']?>">子导航列表</a></li> 
	<?php }?>
</ol>
<?php if($this->_vars['show']){?>
<form method="post" action="nav.php?action=sort">
<table cellspacing="0">
	<tr><th>编号</th><th>导航名称</th><th>描述</th><th>子导航</th><th>操作</th><th>导航优先级</th></tr>
	<?php if($this->_vars['AllNav']){?>
	<?php foreach($this->_vars['AllNav'] as $key=>$value){?>
	<tr>
	<td><script type="text/javascript">document.write(<?php echo $key+1?>
	+
	<?php echo $this->_vars['num']?>);</script> </td>
	<td><?php echo $value->nav_name?></td>
	<td><?php echo $value->nav_info?></td>
	<td><a href="nav.php?action=showchild&id=<?php echo $value->id?>">查看</a>|
	<a href="nav.php?action=addchild&id=<?php echo $value->id?>">增加子导航</a></td>
	<td><a href=" nav.php?action=update&id=<?php echo $value->id?>">修改</a>|
	<a href=" nav.php?action=delete&id=<?php echo $value->id?>" onclick="return confirm('吾日三省吾身,你真的要删除么?')?true:false">删除</a></td>
	<td><input type="text" name="sort[<?php echo $value->id?>]" 
	value="<?php echo $value->sort?>" class="text sort"></td>
	</tr>
	<?php }?>
	<tr><td></td><td></td><td></td><td></td><td></td><td><input type="submit" name="send" value="更新优先级" style="cursor:pointer;"></td></tr>
	<?php }else{?>
	<tr><td colspan="6">没有任何数据,请添加数据</td></tr>
	<?php }?>
	
</table>
</form>
<div id=page><?php echo $this->_vars['page']?></div>
<?php }?>
<?php if($this->_vars['add']){?>
<form method="post" name="add">
	<table cellspacing="0" class="left">
		<tr><td>导航名称:<input type="text" name="nav_name" class="text"> (*2~20)</td></tr>
		<tr><td>导航信息:<textarea name="nav_info"></textarea> (*&lt;200)</td></tr>
		<tr><td><input type="submit" name="send" value="新增导航" onclick="return checkAddForm();" class="submit">[<a href="<?php echo $this->_vars['prev_url']?>">返回列表</a>]</td></tr>
	</table>
</form>
<?php }?>

<?php if($this->_vars['addchild']){?>
<form method="post" name="add">
<input type="hidden" name="pid" value="<?php echo $this->_vars['pid']?>">
	<table cellspacing="0" class="left">
		<tr><td>上级导航:<strong><?php echo $this->_vars['prev_name']?></strong></td></tr>
		<tr><td>导航名称:<input type="text" name="nav_name" class="text"> (*2~20)</td></tr>
		<tr><td>导航信息:<textarea name="nav_info"></textarea> (*&lt;200)</td></tr>
		<tr><td><input type="submit" name="send" value="新增子导航" onclick="return checkAddForm();" class="submit">[<a href="<?php echo $this->_vars['prev_url']?>">返回列表</a>]</td></tr>
	</table>
</form>
<?php }?>

<?php if($this->_vars['update']){?>
<form method="post" name="update">
	<input type="hidden" name="id" value="<?php echo $this->_vars['id']?>" class="text"> 
	<input type="hidden"  value="<?php echo $this->_vars['prev_url']?>" name="prev_url" class="text"> 
	<table cellspacing="0" class="left">
		<tr><td>导航名称:<input type="text" name="nav_name" value="<?php echo $this->_vars['nav_name']?>" class="text" > (*2~20)</td></tr>
		<tr><td>导航信息:<textarea name="nav_info"><?php echo $this->_vars['nav_info']?></textarea> (*&lt;200)</td></tr>
		<tr><td><input type="submit" name="send" value="修改信息" onclick="return checkUpadateForm();" class="submit" >[<a href="<?php echo $this->_vars['prev_url']?>">返回列表</a>]</td></tr>
	</table>
</form>
<?php }?>
<?php if($this->_vars['showchild']){?>
<form method="post" action="nav.php?action=sort">
<table cellspacing="0">
	<tr><th>编号</th><th>导航名称</th><th>描述</th><th>操作</th><th>导航优先级</th></tr>
	<?php if($this->_vars['AllChildNav']){?>
	<?php foreach($this->_vars['AllChildNav'] as $key=>$value){?>
	<tr>
	<td><script type="text/javascript">document.write(<?php echo $key+1?>
	+
	<?php echo $this->_vars['num']?>);</script> </td>
	<td><?php echo $value->nav_name?></td>
	<td><?php echo $value->nav_info?></td>
	<td><a href=" nav.php?action=update&id=<?php echo $value->id?>">修改</a>|
	<a href=" nav.php?action=delete&id=<?php echo $value->id?>" onclick="return confirm('吾日三省吾身,你真的要删除么?')?true:false">删除</a></td>
	
	<td><input type="text" name="sort[<?php echo $value->id?>]" 
	value="<?php echo $value->sort?>" class="text sort"></td></tr>
	<?php }?>
	<tr><td></td><td></td><td></td><td></td><td><input type="submit" name="send" value="更新优先级" style="cursor:pointer;"></td></tr>
	<?php }else{?>
	<tr><td colspan="5">没有任何数据,请添加数据</td></tr>
	<?php }?>
	<tr><td colspan="5">上级导航:<strong><?php echo $this->_vars['prev_name']?></strong>[<a href="nav.php?action=addchild&id=<?php echo $this->_vars['id']?>">添加子类</a>]
	[<a href="nav.php?action=show">上级列表</a>]</td></tr>
</table>
</form>
<div id=page><?php echo $this->_vars['page']?></div>
<?php }?>
</body>
</html>
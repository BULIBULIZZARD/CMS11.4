<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Main</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css"/>
<script type="text/javascript" src="../js/admin_premission.js"></script>
</head>
<body id="main">
<div class="map">
	管理首页&gt;&gt;权限管理&gt;&gt;<strong id="title"><?php echo $this->_vars['title']?></strong>
</div>
<ol>
	<li><a href="premission.php?action=show" class="selected">权限列表</a></li>
	<li><a href="premission.php?action=add">新增权限</a></li>
	<?php if($this->_vars['update']){?>
	<li><a href="premission.php?action=update&id=<?php echo $this->_vars['id']?>">更新权限信息</a></li>
	<?php }?>

</ol>
<?php if($this->_vars['show']){?>
<table cellspacing="0">
	<tr><th>权限编号</th><th>权限名称</th><th>标识</th><th>操作</th></tr>
	<?php if($this->_vars['AllPremission']){?>
	<?php foreach($this->_vars['AllPremission'] as $key=>$value){?>
	<tr>
	<td><script type="text/javascript">document.write(<?php echo $key+1?>
	+
	<?php echo $this->_vars['num']?>);</script> </td>
	<td><?php echo $value->name?></td>
	<td><?php echo $value->id?></td>
	<td><a href="premission.php?action=update&id=<?php echo $value->id?>">修改</a>|
	<a href="premission.php?action=delete&id=<?php echo $value->id?>" onclick="return confirm('吾日三省吾身,你真的要删除么?')?true:false">删除</a></td>
	</tr>
	<?php }?>
	<?php }else{?>
	<tr><td colspan="4">没有任何数据,请添加数据</td></tr>
	<?php }?>
</table>
<div id=page><?php echo $this->_vars['page']?></div>
<?php }?>

<?php if($this->_vars['add']){?>
<form method="post" name="add">
	<table cellspacing="0" class="left">
		<tr><td>权限名称:<input type="text" name="name" class="text"> (*2~100)</td></tr>
		<tr><td>权限信息:<textarea name="info"></textarea> (*&lt;200)</td></tr>
		<tr><td><input type="submit" name="send" value="新增权限" onclick="return checkAddForm();" class="submit">[<a href="<?php echo $this->_vars['prev_url']?>">返回列表</a>]</td></tr>
	</table>
</form>
<?php }?>
<?php if($this->_vars['update']){?>
<form method="post" name="update">
	<input type="hidden" name="id" value="<?php echo $this->_vars['id']?>" class="text"> 
	<input type="hidden"  value="<?php echo $this->_vars['prev_url']?>" name="prev_url" class="text"> 
	<table cellspacing="0" class="left">
		<tr><td>权限名称:<input type="text" name="name" value="<?php echo $this->_vars['name']?>" class="text" > (*2~20)</td></tr>
		<tr><td>权限信息:<textarea name="info"><?php echo $this->_vars['info']?></textarea> (*&lt;200)</td></tr>
		<tr><td><input type="submit" name="send" value="修改信息" onclick="return checkUpadateForm();" class="submit" >[<a href="<?php echo $this->_vars['prev_url']?>">返回列表</a>]</td></tr>
	</table>
</form>
<?php }?>
</body>
</html>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="../style/admin.css"/>
<script type="text/javascript" src="../js/admin_manage.js"></script>
</head>
<body id="main">
<div class="map">
	管理首页&gt;&gt;内容管理&gt;&gt;<strong id="title"><?php echo $this->_vars['title']?></strong>
</div>
<ol>
	<li><a href="comment.php?action=show" class="selected">评论列表</a></li>
</ol>
<?php if($this->_vars['show']){?>
<form method="post" action="?action=check">
<table cellspacing="0">
	<tr><th>编号</th><th>评论内容</th><th>用户</th><th>所属文档</th><th>审核状态</th><th>批量审核</th><th>操作</th></tr>
	<?php if($this->_vars['AllComment']){?>
	<?php foreach($this->_vars['AllComment'] as $key=>$value){?>
	<tr>
	<td><script type="text/javascript">document.write(<?php echo $key+1?>
	+
	<?php echo $this->_vars['num']?>);</script> </td>
	<td title="<?php echo $value->full?>"
	><?php echo $value->content?></td>
	<td><?php echo $value->user?></td>
	<td><a href="../details.php?id=<?php echo $value->cid?>" target="_blank" 
	title="<?php echo $value->title?>">查看</a></td>
	<td><?php echo $value->state?></td>
	<td>
	<?php if($value->type){?>
	<input type="checkbox" name="notokid[]" value="<?php echo $value->id?>">
	<?php }else{?>
	<input type="checkbox" name="okid[]" value="<?php echo $value->id?>">
	<?php }?>
	</td> 
	<td>
	<?php if($value->type){?>
	<a href="comment.php?action=state&id=<?php echo $value->id?>&type=notok">取消</a>|
	<?php }else{?>
	<a href="comment.php?action=state&id=<?php echo $value->id?>&type=ok">审核</a>|
	<?php }?>
	<a href="comment.php?action=delete&id=<?php echo $value->id?>" onclick="return confirm('吾日三省吾身,你真的要删除么?')?true:false">删除</a></td>
	</tr>
	<?php }?>
	<tr><td></td><td></td><td></td><td></td><td></td><td><input type="submit" name="send" value="批量审核" style="cursor:pointer;"></td><td></td></tr>
	<?php }else{?>
	<tr><td colspan="7">没有任何数据,请添加数据</td></tr>
	<?php }?>
</table>
</form>
<div id="page"><?php echo $this->_vars['page']?></div>
<?php }?>
</body>
</html>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="style/basic.css"/>
<link rel="stylesheet" type="text/css" href="style/cast.css"/>

</head>
<body>
<?php $_tpl->create('header.tpl')?>
<div id="cast">
	<h2>调查投票</h2>
	<table cellspacing="1">
	<caption><?php echo $this->_vars['votetitle']?></caption>
		<tr><th>投票项目</th><th>图示比例</th><th>百分比</th><th>得票数</th></tr>
			<?php if($this->_vars['voteChild']){?>
			<?php foreach($this->_vars['voteChild'] as $key=>$value){?>
			<tr>
			<td><?php echo $value->title?></td>
			<td style="text-align: left ;width:<?php echo $this->_vars['width']?>px;">
			<img src="images/b<?php echo $value->picnum?>.jpg" 
			style="width:<?php echo $value->picwidth?>px;height:21px;"/></td>
			<td><?php echo $value->parcent?></td>
			<td><?php echo $value->count?></td></tr>
			<?php }?>
			<?php }?>
		
	</table>
</div>
<?php $_tpl->create('footer.tpl')?> 
</body>
</html>
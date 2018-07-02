<div id="link">
	<h2><span><a href="friendlink.php?action=frontshow" target="_blank">所有连接</a>|<a href="friendlink.php?action=frontadd" target="_blank">申请加入</a></span>友情连接</h2>
	<ul>
	<?php if($this->_vars['textlink']){?>
	<?php foreach($this->_vars['textlink'] as $key=>$value){?>
		<li><a href="<?php echo $value->weburl?>"
		title="<?php echo $value->weburl?>" target="_blank">
		<?php echo $value->webname?></a></li>
	<?php }?>
	<?php }else{?>
	暂无友情链接
	<?php }?>	
	</ul>
	<dl>
	<?php if($this->_vars['logolink']){?>
	<?php foreach($this->_vars['logolink'] as $key=>$value){?>
		<dd><a href="<?php echo $value->weburl?>" target="_blank">
		<img src="<?php echo $value->logourl?>" 
		alt="<?php echo $value->webname?>"></a></dd>
	<?php }?>
	<?php }?>
	</dl>
</div>
<div id="footer">
	<p>DEMO完成于  <span>1526304762</span></p>
</div>
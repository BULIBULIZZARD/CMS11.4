<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Main</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css"/>
<script type="text/javascript" src="../js/admin_content.js"></script>
<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
</head>
<body id="main">
<div class="map">
	内容管理&gt;&gt;查看文档列表&gt;&gt;<strong id="title"><?php echo $this->_vars['title']?></strong>
</div>
<ol>
	<li><a href="content.php?action=show" class="selected">文档列表</a></li>
	<li><a href="content.php?action=add">新增文档</a></li>
	<?php if($this->_vars['update']){?>
	<li><a href="content.php?action=update&id=<?php echo $this->_vars['id']?>">修改文档</a></li>
	<?php }?>

</ol>

<?php if($this->_vars['show']){?>
<table cellspacing="0">
	<tr><th>编号</th><th>标题</th><th>属性</th><th>文档类别</th><th>浏览次数</th><th>发布时间</th><th>操作</th></tr>
	<?php if($this->_vars['SearchContent']){?>
	<?php foreach($this->_vars['SearchContent'] as $key=>$value){?>
	<tr>
	<td><script type="text/javascript">document.write(<?php echo $key+1?>
	+
	<?php echo $this->_vars['num']?>);</script> </td>
	<td><a href="../details.php?id=<?php echo $value->id?>" 
	title="<?php echo $value->t?>" target="_blank">
	<?php echo $value->title?></a></td>
	<td><?php echo $value->attr?></td>
	<td><a href="?action=show&nav=<?php echo $value->nav?>">
	<?php echo $value->nav_name?></a></td>
	<td><?php echo $value->count?></td>
	<td><?php echo $value->date?></td> 
	<td><a href=" content.php?action=update&id=<?php echo $value->id?>">修改</a>|
	<a href=" content.php?action=delete&id=<?php echo $value->id?>" onclick="return confirm('吾日三省吾身,你真的要删除么?')?true:false">删除</a></td>
	</tr>
	<?php }?>
	<?php }else{?>
	<tr><td colspan="7">没有任何数据,请添加数据</td></tr>
	<?php }?>
</table>
<form action="?act" method="get">
<div id="page"><?php echo $this->_vars['page']?>
<input type="hidden" name="action" value="show">
			<select name="nav" class="select">
				<option value="0">默认全部</option>
				<?php echo $this->_vars['nav']?>
			</select>
			<input value="查询" type="submit">
</div>
</form>
<?php }?>

<?php if($this->_vars['add']){?>
<form name="content" method="post" action="?action=add">
<table cellspacing="0" class="content">
	<tr><th><strong>发表新文档</strong></th></tr>
	<tr><td>文档标题:<input type="text" name="title" class="text"><span class="red">*</span>(2~50字符之间   <span class="red">*</span>为必填)</td></tr>
	<tr><td>栏　　目:<select name="nav"><option value="">请选择一个栏目 </option><?php echo $this->_vars['nav']?></select><span class="red">*</span></td></tr>
	<tr><td>定义属性:
				<input type="checkbox" name="attr[]" value="头条">头条
				<input type="checkbox" name="attr[]" value="推荐">推荐
				<input type="checkbox" name="attr[]" value="加粗">加粗
				<input type="checkbox" name="attr[]" value="跳转">跳转
	</td></tr>
	<tr><td>标　　签:<input type="text" name="tag" class="text">(请用','隔开可输入30字符)</td></tr>
	<tr><td>关 键 字 :<input type="text" name="keyword" class="text">(请用','隔开可输入30字符)</td></tr>
	<tr><td>缩 略 图 :<input type="text" name="thumbnail" class="text" readonly="readonly">
					<input type="button" value="上传缩略图" onclick="centerWindow('../config/upfile.php?type=content','upfile','500','100');">
					<img name="pic" style="display:none;">(请选择200KB以下的jpg,png,gif图片)
	</td></tr>
	<tr><td>文章来源:<input type="text" name="source" class="text">(20字符以内)</td></tr>
	<tr><td>作　　者:<input type="text" name="author" value="<?php echo $this->_vars['author']?>" class="text">(10字符以内)</td></tr>
	<tr><td><span class="middle">内容摘要:</span><textarea name="info"></textarea><span class="middle">(200字符以内)</span></td></tr>
	<tr class="ckeditor"><td><textarea id="TextArea1" name="content" class="ckeditor">----请在这里输入正文(不能为空)----</textarea></td></tr>
	<tr><td>评论选项:<input type="radio" name="commend" value="1" checked="checked">开启评论
				<input type="radio" name="commend" value="0">关闭评论 　　　　浏览次数:<input type="text" name="count" value="100" class="text small"></td></tr>
	<tr><td>文档排序:<select name="sort">
					<option value="0">默认排序</option>
					<option value="1">置顶一天</option>
					<option value="2">置顶一周</option>
					<option value="3">置顶一月</option>
					<option value="4">置顶一年</option></select> 　　　 消费金币:<input type="text" name="gold" value="0" class="text small"></td></tr>
	<tr><td>阅读权限:<select name="readlimit">
					<option value="0">开放浏览</option>
					<option value="1">初级会员</option>
					<option value="2">中级会员</option>
					<option value="3">高级会员</option>
					<option value="4">vip会员</option></select> 　　　 标题颜色:
					<select name="color">
					<option value="#333">默认颜色</option>
					<option value="#600" style="color:#600;">红色</option>
					<option value="#006" style="color:#006;">蓝色</option>
					<option value="#f60" style="color:#f60;">橙色</option>
					</select></td></tr>
	<tr><td><input type="submit" name="send" onclick="return checkAddContent();" value="发布文档 "><input type="reset" value="重置文档"></td></tr>
	<tr><td></td></tr>
</table>
</form>
<?php }?>
<?php if($this->_vars['update']){?>
<form name="content" method="post" action="?action=update">
<input type="hidden" value="<?php echo $this->_vars['id']?>" name="id"/>
<input type="hidden" value="<?php echo $this->_vars['prev_url']?>" name="prev_url"/>
<table cellspacing="0" class="content">
	<tr><th><strong>发表新文档</strong></th></tr>
	<tr><td>文档标题:<input type="text" name="title" value="<?php echo $this->_vars['titlec']?>" class="text"><span class="red">*</span>(2~50字符之间   <span class="red">*</span>为必填)</td></tr>
	<tr><td>栏　　目:<select name="nav"><option value="">请选择一个栏目 </option><?php echo $this->_vars['nav']?></select><span class="red">*</span></td></tr>
	<tr><td>定义属性:<?php echo $this->_vars['attr']?>
	</td></tr>
	<tr><td>标　　签:<input type="text" name="tag" value="<?php echo $this->_vars['tag']?>" class="text">(请用','隔开可输入30字符)</td></tr>
	<tr><td>关 键 字 :<input type="text" name="keyword" value="<?php echo $this->_vars['keyword']?>" class="text">(请用','隔开可输入30字符)</td></tr>
	<tr><td>缩 略 图 :<input type="text" name="thumbnail" value="<?php echo $this->_vars['thumbnail']?>" class="text" readonly="readonly">
					<input type="button" value="上传缩略图" onclick="centerWindow('../templates/upfile.html','upfile','500','100');">
					<img name="pic" src="<?php echo $this->_vars['thumbnail']?>" style="display:block;">(请选择200KB以下的jpg,png,gif图片)
	</td></tr>
	<tr><td>文章来源:<input type="text" name="source" value="<?php echo $this->_vars['source']?>" class="text">(20字符以内)</td></tr>
	<tr><td>作　　者:<input type="text" name="author" value="<?php echo $this->_vars['author']?>" value="<?php echo $this->_vars['author']?>" class="text">(10字符以内)</td></tr>
	<tr><td><span class="middle">内容摘要:</span><textarea name="info"><?php echo $this->_vars['info']?></textarea><span class="middle">(200字符以内)</span></td></tr>
	<tr class="ckeditor"><td><textarea id="TextArea1" name="content" class="ckeditor"><?php echo $this->_vars['content']?></textarea></td></tr>
	<tr><td>评论选项:<input type="radio" name="commend" value="1" <?php echo $this->_vars['commend1']?>>开启评论
				<input type="radio" name="commend" value="0" <?php echo $this->_vars['commend2']?>>关闭评论 　　　　浏览次数:<input type="text" name="count" value="<?php echo $this->_vars['count']?>" class="text small"></td></tr>
	<tr><td>文档排序:<select name="sort">
					<?php echo $this->_vars['sort']?>
					</select> 　　　 消费金币:<input type="text" name="gold" value="<?php echo $this->_vars['gold']?>" class="text small"></td></tr>
	<tr><td>阅读权限:<select name="readlimit">
					<?php echo $this->_vars['readlimit']?>
					</select> 　　　 标题颜色:
					<select name="color">
					<?php echo $this->_vars['color']?>
					</select></td></tr>
	<tr><td><input type="submit" name="send" onclick="return checkAddContent();" value="修改文档 "><input type="reset" value="重置文档"></td></tr>
	<tr><td></td></tr>
</table>
</form>
<?php }?>
</body>
</html>

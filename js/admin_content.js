window.onload=function(){
	
	
	var title=document.getElementById('title');
	var ol=document.getElementsByTagName('ol');
	var a=ol[0].getElementsByTagName('a');
	
	for(i=0;i<a.length;i++){
		a[i].className=null;
		if(title.innerHTML==a[i].innerHTML){
			a[i].className='selected';
		}
		
	}
	
}
function centerWindow(url,name,width,height){
	
	var top=(screen.height-height)/2-50;
	var left=(screen.width-width)/2;
	window.open(url,'name','width='+width+', height='+height+' ,top='+top+', left='+left);
}
function checkAddContent(){
	var fm=document.content;
	if(fm.title.value=='')
	{
		alert('标题不能为空');
		fm.title.focus();
		return false;
	}
	if(fm.title.value.length<2)
	{
		alert('标题不能小于2字符');
		fm.title.focus();
		return false;
	}
	if(fm.title.value.length>50)
	{
		alert('标题不能大于50字符');
		fm.title.focus();
		return false;
	}
	if(fm.nav.value=='')
	{
		alert('请选择一个栏目');
		fm.nav.focus();
		return false;
	}
	if(fm.tag.value.length>30)
	{
		alert('标签不能大于30字符');
		fm.tag.focus();
		return false;
	}
	if(fm.keyword.value.length>30)
	{
		alert('关键字不能大于30字符');
		fm.keyword.focus();
		return false;
	}
	if(fm.source.value.length>20)
	{
		alert('文章来源不能大于30字符');
		fm.source.focus();
		return false;
	}
	if(fm.author.value.length>10)
	{
		alert('作者名不能大于10字符');
		fm.author.focus();
		return false;
	}
	if(fm.info.value.length>200)
	{
		alert('内容简介不能大于200字符');
		fm.info.focus();
		return false;
	}
	
	if(isNaN(fm.count.value))
	{
		alert('浏览次数必须为数字');
		fm.count.focus();
		return false;
	}
	if(isNaN(fm.gold.value))
	{
		alert('消费金币必须为数字');
		fm.gold.focus();
		return false;
	}
	
	return true;
}
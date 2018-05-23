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
function checkAddRotatain(){
	var fm=document.content;
	if(fm.thumbnail.value=='')
	{
		alert('请上传一个图片');
		return false;
	}
	if(fm.title.value=='')
	{
		alert('标题不能为空');
		fm.title.focus();
		return false;
	}
	if(fm.title.value.length>20)
	{
		alert('标题不能大于二十位');
		fm.title.focus();
		return false;
	}
	if(fm.link.value=='')
	{
		alert('链接不能为空');
		fm.link.focus();
		return false;
	}
	if(fm.link.value.length>100)
	{
		alert('链接不能大于一百位');
		fm.link.focus();
		return false;
	}
	if(fm.info.value.length>200)
	{
		alert('信息不能大于二百位');
		fm.info.focus();
		return false;
	}
	return true;
}
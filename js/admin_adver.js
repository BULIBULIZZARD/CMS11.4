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

function adver(type){
	var thumbnail=document.getElementById('thumbnail');
	var up=document.getElementById('up');
	var fm=document.content;
	if(fm.change.value!=type){
		fm.thumbnail.value='';
		fm.pic.src='';
		fm.pic.style.display='none';
	}
	switch(type){
		case 1:
			thumbnail.style.display='none';
			up.innerHTML="";
			fm.change.value=type;
			break;
		case 2:
			thumbnail.style.display='block';
			fm.change.value=type;
			up.innerHTML="<input type=\"button\" value=\"上传头部广告690x80\" onclick=\"centerWindow('../config/upfile.php?type=adver&size=690x80','upfile','500','100');\">";
			break;
		case 3:
			thumbnail.style.display='block';
			fm.change.value=type;
			up.innerHTML="<input type=\"button\" value=\"上传侧栏广告270x200\" onclick=\"centerWindow('../config/upfile.php?type=adver&size=270x200','upfile','500','100');\">";
			break;
	}
}
function centerWindow(url,name,width,height){
	var top=(screen.height-height)/2-50;
	var left=(screen.width-width)/2;
	window.open(url,'name','width='+width+', height='+height+' ,top='+top+', left='+left);
}
function checkAdver(){
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
	if(fm.title.value.length>20)
	{
		alert('标题不能大于20字符');
		fm.title.focus();
		return false;
	}
	if(fm.type.value!=1){
		if(fm.thumbnail.value=='')
		{
			alert('请上传一张图片');
			fm.thumbnail.focus();
			return false;
		}
	}
	if(fm.link.value=='')
	{
		alert('链接不能为空');
		fm.link.focus();
		return false;
	}
	if(fm.link.value.length>100)
	{
		alert('链接不能大于100字符');
		fm.link.focus();
		return false;
	}
	return true;
}
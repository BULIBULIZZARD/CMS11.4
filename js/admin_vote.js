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
function checkAddForm(){
	var fm=document.add;
	if(fm.title.value==''||fm.title.value.length<2||fm.title.value.length>20)
	{
		alert('标题不能小于两位或大于二十位');
		fm.title.focus();
		return false;
	}
	if(fm.info.value.length>200){
		alert('说明不能大于二百位');
		fm.info.focus();
		return false;
	}
	return true;
}


function checkUpadateForm(){
	var fm=document.update;
	if(fm.title.value==''||fm.title.value.length<2||fm.title.value.length>20)
	{
		alert('标题不能小于两位或大于二十位');
		fm.title.focus();
		return false;
	}
	if(fm.info.value.length>200){
		alert('主题说明不能大于二百位');
		fm.info.focus();
		return false;
	}
	return true;
}










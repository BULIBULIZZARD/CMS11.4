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
	if(fm.name.value==''||fm.name.value.length<2||fm.name.value.length>20)
	{
		alert('权限名不能小于两位或大于二十位');
		fm.name.focus();
		return false;
	}
	if(fm.info.value.length>200){
		alert('权限说明不能大于二百位');
		fm.info.focus();
		return false;
	}
	if(fm.info.value=='')
	{
		alert('权限说明不能为空');
		fm.info.focus();
		return false;
	}
	return true;
}


function checkUpadateForm(){
	var fm=document.update;
	if(fm.name.value==''||fm.name.value.length<2||fm.name.value.length>20)
	{
		alert('权限名不能小于两位或大于二十位');
		fm.name.focus();
		return false;
	}
	if(fm.info.value.length>200){
		alert('权限说明不能大于二百位');
		fm.info.focus();
		return false;
	}
	if(fm.info.value=='')
	{
		alert('权限说明不能为空');
		fm.info.focus();
		return false;
	}
	return true;
}










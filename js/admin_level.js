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
	if(fm.level_name.value==''||fm.level_name.value.length<2||fm.level_name.value.length>20)
	{
		alert('等级名不能小于两位或大于二十位');
		fm.level_name.focus();
		return false;
	}
	if(fm.level_info.value.length>200){
		alert('等级说明不能大于二百位');
		fm.level_info.focus();
		return false;
	}
	if(fm.level_info.value=='')
	{
		alert('等级说明不能为空');
		fm.level_info.focus();
		return false;
	}
	return true;
}


function checkUpadateForm(){
	var fm=document.update;
	if(fm.level_name.value==''||fm.level_name.value.length<2||fm.level_name.value.length>20)
	{
		alert('等级名不能小于两位或大于二十位');
		fm.level_name.focus();
		return false;
	}
	if(fm.level_info.value.length>200){
		alert('等级说明不能大于二百位');
		fm.level_info.focus();
		return false;
	}
	if(fm.level_info.value=='')
	{
		alert('等级说明不能为空');
		fm.level_info.focus();
		return false;
	}
	return true;
}










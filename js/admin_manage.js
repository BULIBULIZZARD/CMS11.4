window.onload=function(){
	var level=document.getElementById('level');
	var options= document.getElementsByTagName('option');
	
	if(level){
		for(i=0;i<options.length;i++){
			if(options[i].value==level.value){
				options[i].setAttribute('selected','selected'); 
				break;
			}
		}
	}
	
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
	if(fm.admin_user.value==''||fm.admin_user.value.length<2)
	{
		alert('用户名不能小于两位');
		fm.admin_user.focus();
		return false;
	}
	else if(fm.admin_user.value.length>20){
		alert('用户名不能大于二十位');
		fm.admin_user.focus();
		return false;
	}
	
	
	if((fm.admin_pass.value=='')||(fm.admin_pass.value.length<6)){
		
		alert('密码不能小于六位');
		fm.admin_pass.focus();
		return false;
		
	}
	else if(fm.admin_pass.value.length>20){
		alert('密码不能大于二十位');
		fm.admin_pass.focus();
		return false;
	}
	
	
	
	if(fm.admin_pass.value!=fm.readmin_pass.value){
		alert('密码信息不一致');
		fm.readmin_pass.focus();
		return false;
	}
	return true;
}


function checkUpadateForm(){
	var fm=document.update;
	if(fm.admin_pass.value==''||fm.admin_pass.value.length>=6&&fm.admin_pass.value.length<=20)
	{
		fm.admin_pass.focus();
		return true;
	}
	else {
		alert('请输入正确格式的密码');
		fm.admin_pass.focus();
		return false;
	}
	return false;
}










function checkLogin(){
	var fm=document.login;
	if(fm.admin_user.value==''||fm.admin_user.value.length<2)
	{
		alert('用户名不能小于两位');
		fm.admin_user.focus();
		return false;
	}else if(fm.admin_user.value.length>20){
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
	if(fm.code.value.length!=4){
		
		alert('验证码必须为四位');
		fm.code.focus();
		return false;
		
	}
	return true;
}
function checkReg(){
	var fm=document.reg;
	if(fm.user.value==''||fm.user.value.length<2)
	{
		alert('用户名不能小于两位');
		fm.user.focus();
		return false;
	}else if(fm.user.value.length>20){
		alert('用户名不能大于二十位');
		fm.user.focus();
		return false;
	}
	if((fm.pass.value=='')||(fm.pass.value.length<6)){
		
		alert('密码不能小于六位');
		fm.pass.focus();
		return false;
		
	}
	else if(fm.pass.value.length>20){
		alert('密码不能大于二十位');
		fm.pass.focus();
		return false;
	}
	if(fm.pass.value!=fm.repass.value){
		alert('两次密码不一致');
		fm.repass.focus();
		return false;
	}
	if(fm.email.value.length==0){
		alert('电子邮箱不能为空');
		fm.email.focus();
		return false;
	}
	if(!/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(fm.email.value)){
			alert('邮箱格式不正确');
			fm.email.focus();
			return false;
	}
	if(fm.code.value.length!=4){
		alert('验证码必须为四位');
		fm.code.focus();
		return false;
	}
	return true;
}

function checkLogin(){
	var fm=document.login;
	if(fm.user.value==''||fm.user.value.length<2)
	{
		alert('用户名不能小于两位');
		fm.user.focus();
		return false;
	}else if(fm.user.value.length>20){
		alert('用户名不能大于二十位');
		fm.user.focus();
		return false;
	}
	if((fm.pass.value=='')||(fm.pass.value.length<6)){
		
		alert('密码不能小于六位');
		fm.pass.focus();
		return false;
		
	}
	else if(fm.pass.value.length>20){
		alert('密码不能大于二十位');
		fm.pass.focus();
		return false;
	}
	if(fm.code.value.length!=4){
		alert('验证码必须为四位');
		fm.code.focus();
		return false;
	}
	
	return true;
}
//选择头像 
function sface(){
	var fm=document.reg;	
	var index=fm.face.selectedIndex;
	fm.faceimg.src=fm.faceimg.src = 'images/face/'+fm.face.options[index].value;
}
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
function checkUpdate(){
	var fm=document.reg;
	if(!(fm.pass.value=='')&&(fm.pass.value.length<6)){
		
		alert('密码不能小于六位');
		fm.pass.focus();
		return false;
		
	}
	else if(fm.pass.value.length>20){
		alert('密码不能大于二十位');
		fm.pass.focus();
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
	return true;
}
function sface(){
	var fm=document.reg;	
	var index=fm.face.selectedIndex;
	fm.faceimg.src=fm.faceimg.src = '../images/face/'+fm.face.options[index].value;
}
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










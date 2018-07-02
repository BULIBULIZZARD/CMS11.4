function _link(type){
	var logo=document.getElementById('logo')
	switch(type){
		 case 1:
		 	logo.style.display='none';
		 	break;
		 case 2:
		 	logo.style.display='block';
		 	break;
	}
}
function checkLink(){
	var fm=document.friendlink;
	if(fm.webname.value==''||fm.webname.value.length<2)
	{
		alert('网站名称不能小于两位');
		fm.webname.focus();
		return false;
	}else if(fm.user.value.length>20){
		alert('网站名称不能大于二十位');
		fm.webname.focus();
		return false;
	}
	if(fm.weburl.value==''){
		
		alert('网站链接不能小于六位');
		fm.weburl.focus();
		return false;
		
	}
	else if(fm.weburl.value.length>100){
		alert('网站链接不能大于一百位');
		fm.weburl.focus();
		return false;
	}
	if(fm.type.value=='2'){
		if(fm.logourl.value==''){
		
			alert('Logo链接不能为空');
			fm.logourl.focus();
			return false;
		
		}
		else if(fm.logourl.value.length>100){
				alert('Logo链接不能大于一百位');
				fm.logourl.focus();
				return false;
		}
	}
	if(fm.user.value.length>20){
		alert('站长姓名不能大于二十位');
		fm.user.focus();
		return false;
	}
	if(fm.code.value.length!=4){
		alert('验证码必须为四位');
		fm.code.focus();
		return false;
	}
	
	return true;
}
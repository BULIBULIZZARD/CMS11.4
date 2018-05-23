function checkComment(){
	var fm=document.comment;
	if(fm.content.value=='')
	{
		alert('评论不能为空');
		fm.content.focus();
		return false;
	}else if(fm.content.value.length>255){
		alert('评论不能大于二百五十五个字');
		fm.content.focus();
		return false;
	}

	if(fm.code.value.length!=4){
		alert('验证码必须为四位');
		fm.code.focus();
		return false;
	}
	
	return true;
}

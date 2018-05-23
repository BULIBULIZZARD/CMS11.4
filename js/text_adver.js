//2018-05-10 18:50:37
var text=[];
text[1]={
'title':'失误练出逆境腐鲲',
'link':'https://www.bilibili.com/'
}
text[2]={
'title':'我就是饿死也不吃你这腐鲲一口',
'link':'https://www.bilibili.com/'
}
text[3]={
'title':'没想到腐鲲闻着臭吃着香',
'link':'https://www.bilibili.com/'
}
text[4]={
'title':'你怕不是不把我谢广坤放在眼里',
'link':'https://www.bilibili.com/'
}
text[5]={
'title':'猿神孙悟空生吃腐鲲引人围观',
'link':'https://www.bilibili.com/'
}
var i=Math.floor(Math.random()*5+1);
document.write('<a href="'+text[i].link+'" class="adv"  target="_blank">'+text[i].title+'</a>');

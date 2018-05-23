//2018-05-10 18:57:25
var header=[];
header[1]={
'title':'失误练出逆境腐鲲',
'pic':'/cms10.0/uploads/20180510/20180510170507829.png',
'link':'https://www.bilibili.com/'
}
header[2]={
'title':'我就是饿死也不吃你这腐鲲一口',
'pic':'/cms10.0/uploads/20180510/20180510170543645.png',
'link':'https://www.bilibili.com/'
}
header[3]={
'title':'没想到腐鲲闻着臭吃着香',
'pic':'/cms10.0/uploads/20180510/20180510170611233.png',
'link':'https://www.bilibili.com/'
}
var i=Math.floor(Math.random()*3+1);
document.write('<a href="'+header[i].link+'" target="_blank" title="'+header[i].title+'"><img src="'+header[i].pic+'" >');

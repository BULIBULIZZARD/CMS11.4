//2018-05-10 18:59:42
var sidebar=[];
sidebar[1]={
'title':'侧栏1',
'pic':'/cms10.0/uploads/20180510/20180510170714931.png',
'link':'https://www.bilibili.com/'
}
sidebar[2]={
'title':'侧栏2',
'pic':'/cms10.0/uploads/20180510/20180510170741387.png',
'link':'https://www.bilibili.com/'
}
sidebar[3]={
'title':'侧栏3',
'pic':'/cms10.0/uploads/20180510/20180510170809568.png',
'link':'https://www.bilibili.com/'
}
var i=Math.floor(Math.random()*3+1);
document.write('<a href="'+sidebar[i].link+'" target="_blank" title="'+sidebar[i].title+'"><img src="'+sidebar[i].pic+'" >');

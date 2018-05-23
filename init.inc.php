<?php
//
session_start();
//
header('Content-Type:text/html;charset=utf-8');
//根目录
define('ROOT_PATH', __DIR__);

//实例化模板类
require ROOT_PATH.'/config/profile.inc.php';
//设置时区
date_default_timezone_set('Asia/Shanghai');
//自动加载类
function __autoload($_className){
    if(substr($_className,-6)=='Action'){
        require ROOT_PATH.'/action/'.$_className.'.class.php';
    }else if (substr($_className,-5)=='Model') {
        require ROOT_PATH.'/model/'.$_className.'.class.php';
    }else 
    
    {
        require ROOT_PATH.'/includes/'.$_className.'.class.php';
    }
}
//设置不缓存
$_noCache=array('code','ckeup','static','upload');
$_noCacheFront=array('register','feedback','cast','friendlink','search');
$_fullnocache=array('code','ckeup','static','upload','register','feedback','cast','friendlink','search');
$_noCacheScript=in_array(Tool::tplName(), $_noCache);
$_noCache=in_array(Tool::tplName(),$_noCacheFront);
$_full=in_array(Tool::tplName(), $_fullnocache);
//实例
$_tpl=new Templates($_full);
//缓存//
if (!$_noCacheScript)
require 'common.inc.php';
?>